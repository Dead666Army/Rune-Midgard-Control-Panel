<?php
if (!defined('FLUX_ROOT')) exit;

$title    = 'Skills Statistics';
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
$sortable = array('healing_done' => 'desc', 'wrong_healing_done', 'support_skills_used', 'wrong_support_skills_used', 'sp_used', 'spiritb_used', 'zeny_used');
$paginator->setSortableColumns($sortable);
if($rankingTypesFilter == "AllTime"){ //All time
	$col  = "ch.char_id, ch.name AS char_name, ch.class AS char_class, sum(cb.healing_done) as healing_done, sum(cb.wrong_healing_done) as wrong_healing_done, sum(cb.support_skills_used) as support_skills_used, sum(cb.wrong_support_skills_used) as wrong_support_skills_used, sum(cb.sp_used) as sp_used, sum(cb.spiritb_used) as spiritb_used, sum(cb.zeny_used) as zeny_used,";
	$col .= "ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len";

	$sql  = "SELECT $col FROM {$server->charMapDatabase}.`char_woe` AS cb ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.`char` AS ch on cb.char_id=ch.char_id ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
	$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
	$sql .= "WHERE 1=1 ";

	if (Flux::config('WOEHidePermBannedCharRank')) {
		$sql .= "AND login.state != 5 ";
	}
	if (Flux::config('WOEHideTempBannedCharRank')) {
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

} else{//Current
	$col  = "ch.char_id, ch.name AS char_name, ch.class AS char_class, cb.healing_done, cb.wrong_healing_done, cb.support_skills_used, cb.wrong_support_skills_used, cb.sp_used, cb.spiritb_used, cb.zeny_used,";
	$col .= "ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len";

	$sql  = "SELECT $col FROM {$server->charMapDatabase}.`char_woe` AS cb ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.`char` AS ch on cb.char_id=ch.char_id ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
	$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
	$sql .= "WHERE 1=1 ";

	if (Flux::config('WOEHidePermBannedCharRank')) {
		$sql .= "AND login.state != 5 ";
	}
	if (Flux::config('WOEHideTempBannedCharRank')) {
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
