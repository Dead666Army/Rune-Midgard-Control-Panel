<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('RankingCharacter')) ?></h2>
<h3>
	<?php echo htmlspecialchars(sprintf(Flux::message('RankingTop'), number_format($limit=(int)Flux::config('CharRankingLimit')))) ?>
	<?php if (!is_null($jobClass)): ?>
	(<?php echo htmlspecialchars($className=$this->jobClassText($jobClass)) ?>)
	<?php endif ?>
	<?php echo htmlspecialchars(sprintf(Flux::message('RankingOn'), htmlspecialchars($server->serverName))) ?>
</h3>
<?php if ($chars): ?>
<form action="" method="get" class="search-form2">
	<?php echo $this->moduleActionFormInputs('ranking', 'character') ?>
	<p>
		<label for="jobclass"><?php echo htmlspecialchars(Flux::message('RankingFilterLabel')) ?></label>
		<select name="jobclass" id="jobclass">
			<option value=""<?php if (is_null($jobClass)) echo 'selected="selected"' ?>><?php echo htmlspecialchars(Flux::message('RankingAll')) ?></option>
		<?php foreach ($classes as $jobClassIndex => $jobClassName): ?>
			<option value="<?php echo $jobClassIndex ?>"
				<?php if (!is_null($jobClass) && $jobClass == $jobClassIndex) echo ' selected="selected"' ?>>
				<?php echo htmlspecialchars($jobClassName) ?>
			</option>
		<?php endforeach ?>
		</select>
		
		<input type="submit" value="<?php echo Flux::message('RankingFilter')?>" />
		<input type="button" value="<?php echo Flux::message('ButtonReset')?>" onclick="reload()" />
	</p>
</form>
<table class="horizontal-table">
	<tr>
		<th><?php echo Flux::message('RankingRank')?></th>
		<th><?php echo Flux::message('TransferCharNameLabel')?></th>
		<th><?php echo Flux::message('AccountViewClassLabel')?></th>
		<th colspan="2"><?php echo Flux::message('AccountViewGuildLabel')?></th>
		<th><?php echo Flux::message('AccountViewLvlLabel')?></th>
		<th><?php echo Flux::message('AccountViewJlvlLabel')?></th>
		<th><?php echo Flux::message('RankingBaseExp')?></th>
		<th><?php echo Flux::message('RankingJobExp')?></th>
	</tr>
	<?php $topRankType = !is_null($jobClass) ? $className : Flux::message('RankingCharacterLabel') ?>
	<?php for ($i = 0; $i < $limit; ++$i): ?>
	<tr<?php if (!isset($chars[$i])) echo ' class="empty-row"'; if ($i === 0) echo ' class="top-ranked" title="'. sprintf(Flux::message('RankingPopup'),htmlspecialchars($chars[$i]->char_name),$topRankType).'"' ?>>
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
		<td><?php echo number_format($chars[$i]->base_level) ?></td>
		<td><?php echo number_format($chars[$i]->job_level) ?></td>
		<td><?php echo number_format($chars[$i]->base_exp) ?></td>
		<td><?php echo number_format($chars[$i]->job_exp) ?></td>
		<?php else: ?>
		<td colspan="8"></td>
		<?php endif ?>
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p><?php echo Flux::message('MapStatNone') ?></p>
<?php endif ?>
