<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('JustificationEditTitle')) ?></h2>
<?php if ($commands): ?>
<table class="horizontal-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('Date')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('TransferCharNameLabel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('Commande')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('Itemid')) ?></th>
		<th></th>
		<th></th>
		<th colspan="2"><?php echo htmlspecialchars(Flux::message('Justification')) ?></th>
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
		<td align='center'><a href="<?php echo $this->url('tracing', 'managecmd', array('atcommand_id' => $commands[$i]->atcommand_id)); ?>"><?php echo htmlspecialchars(Flux::message('CMSEdit')) ?></a> </td>
		
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('TraceCommandsNoCommands')) ?> <a href="javascript:history.go(-1)"><?php echo htmlspecialchars(Flux::message('GoBackLabel')) ?></a>.</p>
<?php endif ?>

