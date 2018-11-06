<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('TraceCommandsTitle')) ?></h2>
<?php if ($commands): ?>
<p><?php echo htmlspecialchars(Flux::message('TraceCommandsDesc')) ?></p>
<table class="horizontal-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('Date')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('TransferCharNameLabel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('TraceCommands')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('Item')) ?></th>
		<th></th>
		<th></th>
		<th><?php echo htmlspecialchars(Flux::message('Justification')) ?></th>
	</tr>
	<?php for ($i = 0; $i < sizeof($commands); $i++): ?>
	<tr>
		<td align='center'><?php echo $commands[$i]->atcommand_date ?></td>
		<td align='center'><?php echo $commands[$i]->char_name ?></td>
		<td><?php echo $commands[$i]->command ?></td>
		<?php $command = explode(" ", $commands[$i]->command);?>
		<?php switch ($command[0]) {
			case "@item":
				?>
				<td align='center'><?php echo $this->linkToItem($command[1], $command[1]); ?></td>
				<td align='center'><?php if ($image=$this->iconImage($command[1])) ?><img src="<?php echo $image; ?>" /></td>
				<td align='center'><?php if(array_key_exists(2, $command)) echo $command[2]; ?></td>
				<?php
				break;
			case "@refine":
				?>
				<td></td>
				<td></td>
				<td></td>
				<?php
				break;
			case "@produce":
				?>
				<td align='center'><?php echo $this->linkToItem($command[1], $command[1]); ?></td>
				<td align='center'><?php if ($image=$this->iconImage($command[1])) ?><img src="<?php echo $image; ?>" /></td>
				<td></td>
				<?php
				break;
		}?>
		<td><?php echo $commands[$i]->justification ?></td>
		
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('TraceCommandsNoCommands')) ?> <a href="javascript:history.go(-1)"><?php echo htmlspecialchars(Flux::message('GoBackLabel')) ?></a>.</p>
<?php endif ?>

