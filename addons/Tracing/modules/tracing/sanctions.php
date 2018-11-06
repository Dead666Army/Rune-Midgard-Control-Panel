<?php
if (!defined('FLUX_ROOT')) exit;

$col  = "atcommand_date, char_name, command";
$sql  = "SELECT $col FROM {$server->logsDatabase}.atcommandlog ac where command like '@jail%' or command like '@ban%' or command like '@charban%' or command like '@block%' or command like '@mute%' order by ac.atcommand_date desc;";
$sth  = $server->connection->getStatement($sql);
$sth->execute();
$sanctions = $sth->fetchAll();


?>