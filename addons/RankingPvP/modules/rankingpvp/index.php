<?php
if (!defined('FLUX_ROOT')) exit;

$title    = 'PVP Ranking';
$classes  = Flux::config('JobClasses')->toArray();
$jobClass = $params->get('jobclass');
$bind     = array();
$rankingTypes = Flux::config('MVPRankingTypes')->toArray();
$rankingTypesFilter = $params->get('rankingTypesFilter');
$datefilter = "";

if (trim($jobClass) === '') {
	$jobClass = null;
}

if (trim($rankingTypesFilter) === '') {
	$rankingTypesFilter = null;
}

if (!is_null($jobClass) && !array_key_exists($jobClass, $classes)) {
	$this->deny();
}

if (!is_null($rankingTypesFilter) && !array_key_exists($rankingTypesFilter, $rankingTypes)) {
	$this->deny();
}


if($rankingTypesFilter == "AllTime" || !array_key_exists($rankingTypesFilter, $rankingTypes)){ //All time

	$col  = "ch.char_id ,pvp.char as char_name,ch.class as char_class,ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len, ";
	$col .= "SUM(pvp.kill) AS `kill`,SUM(pvp.death) AS death,SUM(pvp.kdr) AS kdr,SUM(pvp.killingstreak) AS killingstreak,SUM(pvp.multikill) AS multikill,SUM(pvp.killingspree) AS killingspree,SUM(pvp.dominating) AS dominating,SUM(pvp.megakill) AS megakill,SUM(pvp.unstoppable) AS unstoppable,SUM(pvp.wickedsick) AS wickedsick,SUM(pvp.monsterkill) AS monsterkill,SUM(pvp.godlike) AS godlike,SUM(pvp.beyondgodlike) AS beyondgodlike,SUM(pvp.doublekill) AS doublekill,SUM(pvp.triplekill) AS triplekill,SUM(pvp.ultrakill) AS ultrakill,SUM(pvp.rampage) AS rampage,SUM(pvp.ownage) AS ownage,SUM(pvp.nemesiskill) AS nemesiskill,SUM(pvp.feedcount) AS feedcount ";

	$sql  = "SELECT $col FROM {$server->charMapDatabase}.`pvp_rank` AS pvp ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.char ch on ch.char_id = pvp.char_id ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
	$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
	$sql .= "WHERE 1=1 $datefilter ";

	if (Flux::config('HidePermBannedCharRank')) {
		$sql .= "AND login.state != 5 ";
	}
	if (Flux::config('HideTempBannedCharRank')) {
		$sql .= "AND (login.unban_time IS NULL OR login.unban_time = 0) ";
	}

	$groups = AccountLevel::getGroupID((int)Flux::config('RankingHideGroupLevel'), '<');
	if(!empty($groups)) {
		$ids   = implode(', ', array_fill(0, count($groups), '?'));
		$sql  .= "AND login.group_id IN ($ids) ";
		$bind  = array_merge($bind, $groups);
	}

	if (!is_null($jobClass)) {
		$sql .= "AND ch.class = ? ";
		$bind[] = $jobClass;
	}

	$sql .= "GROUP BY ch.char_id ";
	$sql .= "ORDER BY pvp.kill desc,pvp.death asc ";
	$sql .= "LIMIT ".(int)Flux::config('CharRankingLimit');
	$sth  = $server->connection->getStatement($sql);

}else{// current month
	if(array_key_exists($rankingTypesFilter, $rankingTypes) && $rankingTypesFilter == "Current"){
		$dfirst = new DateTime('first day of this month');
		$dfirstFormat = $dfirst->format('Yn');
		$datefilter = "and pvp.month = $dfirstFormat"; 
	}

	$col  = "ch.char_id ,pvp.char as char_name,ch.class as char_class,ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len, pvp.kill,pvp.death,pvp.kdr,pvp.killingstreak,pvp.multikill,pvp.killingspree,pvp.dominating,pvp.megakill, pvp.unstoppable, pvp.wickedsick, pvp.monsterkill, ";
	$col .= "pvp.godlike, pvp.beyondgodlike, pvp.doublekill, pvp.triplekill, pvp.ultrakill, pvp.rampage, pvp.ownage, pvp.nemesiskill, pvp.feedcount";

	$sql  = "SELECT $col FROM {$server->charMapDatabase}.`pvp_rank` AS pvp ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.char ch on ch.char_id = pvp.char_id ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
	$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
	$sql .= "WHERE 1=1 $datefilter ";

	if (Flux::config('HidePermBannedCharRank')) {
		$sql .= "AND login.state != 5 ";
	}
	if (Flux::config('HideTempBannedCharRank')) {
		$sql .= "AND (login.unban_time IS NULL OR login.unban_time = 0) ";
	}

	$groups = AccountLevel::getGroupID((int)Flux::config('RankingHideGroupLevel'), '<');
	if(!empty($groups)) {
		$ids   = implode(', ', array_fill(0, count($groups), '?'));
		$sql  .= "AND login.group_id IN ($ids) ";
		$bind  = array_merge($bind, $groups);
	}

	if (!is_null($jobClass)) {
		$sql .= "AND ch.class = ? ";
		$bind[] = $jobClass;
	}

	$sql .= "ORDER BY pvp.kill desc,pvp.death asc ";
	$sql .= "LIMIT ".(int)Flux::config('CharRankingLimit');
	$sth  = $server->connection->getStatement($sql);
}


$sth->execute($bind);

$chars = $sth->fetchAll();
?>
