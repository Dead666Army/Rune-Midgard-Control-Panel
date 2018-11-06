<?php
if (!defined('FLUX_ROOT')) exit;

$title    = 'General Ranking';
$classes  = Flux::config('JobClasses')->toArray();
$jobClass = $params->get('jobclass');
$bind     = array();
$rankingTypes = Flux::config('WOERankingTypes')->toArray();
$rankingTypesFilter = $params->get('rankingTypesFilter');
$datefilter = "";
$dispWoeDate = "All Time";

if (trim($jobClass) === '') {
	$jobClass = null;
}

if (!is_null($jobClass) && !array_key_exists($jobClass, $classes)) {
	$this->deny();
}

if (!is_null($rankingTypesFilter) && !array_key_exists($rankingTypesFilter, $rankingTypes)) {
	$this->deny();
}
$paginator = $this->getPaginator((int)Flux::config('WOERankingLimit'));
$sortable = array('top_damage', 'damage_done' => 'desc', 'damage_received', 'kill_count', 'death_count', 'healing_done', 'emp_damage_done', 'emperium_kill');
$paginator->setSortableColumns($sortable);
if($rankingTypesFilter == "AllTime"){ //All time
	$col  = "ch.char_id, ch.name AS char_name, ch.class AS char_class, sum(cb.top_damage) as top_damage, sum(cb.damage_done) as damage_done, sum(cb.damage_received) as damage_received, sum(cb.kill_count) as kill_count,sum(cb.death_count) as death_count,sum(cb.healing_done) as healing_done,sum(cb.emp_damage_done) as emp_damage_done,sum(cb.emperium_kill) as emperium_kill,";
	$col .= "ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len";

	$sql  = "SELECT $col FROM {$server->charMapDatabase}.`char_woe` AS cb ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.`char` AS ch on cb.char_id=ch.char_id ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
	$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
	$sql .= "WHERE 1=1 ";

	if (Flux::config('WOEHidePermBannedCharRank')) {
		$sql .= "AND login.state != 5 ";
	}
	if (Flux::config('WOEGHideTempBannedCharRank')) {
		$sql .= "AND (login.unban_time IS NULL OR login.unban_time = 0) ";
	}

	$groups = AccountLevel::getGroupID((int)Flux::config('WOERankingHideGroupLevel'), '<');
	if(!empty($groups)) {
		$ids   = implode(', ', array_fill(0, count($groups), '?'));
		$sql  .= "AND login.group_id IN ($ids) ";
		$bind  = array_merge($bind, $groups);
	}

	if ($days=Flux::config('WOECharRankingThreshold')) {
		$sql    .= 'AND TIMESTAMPDIFF(DAY, login.lastlogin, NOW()) <= ? ';
		$bind[]  = $days * 24 * 60 * 60;
	}

	if (!is_null($jobClass)) {
		$sql .= "AND ch.class = ? ";
		$bind[] = $jobClass;
	}

	$sql .= "GROUP BY ch.char_id ";

}	else{ //Current
	$col  = "ch.char_id, ch.name AS char_name, ch.class AS char_class, cb.top_damage, cb.damage_done, cb.damage_received, cb.kill_count,cb.death_count,cb.healing_done,cb.emp_damage_done,cb.emperium_kill,";
	$col .= "ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len";

	$sql  = "SELECT $col FROM {$server->charMapDatabase}.`char_woe` AS cb ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.`char` AS ch on cb.char_id=ch.char_id ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
	$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
	$sql .= "WHERE 1=1 ";

	if (Flux::config('WOEHidePermBannedCharRank')) {
		$sql .= "AND login.state != 5 ";
	}
	if (Flux::config('WOEGHideTempBannedCharRank')) {
		$sql .= "AND (login.unban_time IS NULL OR login.unban_time = 0) ";
	}

	$groups = AccountLevel::getGroupID((int)Flux::config('WOERankingHideGroupLevel'), '<');
	if(!empty($groups)) {
		$ids   = implode(', ', array_fill(0, count($groups), '?'));
		$sql  .= "AND login.group_id IN ($ids) ";
		$bind  = array_merge($bind, $groups);
	}

	if ($days=Flux::config('WOECharRankingThreshold')) {
		$sql    .= 'AND TIMESTAMPDIFF(DAY, login.lastlogin, NOW()) <= ? ';
		$bind[]  = $days * 24 * 60 * 60;
	}

	if (!is_null($jobClass)) {
		$sql .= "AND ch.class = ? ";
		$bind[] = $jobClass;
	}

	if (is_null($rankingTypesFilter) or $rankingTypesFilter == "Current") {
		$woe_date = getLastWoeDate();
		$woe_dateFormat = $woe_date->format('Ymd');
		$dispWoeDate = $woe_date->format('Y-m-d');
		$datefilter = "AND cb.woe_date = $woe_dateFormat "; 
		$sql .= "AND cb.woe_date = $woe_dateFormat "; 
	}

}
$sql = $paginator->getSQL("$sql");  
$sth  = $server->connection->getStatement($sql);
$sth->execute($bind);
$chars = $sth->fetchAll();
?>
