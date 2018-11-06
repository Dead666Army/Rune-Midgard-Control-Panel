<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>MVP Ranking</h2>
<h3>Search</h3>
<form action="" method="get" class="search-form2">
	<?php echo $this->moduleActionFormInputs('rankingpvm', 'mvp') ?>
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
		<label for="mvpdata">Filter by monster: </label>
		<select name="mvpdata" id="mvpdata">
		<option value="0">All</option>
		<?php foreach ($moblist as $mob): ?>
			<option value="<?php echo $mob->id ?>" <?php if(!is_null($mvpdata) && $mvpdata == $mob->id) echo  'selected="selected"';?>>
				<?php echo htmlspecialchars($mob->iName) ?>
			</option>
		<?php endforeach ?>
		</select>
		<label for="rankingTypesFilter"> Classement type: </label>
		<select name="rankingTypesFilter" id="rankingTypesFilter">
		<?php foreach ($rankingTypes as $rankingTypeKey=>$rankingTypeValue): ?>
			<option value="<?php echo $rankingTypeKey ?>"
            <?php if (!is_null($rankingTypesFilter) && $rankingTypesFilter == $rankingTypeKey) echo ' selected="selected"' ?>>
				<?php echo $rankingTypeValue; ?>
			</option>
		<?php endforeach ?>
		</select>
		<input type="submit" value="<?php echo Flux::message('RankingFilter')?>" />
		<input type="button" value="<?php echo Flux::message('ButtonReset')?>" onclick="reload()" />
	</p>
</form>



<?php $i=0; ?>
<?php if($mvpdata and $mvpdata != 0): ?><!-- Specific -->
    <?php if($kills):?>
    <table class="horizontal-table">
    	<tr>
			<th><?php echo Flux::message('RankingRank') ?></th>
			<th><?php echo Flux::message('MVPLogCharacterLabel') ?></th>
			<th><?php echo htmlspecialchars(Flux::message('JobClassLabel')) ?></th>
			<th colspan="2"><?php echo htmlspecialchars(Flux::message('GuildNameLabel')) ?></th>
    		<th><?php echo Flux::message('MVPLogMonsterLabel') ?></th>
    		<th>Kills</th>
    	</tr>
    	<?php foreach ($kills as $kill): ?>
		<?php $i++;?>
    	<tr<?php if ($i === 1) echo ' class="top-ranked"' ?>>
			<td align="center"><?php echo number_format($i) ?></td>
    		<td align="center">
    			<?php if ($kill->kill_char_id): ?>
    				<?php if ($auth->actionAllowed('character', 'view') && $auth->allowedToViewCharacter): ?>
    					<?php echo $this->linkToCharacter($kill->kill_char_id, $kill->name) ?>
    				<?php else: ?>
    					<?php echo $kill->name ?>
    				<?php endif ?>
    			<?php else: ?>
    				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
    			<?php endif ?>
    		</td>
			<td><?php echo $this->jobClassText($kill->char_class) ?></td>
			<?php if ($kill->guild_name): ?>
			<?php if ($kill->guild_emblem_len): ?>
			<td width="24"><img src="<?php echo $this->emblem($kill->guild_id) ?>" /></td>
			<?php endif ?>
			<td<?php if (!$kill->guild_emblem_len) echo ' colspan="2"' ?>>
				<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
					<?php echo $this->linkToGuild($kill->guild_id, $kill->guild_name) ?>
				<?php else: ?>
					<?php echo htmlspecialchars($kill->guild_name) ?>
				<?php endif ?>
			</td>
			<?php else: ?>
			<td colspan="2"><span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneF')) ?></span></td>
			<?php endif ?>
			<td align="center">
    		<?php if ($auth->actionAllowed('monster', 'view')): ?>
    				<?php echo $this->linkToMonster($kill->monster_id, $kill->iName) ?>
    			<?php else: ?>
    				<?php echo htmlspecialchars($kill->iName) ?>
    			<?php endif ?>
			</td>
    		<td align="center"><?php echo htmlspecialchars(number_format($kill->count)) ?></td>
        </tr>
        <?php endforeach ?>
    </table>
    <?php else: ?>
    <p>
    	<?php echo htmlspecialchars(Flux::message('MVPLogNotFound')) ?>
    	<a href="javascript:history.go(-1)"><?php echo htmlspecialchars(Flux::message('GoBackLabel')) ?></a>
    </p>
    <?php endif ?>

<?php else: ?><!-- All mvp -->
    <?php if($kills):?>
    <table class="horizontal-table">
    	<tr>
			<th><?php echo Flux::message('RankingRank') ?></th>
			<th><?php echo Flux::message('MVPLogCharacterLabel') ?></th>
			<th><?php echo htmlspecialchars(Flux::message('JobClassLabel')) ?></th>
			<th colspan="2"><?php echo htmlspecialchars(Flux::message('GuildNameLabel')) ?></th>
    		<th>Kills</th>
    	</tr>
    	<?php foreach ($kills as $kill): ?>
		<?php $i++;?>
    	<tr<?php if ($i === 1) echo ' class="top-ranked"' ?>>
			<td align="center"><?php echo number_format($i) ?></td>
			<td align="center">
    			<?php if ($kill->kill_char_id): ?>
    				<?php if ($auth->actionAllowed('character', 'view') && $auth->allowedToViewCharacter): ?>
    					<?php echo $this->linkToCharacter($kill->kill_char_id, $kill->name) ?>
    				<?php else: ?>
    					<?php echo $kill->name ?>
    				<?php endif ?>
    			<?php else: ?>
    				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
    			<?php endif ?>
    		</td>
			<td><?php echo $this->jobClassText($kill->char_class) ?></td>
			<?php if ($kill->guild_name): ?>
			<?php if ($kill->guild_emblem_len): ?>
			<td width="24"><img src="<?php echo $this->emblem($kill->guild_id) ?>" /></td>
			<?php endif ?>
			<td<?php if (!$kill->guild_emblem_len) echo ' colspan="2"' ?>>
				<?php if ($auth->actionAllowed('guild', 'view') && $auth->allowedToViewGuild): ?>
					<?php echo $this->linkToGuild($kill->guild_id, $kill->guild_name) ?>
				<?php else: ?>
					<?php echo htmlspecialchars($kill->guild_name) ?>
				<?php endif ?>
			</td>
			<?php else: ?>
			<td colspan="2"><span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneF')) ?></span></td>
			<?php endif ?>
			<td align="center"><?php echo htmlspecialchars(number_format($kill->count)) ?></td>
        </tr>
        <?php endforeach ?>
    </table>
    <?php else: ?>
    <p>
    	<?php echo htmlspecialchars(Flux::message('MVPLogNotFound')) ?>
    	<a href="javascript:history.go(-1)"><?php echo htmlspecialchars(Flux::message('GoBackLabel')) ?></a>
    </p>
    <?php endif ?>
<?php endif ?>
