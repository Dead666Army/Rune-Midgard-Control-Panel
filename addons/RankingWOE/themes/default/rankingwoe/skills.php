<?php 


if (!defined('FLUX_ROOT')) exit; ?>

<h2><?php echo Flux::message('Skilllabel') ?></h2>
<h3>
	Top <?php echo number_format($limit=(int)Flux::config('WOERankingLimit')) ?> Players
	<?php if (!is_null($jobClass)): ?>
	(<?php echo htmlspecialchars($className=$this->jobClassText($jobClass)) ?>)
	<?php endif ?>
	on <?php echo htmlspecialchars($server->serverName) ?> FOR <?php echo $dispWoeDate;?>
</h3>
<?php if ($chars): ?>
<form action="" method="get" class="search-form2">
	<?php echo $this->moduleActionFormInputs('rankingwoe', 'skills') ?>
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
		<th><?php echo $paginator->sortableColumn('healing_done', htmlspecialchars(Flux::message('HealDone'))); ?></th>
		<th><?php echo $paginator->sortableColumn('wrong_healing_done', htmlspecialchars(Flux::message('WrongHealDone'))); ?></th>
		<th><?php echo $paginator->sortableColumn('support_skills_used', htmlspecialchars(Flux::message('SupportS'))); ?></th>
		<th><?php echo $paginator->sortableColumn('wrong_support_skills_used', htmlspecialchars(Flux::message('WrongSupportS'))); ?></th>
		<th><?php echo $paginator->sortableColumn('sp_used', htmlspecialchars(Flux::message('SPUsed'))); ?></th>
		<th><?php echo $paginator->sortableColumn('spiritb_used', htmlspecialchars(Flux::message('SpiritbUsed'))); ?></th>
		<th><?php echo $paginator->sortableColumn('zeny_used', htmlspecialchars(Flux::message('ZenyUsed'))); ?></th>
	</tr>
	<?php $topRankType = !is_null($jobClass) ? $className : 'character' ?>
	<?php for ($i = 0; $i < $limit; ++$i): ?>
	<tr <?php if (!isset($chars[$i])) echo ' class="empty-row"'; if ($i === 0) echo ' class="top-ranked" title="<strong>'.htmlspecialchars($chars[$i]->char_name).'</strong> '.htmlspecialchars(Flux::message('TopRankedLabel')).' '.$topRankType.'!"' ?>>
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
		<td><?php echo number_format($chars[$i]->healing_done) ?></td>
		<td><?php echo number_format($chars[$i]->wrong_healing_done) ?></td>
		<td><?php echo number_format($chars[$i]->support_skills_used) ?></td>
		<td><?php echo number_format($chars[$i]->wrong_support_skills_used) ?></td>
		<td><?php echo number_format($chars[$i]->sp_used) ?></td>
		<td><?php echo number_format($chars[$i]->spiritb_used) ?></td>
		<td><?php echo number_format($chars[$i]->zeny_used) ?></td>
		<?php else: ?>
		<td colspan="8"></td>
		<?php endif ?>
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p>There are no characters. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>