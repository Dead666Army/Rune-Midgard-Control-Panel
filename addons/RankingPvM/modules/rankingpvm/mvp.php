<?php
if (!defined('FLUX_ROOT')) exit;
$title = 'MVP Ranking';
$mvpdata    = $params->get('mvpdata');
$classes    = Flux::config('JobClasses')->toArray();
$jobClass   = $params->get('jobclass');
$bind       = array();
$limit      = (int)Flux::config('MVPRankingLimit');
$rankingTypes = Flux::config('MVPRankingTypes')->toArray();
$rankingTypesFilter = $params->get('rankingTypesFilter');
$datefilter="";

require_once 'Flux/TemporaryTable.php';

// List MVPS
$col = "id, iName";
$sql = "SELECT $col FROM RMmain.mob_db WHERE `MEXP` > 0 ORDER BY `iName`";
$sth = $server->connection->getStatement($sql);
$sth->execute($bind);
$moblist = $sth->fetchAll();

if (trim($mvpdata) === '0') { 
    $mvpdata = null; 
}

if (trim($jobClass) === '') {
	$jobClass = null;
}

if (trim($rankingTypesFilter) === '') {
	$rankingTypesFilter = null;
}

if (!is_null($mvpdata) && !searchForId($mvpdata, $moblist)) {
	$this->deny();
}

if (!is_null($jobClass) && !array_key_exists($jobClass, $classes)) {
	$this->deny();
}

if (!is_null($rankingTypesFilter) && !array_key_exists($rankingTypesFilter, $rankingTypes)) {
	$this->deny();
}

if(array_key_exists($rankingTypesFilter, $rankingTypes) && $rankingTypesFilter == "Current"){
    $dfirst = new DateTime('first day of this month');
    $dfirstFormat = $dfirst->format('Ymd');
    $dlast = new DateTime('last day of this month');
    $dlastFormat = $dlast->format('Ymd');
    $datefilter = "and mlog.mvp_date between $dfirstFormat and  $dlastFormat "; 
}

if($mvpdata and $mvpdata != 0){
    // Specific
    $bind[] = $mvpdata;
    $col = "mlog.kill_char_id, mlog.monster_id, ch.name AS name, ch.class AS char_class,ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len, RMmain.mob_db.iName AS iName, count(*) AS count ";
    $sql = "SELECT $col FROM {$server->logsDatabase}.`mvplog` AS mlog ";
    $sql.= "LEFT JOIN {$server->charMapDatabase}.`char` ch ON ch.char_id = mlog.kill_char_id ";
    $sql.= "LEFT JOIN {$server->loginDatabase}.`login` ON login.account_id = ch.account_id ";
    $sql.= "LEFT JOIN {$server->loginDatabase}.`guild` ON guild.guild_id = ch.guild_id  ";
    $sql.= "LEFT JOIN RMmain.mob_db ON id = mlog.monster_id ";
    $sql.= "WHERE mlog.monster_id = $mvpdata $datefilter ";
    if (!is_null($jobClass)) {
		$sql .= "AND ch.class = $jobClass ";
	}
    $sql.= "GROUP BY mlog.kill_char_id ORDER BY count DESC LIMIT $limit";
    $sth = $server->connection->getStatementForLogs($sql);
    $sth->execute($bind);
    $kills = $sth->fetchAll();
} else {
    // All data
    $col = "mlog.kill_char_id,ch.name AS name, ch.class AS char_class,ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len , count(*) AS count ";
    $sql = "SELECT $col FROM {$server->logsDatabase}.`mvplog` AS mlog ";
    $sql.= "LEFT JOIN {$server->charMapDatabase}.`char` ch ON ch.char_id = mlog.kill_char_id ";
    $sql.= "LEFT JOIN {$server->loginDatabase}.`login` ON login.account_id = ch.account_id ";
    $sql.= "LEFT JOIN {$server->loginDatabase}.`guild` ON guild.guild_id = ch.guild_id  ";
    $sql.= "WHERE 1=1 $datefilter ";
    if (!is_null($jobClass)) {
		$sql .= "AND ch.class = $jobClass ";
	}
    $sql.= "GROUP BY mlog.kill_char_id ORDER BY count DESC LIMIT $limit";   
    $sth = $server->connection->getStatementForLogs($sql);
    $sth->execute($bind);
    $kills = $sth->fetchAll();
 }