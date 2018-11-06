<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo Flux::message('WhosOnlineLabelTitre')?></h2>
<h3><?php printf(Flux::message('WhosOnlineLabelDesc'), htmlspecialchars($server->serverName))?></h3>
<?php if ($auth->allowedToSearchWhosOnline): ?>
	<p class="toggler"><a href="javascript:toggleSearchForm()"><?php echo Flux::message('SearchLabel')?></a></p>
	<form action="<?php echo $this->url ?>" method="get" class="search-form">
		<?php echo $this->moduleActionFormInputs($params->get('module'), $params->get('action')) ?>
		<p>
			<label for="char_name"><?php echo Flux::message('TransferCharNameLabel')?> : </label>
			<input type="text" name="char_name" id="char_name" value="<?php echo htmlspecialchars($params->get('char_name')) ?>" />
			...
			<label for="char_class"><?php echo Flux::message('AccountViewClassLabel')?> : </label>
			<input type="text" name="char_class" id="char_class" value="<?php echo htmlspecialchars($params->get('char_class')) ?>" />
			...
			<label for="guild_name"><?php echo Flux::message('AccountViewGuildLabel')?> : </label>
			<input type="text" name="guild_name" id="guild_name" value="<?php echo htmlspecialchars($params->get('guild_name')) ?>" />

			<input type="submit" value="<?php echo Flux::message('ButtonSearch')?>" />
			<input type="button" value="<?php echo Flux::message('ButtonReset')?>" onclick="reload()" />
		</p>
	</form>
<?php endif ?>
<?php if ($chars): ?>
<?php echo $paginator->infoText() ?>

<?php if ($hiddenCount): ?>
<p><?php printf(Flux::message('HiddenFromList'), number_format($hiddenCount))?></p>
<?php endif ?>

<table class="horizontal-table">
	<tr>
		<th><?php echo $paginator->sortableColumn('char_name', Flux::message('TransferCharNameLabel')) ?></th>
		<th><?php echo Flux::message('AccountViewClassLabel')?></th>
		<th><?php echo $paginator->sortableColumn('base_level', Flux::message('AccountViewLvlLabel')) ?></th>
		<th><?php echo $paginator->sortableColumn('job_level', Flux::message('AccountViewJlvlLabel')) ?></th>
		<th colspan="2"><?php echo $paginator->sortableColumn('guild_name', Flux::message('AccountViewGuildLabel')) ?></th>
		<?php if ($auth->allowedToViewOnlinePosition): ?>
			<th><?php echo $paginator->sortableColumn('last_map', Flux::message('CashLogMapLabel')) ?></th>
		<?php else: ?>
			<th><?php echo Flux::message('CashLogMapLabel') ?></th>
		<?php endif ?>
	</tr>
	<?php foreach ($chars as $char): ?>
	<tr>
		<td align="right">
			<?php if ($auth->actionAllowed('character', 'view') && $auth->allowedToViewCharacter): ?>
				<?php echo $this->linkToCharacter($char->char_id, $char->char_name) ?>
			<?php else: ?>
				<?php echo htmlspecialchars($char->char_name) ?>
			<?php endif ?>
		</td>
		<td><?php echo $this->jobClassText($char->char_class) ?></td>
		<td><?php echo number_format($char->base_level) ?></td>
		<td><?php echo number_format($char->job_level) ?></td>
		<?php if ($char->guild_name): ?>
			<?php if ($char->guild_emblem_len): ?>
			<td width="20"><img src="<?php echo $this->emblem($char->guild_id) ?>" /></td>
			<?php endif ?>
			<td<?php if (!$char->guild_emblem_len) echo ' colspan="2"' ?>>
				<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
					<?php echo $this->linkToGuild($char->guild_id, $char->guild_name) ?>
				<?php else: ?>
					<?php echo htmlspecialchars($char->guild_name) ?>
				<?php endif ?>
			</td>
		<?php else: ?>
			<td colspan="2"><span class="not-applicable"><?php echo Flux::message('ListNoneF') ?></span></td>
		<?php endif ?>
		
		<td>
		<?php if (!$char->hidemap && $auth->allowedToViewOnlinePosition): ?>
			<?php echo htmlspecialchars(basename($char->last_map, '.gat')) ?>
		<?php else: ?>
			<span class="not-applicable"><?php echo Flux::message('ListHidden') ?></span>
		<?php endif ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php echo $paginator->getHTML() ?>
<?php else: ?>
<p><?php printf(Flux::message('WhosOnlineLabelEmpty'), htmlspecialchars($server->serverName))?></p>
<?php endif ?>
