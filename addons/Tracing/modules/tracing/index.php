<?php
if (!defined('FLUX_ROOT')) exit;

$col  = "ac.atcommand_id, atcommand_date, char_name, command,justification ";
$sql  = "SELECT $col FROM {$server->logsDatabase}.atcommandlog ac left join RMmain.cp_cmdjustification cj on ac.atcommand_id=cj.atcommand_id where (command like '@item%' and command not like '@itemlist%' and command not like '@iteminfo%' and command not like '@itemreset%') or command like '@produce%' or command like '@refine%' order by ac.atcommand_date desc;";
$sth  = $server->connection->getStatement($sql);
$sth->execute();
$commands = $sth->fetchAll();
?>
