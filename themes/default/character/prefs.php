<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo Flux::message('WhosOnlineLabelTitre')?></h2>
<?php if ($char): ?>
<?php if (!empty($errorMessage)): ?>
<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php endif ?>
<h3><?php echo htmlspecialchars(sprintf(Flux::message('PreferencesSubtitle'), ($charName=htmlspecialchars($char->name)), htmlspecialchars($server->serverName))) ?></h3>
<form action="<?php echo $this->urlWithQs ?>" method="post" class="generic-form">
	<input type="hidden" name="charprefs" value="1" />
	<table class="generic-form-table">
		<tr>
			<th><label for="hide_from_whos_online"><?php echo Flux::message('PreferencesHidechar')?></label></th>
			<td><input type="checkbox" name="hide_from_whos_online" id="hide_from_whos_online"<?php if ($hideFromWhosOnline) echo ' checked="checked"' ?> /></td>
			<td><p><?php echo htmlspecialchars(sprintf(Flux::message('PreferencesHidecharExplain'), $charName)) ?></p></td>
		</tr>
		<tr>
			<th><label for="hide_map_from_whos_online"><?php echo Flux::message('PreferencesHidemap')?></label></th>
			<td><input type="checkbox" name="hide_map_from_whos_online" id="hide_map_from_whos_online"<?php if ($hideMapFromWhosOnline) echo ' checked="checked"' ?> /></td>
			<td><p><?php echo htmlspecialchars(sprintf(Flux::message('PreferencesHidemapExplain'), $charName)) ?></p></td>
		</tr>
		<?php if ($auth->allowedToHideFromZenyRank): ?>
		<tr>
			<th><label for="hide_from_zeny_ranking"><?php echo Flux::message('PreferencesHideZeny')?></label></th>
			<td><input type="checkbox" name="hide_from_zeny_ranking" id="hide_from_zeny_ranking"<?php if ($hideFromZenyRanking) echo ' checked="checked"' ?> /></td>
			<td><p><?php echo htmlspecialchars(sprintf(Flux::message('PreferencesHideZenyExplain'), $charName)) ?></p></td>
		</tr>
		<?php endif ?>
		<tr>
			<td align="right"><p><input type="submit" value="<?php echo Flux::message('PreferencesButton')?>" /></p></td>
			<td colspan="2"></td>
		</tr>
	</table>
</form>
<?php else: ?>
<p><?php echo Flux::message('PreferencesNotFound')?></p>
<?php endif ?>
