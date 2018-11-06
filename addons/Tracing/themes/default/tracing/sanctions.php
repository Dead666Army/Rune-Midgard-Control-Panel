<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('TraceSanctionsTitle')) ?></h2>
<?php if ($sanctions): ?>
<p><?php echo htmlspecialchars(Flux::message('TraceeSanctionsDesc')) ?></p>
<table class="horizontal-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('Date')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('TransferCharNameLabel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('TraceCommands')) ?></th>
	</tr>
	<?php for ($i = 0; $i < sizeof($sanctions); $i++): ?>
	<tr>
		<td align='center'><?php echo $sanctions[$i]->atcommand_date ?></td>
		<td align='center'><?php echo $sanctions[$i]->char_name ?></td>
		<td><?php echo $sanctions[$i]->command ?></td>
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('TraceCommandsNoCommands')) ?> <a href="javascript:history.go(-1)"><?php echo htmlspecialchars(Flux::message('GoBackLabel')) ?></a>.</p>
<?php endif ?>


