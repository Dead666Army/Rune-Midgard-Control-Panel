<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo Flux::message('MapStatTitle')?></h2>
<?php if ($maps): ?>
<?php $playerTotal = 0; foreach ($maps as $map) $playerTotal += $map->player_count ?>
<p><?php echo Flux::message('MapStatSubtitle')?></p>
<p><?php echo sprintf(Flux::message('MapStatNbPlayers'), number_format($playerTotal)) ?> 
<?php echo sprintf(Flux::message('MapStatNbMaps'), number_format(count($maps))) ?></p>
<div class="generic-form-div">
	<table class="generic-form-table">
		<?php foreach ($maps as $map): ?>
		<tr>
			<td align="right"><p class="important"><strong><?php echo htmlspecialchars(basename($map->map_name, '.gat')) ?></strong></p></td>
			<td><p><strong><?php echo number_format($map->player_count) ?></strong> <?php echo Flux::message('MapStatPlayers')?></p></td>
		</tr>
		<?php endforeach ?>
	</table>
</div>
<?php else: ?>
<p><?php echo Flux::message('MapStatNone')?></a>.</p>
<?php endif ?>
