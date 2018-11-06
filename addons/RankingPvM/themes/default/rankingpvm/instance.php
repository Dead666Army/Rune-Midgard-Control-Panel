<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars($title); ?></h2>
<form action="" method="get" class="search-form2">
	<?php echo $this->moduleActionFormInputs('rankingpvm', 'instance') ?>
	<p>
		<label for="instanceFilter">Instance: </label>
		<select name="instanceFilter" id="instanceFilter">
		<?php foreach ($instances as $instanceKey=>$instanceValue): ?>
			<option value="<?php echo $instanceKey ?>"
            <?php if (!is_null($instanceFilter) && $instanceFilter == $instanceKey) echo ' selected="selected"' ?>>
				<?php echo $instanceValue; ?>
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
		<input type="submit" value="Voir" />
	</p>
    <?php if(!is_null($instanceFilter)){?>
        <div align="center"><img src="<?php echo $instancesImages[$instanceFilter];?>" width="30%" height="30%" alt="Instance Banner"></div>
        <br>
        <?php if($instanceTeams){ ?>
            <table class="horizontal-table">
                <tr>
                    <th><?php echo Flux::message('RankingRank') ?></th>
                    <th>Time</th>
                    <th>Date</th>
                    <th colspan=8>Players</th>
                </tr>
                <?php for ($i = 0; $i < sizeof($instanceTeams); $i++): ?>
                    <tr<?php if ($i === 0) echo ' class="top-ranked"' ?>>
                        <td align="center"><?php echo number_format($i + 1) ?></td>
                        <?php 
                        $hours = floor($instanceTeams[$i]->temps / 3600);
                        $mins = floor($instanceTeams[$i]->temps / 60 % 60);
                        $secs = floor($instanceTeams[$i]->temps % 60);
                        $timeFormat = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                        ?>
                        <td align='center'><?php echo  $timeFormat ?></td>
                        <td align='center'><?php echo $instanceTeams[$i]->date_instance ?></td>
                        <td><?php echo $instanceTeams[$i]->char1 ?></td>
                        <td><?php echo $instanceTeams[$i]->char2 ?></td>
                        <td><?php echo $instanceTeams[$i]->char3 ?></td>
                        <td><?php echo $instanceTeams[$i]->char4 ?></td>
                        <td><?php echo $instanceTeams[$i]->char5 ?></td>
                        <td><?php echo $instanceTeams[$i]->char6 ?></td>
                        <td><?php echo $instanceTeams[$i]->char7 ?></td>
                        <td><?php echo $instanceTeams[$i]->char8 ?></td>
                        
                    </tr>
                <?php endfor ?>
            </table>
        <?php }else { 
            echo "Personne n'a battu cette instance en dfficulté cauchemar"; 
            if(!is_null($rankingTypesFilter) && $rankingTypesFilter=="Current"){
                echo " ce mois-ci"; 
            } 
            echo ".";
        }?>
    <?php } ?>
</form>