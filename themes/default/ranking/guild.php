<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('RankingGuild')) ?></h2>
<h3>
	<?php echo htmlspecialchars(sprintf(Flux::message('RankingGuildTop'), number_format($limit=(int)Flux::config('GuildRankingLimit')))) ?>
	<?php echo htmlspecialchars(sprintf(Flux::message('RankingOn'), htmlspecialchars($server->serverName))) ?>
</h3>
<?php if ($guilds): ?>
	<table class="horizontal-table">
		<tr>
			<th><?php echo Flux::message('RankingRank')?></th>
			<th colspan="2"><?php echo Flux::message('AccountViewGuildLabel')?></th>
			<th><?php echo Flux::message('RankingGuildLevel')?></th>
			<th><?php echo Flux::message('RankingGuildCastle')?></th>
			<th><?php echo Flux::message('RankingGuildMembers')?></th>
			<th><?php echo Flux::message('RankingGuildAvgLevel')?></th>
			<th><?php echo Flux::message('RankingGuildExp')?></th>
		</tr>
		<?php for ($i = 0; $i < $limit; ++$i): ?>
		<tr<?php if (!isset($guilds[$i])) echo ' class="empty-row"'; if ($i === 0) echo ' class="top-ranked" title="'. sprintf(Flux::message('RankingGuildPopup'),htmlspecialchars($guilds[$i]->name)).'"' ?>>
			<td align="center"><?php echo number_format($i + 1) ?></td>
			<?php if (isset($guilds[$i])): ?>
			<?php if ($guilds[$i]->emblem_len): ?>
			<td width="24"><img src="<?php echo $this->emblem($guilds[$i]->guild_id) ?>" /></td>
			<?php endif ?>
			<td<?php if (!$guilds[$i]->emblem_len) echo ' colspan="2"' ?>><strong>
				<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
					<?php echo $this->linkToGuild($guilds[$i]->guild_id, $guilds[$i]->name) ?>
				<?php else: ?>
					<?php echo htmlspecialchars($guilds[$i]->name) ?>
				<?php endif ?>
			</strong></td>
			<td><?php echo number_format($guilds[$i]->guild_lv) ?></td>
			<td><?php echo number_format($guilds[$i]->castles) ?></td>
			<td><?php echo number_format($guilds[$i]->members) ?></td>
			<td><?php echo number_format($guilds[$i]->average_lv) ?></td>
			<td><?php echo number_format($guilds[$i]->exp) ?></td>
			<?php else: ?>
			<td colspan="8"></td>
			<?php endif ?>
		</tr>
		<?php endfor ?>
	</table>
<?php else: ?>
<p><?php echo Flux::message('RankingGuildNone') ?></p>
<?php endif ?>
