<?php
if (!defined('FLUX_ROOT')) exit;

$title = 'Map Statistics';

$charPrefsTable = Flux::config('FluxTables.CharacterPrefsTable');

$bind = array();
$sql  = "SELECT last_map AS map_name, COUNT(last_map) AS player_count FROM {$server->charMapDatabase}.`char` ch ";

if (($hideGroupLevel=(int)Flux::config('HideFromMapStats')) > 0 && !$auth->allowedToSeeHiddenMapStats) {
	$sql .= "LEFT JOIN {$server->loginDatabase}.login ON ch.account_id = login.account_id ";
}

if (!$auth->allowedToIgnoreHiddenPref) {
	$sql .= "LEFT JOIN {$server->charMapDatabase}.$charPrefsTable AS pref1 ON ";
	$sql .= "(pref1.account_id = ch.account_id AND pref1.char_id = ch.char_id AND pref1.name = 'HideFromWhosOnline') ";
	$sql .= "LEFT JOIN {$server->charMapDatabase}.$charPrefsTable AS pref2 ON ";
	$sql .= "(pref2.account_id = ch.account_id AND pref2.char_id = ch.char_id AND pref2.name = 'HideMapFromWhosOnline') ";	
}

$sql .= "WHERE online > 0 ";
if (!$auth->allowedToIgnoreHiddenPref) {
	$sql .= "AND (pref1.value IS NULL) ";
	$sql .= "AND (pref2.value IS NULL) ";
}

if ($hideGroupLevel > 0 && !$auth->allowedToSeeHiddenMapStats) {
	$groups = AccountLevel::getGroupID($hideGroupLevel, '<');
	if(!empty($groups)) {
		$ids   = implode(', ', array_fill(0, count($groups), '?'));
		$sql  .= "AND login.group_id IN ($ids) ";
		$bind  = array_merge($bind, $groups);
	}
}

$sql .= " GROUP BY map_name, online HAVING player_count > 0 ORDER BY map_name ASC";
$sth  = $server->connection->getStatement($sql);

$sth->execute($bind);
$maps = $sth->fetchAll();
?>
