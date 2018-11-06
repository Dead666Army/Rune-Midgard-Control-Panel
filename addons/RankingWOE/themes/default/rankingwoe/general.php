<?php 


if (!defined('FLUX_ROOT')) exit; ?>

<h2><?php echo Flux::message('WOEGenerallabel') ?></h2>
<h3>
	Top <?php echo number_format($limit=(int)Flux::config('WOERankingLimit')) ?> Players
	<?php if (!is_null($jobClass)): ?>
	(<?php echo htmlspecialchars($className=$this->jobClassText($jobClass)) ?>)
	<?php endif ?>
	on <?php echo htmlspecialchars($server->serverName) ?> FOR <?php echo $dispWoeDate;?>
</h3>
<?php if ($chars): ?>
<form action="" method="get" class="search-form2">
	<?php echo $this->moduleActionFormInputs('rankingwoe', 'general') ?>
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
<?php echo $paginator->infoText() ?>
<table class="horizontal-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('RankLabel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('CharacterNameLabel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('JobClassLabel')) ?></th>
		<th colspan="2"><?php echo htmlspecialchars(Flux::message('GuildNameLabel')) ?></th>
		<th><?php echo $paginator->sortableColumn('top_damage', htmlspecialchars(Flux::message('TopDMG'))); ?></th>
		<th><?php echo $paginator->sortableColumn('damage_done', htmlspecialchars(Flux::message('TotalDMG'))); ?></th>
		<th><?php echo $paginator->sortableColumn('damage_received', htmlspecialchars(Flux::message('ReceivedDMG'))); ?></th>
		<th><?php echo $paginator->sortableColumn('healing_done', htmlspecialchars(Flux::message('HealingDone'))); ?></th>
        <th><?php echo $paginator->sortableColumn('kill_count', htmlspecialchars(Flux::message('KillLabel'))); ?></th>
        <th><?php echo $paginator->sortableColumn('death_count', htmlspecialchars(Flux::message('Deathlabel'))); ?></th>
        <th><?php echo $paginator->sortableColumn('emp_damage_done', htmlspecialchars(Flux::message('EmpDMG'))); ?></th>
        <th><?php echo $paginator->sortableColumn('emperium_kill', htmlspecialchars(Flux::message('EmpKill'))); ?></th>
	</tr>
	<?php $topRankType = !is_null($jobClass) ? $className : 'character' ?>
	<?php for ($i = 0; $i < $limit; ++$i): ?>
	<tr<?php if (!isset($chars[$i])) echo ' class="empty-row"'; if ($i === 0) echo ' class="top-ranked" title="<strong>'.htmlspecialchars($chars[$i]->char_name).'</strong> '.htmlspecialchars(Flux::message('TopRankedLabel')).' '.$topRankType.'!"' ?>>
		<td align="right"><?php echo number_format($i + 1) ?></td>
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
		<td><?php echo number_format($chars[$i]->top_damage) ?></td>
		<td><?php echo number_format($chars[$i]->damage_done) ?></td>
		<td><?php echo number_format($chars[$i]->damage_received) ?></td>
		<td><?php echo number_format($chars[$i]->healing_done) ?></td>
		<td><?php echo number_format($chars[$i]->kill_count) ?></td>
		<td><?php echo number_format($chars[$i]->death_count) ?></td>
		<td><?php echo number_format($chars[$i]->emp_damage_done) ?></td>
		<td><?php echo number_format($chars[$i]->emperium_kill) ?></td>
		<?php else: ?>
		<td colspan="8"></td>
		<?php endif ?>
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p>There are no characters. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>