<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('RankingHomunculus')) ?></h2>
<h3>
	<?php echo htmlspecialchars(sprintf(Flux::message('RankingHomunculusTop'), number_format($limit=(int)Flux::config('HomunRankingLimit')))) ?>
	<?php if (!is_null($homunClass)): ?>
	(<?php echo htmlspecialchars($className=$this->homunClassText($homunClass)) ?>)
	<?php endif ?>
	<?php echo htmlspecialchars(sprintf(Flux::message('RankingOn'), htmlspecialchars($server->serverName))) ?>
</h3>
<?php if ($homuns): ?>
<form action="" method="get" class="search-form2">
	<?php echo $this->moduleActionFormInputs('ranking', 'homunculus') ?>
	<p>
		<label for="homunclass"><?php echo htmlspecialchars(Flux::message('RankingFilterLabel')) ?></label>
		<select name="homunclass" id="homunclass">
			<option value=""<?php if (is_null($homunClass)) echo 'selected="selected"' ?>><?php echo htmlspecialchars(Flux::message('RankingAll')) ?></option>
		<?php foreach ($classes as $homunClassIndex => $homunClassName): ?>
			<option value="<?php echo $homunClassIndex ?>"
				<?php if (!is_null($homunClass) && $homunClass == $homunClassIndex) echo ' selected="selected"' ?>>
				<?php echo htmlspecialchars($homunClassName) ?>
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
		<th><?php echo Flux::message('RankingHomunculusLabel') ?></th>
		<th><?php echo Flux::message('RankingHomunculusOwner') ?></th>
		<th colspan="2"><?php echo Flux::message('AccountViewGuildLabel')?></th>
		<th><?php echo Flux::message('RankingHomunculusIntimacy') ?></th>
		<th><?php echo Flux::message('RankingHomunculusLevel') ?></th>
		<th><?php echo Flux::message('RankingHomunculusExp') ?></th>
	</tr>
	<?php $topRankType = !is_null($homunClass) ? $className : 'homunculus' ?>
	<?php for ($i = 0; $i < $limit; ++$i): ?>
	<tr<?php if (!isset($homuns[$i])) echo ' class="empty-row"'; if ($i === 0) echo ' class="top-ranked" title="'. sprintf(Flux::message('RankingHomunculusPopup'),htmlspecialchars($homuns[$i]->homun_name),$topRankType).'"' ?>>
		<td align="center"><?php echo number_format($i + 1) ?></td>
		<?php if (isset($homuns[$i])): ?>
			<td><strong><?php echo htmlspecialchars($homuns[$i]->homun_name) ?></strong></td>
			<td><strong>
			<?php if ($auth->actionAllowed('character', 'view') && $auth->allowedToViewCharacter): ?>
				<?php echo $this->linkToCharacter($homuns[$i]->owner, $homuns[$i]->owner_name) ?>
			<?php else: ?>
				<?php echo htmlspecialchars($homuns[$i]->owner_name) ?>
			<?php endif ?>
			</strong></td>
			<?php if ($homuns[$i]->guild_name): ?>
				<?php if ($homuns[$i]->guild_emblem_len): ?>
					<td width="24"><img src="<?php echo $this->emblem($homuns[$i]->guild_id) ?>" /></td>
				<?php endif ?>
				<td<?php if (!$homuns[$i]->guild_emblem_len) echo ' colspan="2"' ?>>
					<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
						<?php echo $this->linkToGuild($homuns[$i]->guild_id, $homuns[$i]->guild_name) ?>
					<?php else: ?>
						<?php echo htmlspecialchars($homuns[$i]->guild_name) ?>
					<?php endif ?>
				</td>
			<?php else: ?>
				<td colspan="2"><span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneF')) ?></span></td>
			<?php endif ?>
			<td><?php echo number_format($homuns[$i]->intimacy) ?></td>
			<td><?php echo number_format($homuns[$i]->level) ?></td>
			<td><?php echo number_format($homuns[$i]->exp) ?></td>
		<?php else: ?>
		<td colspan="8"></td>
		<?php endif ?>
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p><?php echo Flux::message('RankingHomunculusNone')?></p>
<?php endif ?>
