<?php 


if (!defined('FLUX_ROOT')) exit; ?>

<h2><?php echo Flux::message('Itemlabel') ?></h2>
<h3>
	Top <?php echo number_format($limit=(int)Flux::config('WOERankingLimit')) ?> Players
	<?php if (!is_null($jobClass)): ?>
	(<?php echo htmlspecialchars($className=$this->jobClassText($jobClass)) ?>)
	<?php endif ?>
	on <?php echo htmlspecialchars($server->serverName) ?> FOR <?php echo $dispWoeDate;?>
</h3>
<?php if ($chars): ?>
<form action="" method="get" class="search-form2">
	<?php echo $this->moduleActionFormInputs('rankingwoe', 'items') ?>
	<p>
		<label for="jobclass">Filter by job class:</label>
		<select name="jobclass" id="jobclass">
			<option value=""<?php if (is_null($jobClass)) echo 'selected="selected"' ?>>All</option>
		<?php foreach ($classes as $jobClassIndex => $jobClassName): ?>
			<option value="<?php echo $jobClassIndex ?>"
				<?php if (!is_null($jobClass) && $jobClass == $jobClassIndex) echo ' selected="selected"' ?>>
				<?php echo htmlspecialchars($jobClassName) ?>
			</option>
		<?php endforeach ?>
		</select>
		<label for="rankingTypesFilter">  Classement type: </label>
		<select name="rankingTypesFilter" id="rankingTypesFilter">
		<?php foreach ($rankingTypes as $rankingTypeKey=>$rankingTypeValue): ?>
			<option value="<?php echo $rankingTypeKey ?>"
            <?php if (!is_null($rankingTypesFilter) && $rankingTypesFilter == $rankingTypeKey) echo ' selected="selected"' ?>>
				<?php echo $rankingTypeValue; ?>
			</option>
		<?php endforeach ?>
		</select>
		
		<input type="submit" value="Filter" />
		<input type="button" value="Reset" onclick="reload()" />
	</p>
</form>
<table class="horizontal-table">
	<tr> 
		<th><?php echo htmlspecialchars(Flux::message('RankLabel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('CharacterNameLabel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('JobClassLabel')) ?></th>
		<th colspan="2"><?php echo htmlspecialchars(Flux::message('GuildNameLabel')) ?></th>
		<th><?php echo $paginator->sortableColumn('hp_heal_potions', htmlspecialchars(Flux::message('HPPotion'))); ?></th>
		<th><?php echo $paginator->sortableColumn('sp_heal_potions', htmlspecialchars(Flux::message('SPPotion'))); ?></th>
		<th><?php echo $paginator->sortableColumn('yellow_gemstones', htmlspecialchars(Flux::message('YellowG'))); ?></th>
		<th><?php echo $paginator->sortableColumn('red_gemstones', htmlspecialchars(Flux::message('RedG'))); ?></th>
		<th><?php echo $paginator->sortableColumn('blue_gemstones', htmlspecialchars(Flux::message('BlueG'))); ?></th>
		<th><?php echo $paginator->sortableColumn('acid_demostration', htmlspecialchars(Flux::message('AcidDemo'))); ?></th>
		<th><?php echo $paginator->sortableColumn('poison_bottles', htmlspecialchars(Flux::message('PoisonBottle'))); ?></th>
	</tr>
	<?php $topRankType = !is_null($jobClass) ? $className : 'character' ?>
	<?php for ($i = 0; $i < $limit; ++$i): ?>
	<tr <?php if (!isset($chars[$i])) echo ' class="empty-row"'; if ($i === 0) echo ' class="top-ranked" title="<strong>'.htmlspecialchars($chars[$i]->char_name).'</strong> '.htmlspecialchars(Flux::message('TopRankedLabel')).' '.$topRankType.'!"' ?>>
		<td align="center"><?php echo number_format($i + 1) ?></td>
		<?php if (isset($chars[$i])): ?>
		<td><strong>
			<?php if ($auth->actionAllowed('character', 'view') && $auth->allowedToViewCharacter): ?>
				<?php echo $this->linkToCharacter($chars[$i]->char_id, $chars[$i]->char_name) ?>
			<?php else: ?>
				<?php echo htmlspecialchars($chars[$i]->char_name) ?>
			<?php endif ?>
		</strong></td>
		<td><?php echo $this->jobClassText($chars[$i]->char_class) ?></td>
		<?php if ($chars[$i]->guild_name): ?>
		<?php if ($chars[$i]->guild_emblem_len): ?>
		<td width="24"><img src="<?php echo $this->emblem($chars[$i]->guild_id) ?>" /></td>
		<?php endif ?>
		<td<?php if (!$chars[$i]->guild_emblem_len) echo ' colspan="2"' ?>>
			<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
				<?php echo $this->linkToGuild($chars[$i]->guild_id, $chars[$i]->guild_name) ?>
			<?php else: ?>
				<?php echo htmlspecialchars($chars[$i]->guild_name) ?>
			<?php endif ?>
		</td>
		<?php else: ?>
		<td colspan="2"><span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneF')) ?></span></td>
		<?php endif ?>
		<td><?php echo number_format($chars[$i]->hp_heal_potions) ?></td>
		<td><?php echo number_format($chars[$i]->sp_heal_potions) ?></td>
		<td><?php echo number_format($chars[$i]->yellow_gemstones) ?></td>
		<td><?php echo number_format($chars[$i]->red_gemstones) ?></td>
		<td><?php echo number_format($chars[$i]->blue_gemstones) ?></td>
		<td><?php echo number_format($chars[$i]->acid_demostration) ?></td>
		<td><?php echo number_format($chars[$i]->poison_bottles) ?></td>
		<?php else: ?>
		<td colspan="8"></td>
		<?php endif ?>
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p>There are no characters. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>