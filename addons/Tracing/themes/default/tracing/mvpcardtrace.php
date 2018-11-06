<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('TraceMVPTitle')) ?></h2>
<?php if ($CardsInventory or $CardsStorage or $CardsGStorage or $CardsCart): ?>
<p><?php echo htmlspecialchars(Flux::message('TraceMVPDesc')) ?></p>
<table class="horizontal-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('Itemid')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('ItemName')) ?></th>
	</tr>
	<?php for ($i = 0; $i < sizeof($CardsInventory); $i++): ?>
	<tr>
        <?php if (array_key_exists ( $CardsInventory[$i]->nameid , $cards )) {?>
            <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsInventory[$i]->nameid )); ?>"><?php echo $CardsInventory[$i]->nameid; ?></a></td>
            <td align='center'><?php echo $cards[$CardsInventory[$i]->nameid] ?></td>
        <?php
        }else{
            $cardnb = 0;
            if (array_key_exists ( $CardsInventory[$i]->card0 , $cards )) {?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsInventory[$i]->card0 )); ?>"><?php echo $CardsInventory[$i]->card0; ?></a></td>
                <td align='center'><?php echo $cards[$CardsInventory[$i]->card0] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsInventory[$i]->card1 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsInventory[$i]->card1 )); ?>"><?php echo $CardsInventory[$i]->card1; ?></a></td>
                <td align='center'><?php echo $cards[$CardsInventory[$i]->card1] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsInventory[$i]->card2 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsInventory[$i]->card2 )); ?>"><?php echo $CardsInventory[$i]->card2; ?></a></td>
                <td align='center'><?php echo $cards[$CardsInventory[$i]->card2] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsInventory[$i]->card3 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsInventory[$i]->card3 )); ?>"><?php echo $CardsInventory[$i]->card3; ?></a></td>
                <td align='center'><?php echo $cards[$CardsInventory[$i]->card3] ?></td>
                <?php
                $cardnb ++;
            }
        } 
        ?>
	</tr>
	<?php endfor ?>
    <?php for ($i = 0; $i < sizeof($CardsStorage); $i++): ?>
	<tr>
        <?php if (array_key_exists ( $CardsStorage[$i]->nameid , $cards )) {?>
            <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsStorage[$i]->nameid )); ?>"><?php echo $CardsStorage[$i]->nameid; ?></a></td>
            <td align='center'><?php echo $cards[$CardsStorage[$i]->nameid] ?></td>
        <?php
        }else{
            $cardnb = 0;
            if (array_key_exists ( $CardsStorage[$i]->card0 , $cards )) {?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsStorage[$i]->card0 )); ?>"><?php echo $CardsStorage[$i]->card0; ?></a></td>
                <td align='center'><?php echo $cards[$CardsStorage[$i]->card0] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsStorage[$i]->card1 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsStorage[$i]->card1 )); ?>"><?php echo $CardsStorage[$i]->card1; ?></a></td>
                <td align='center'><?php echo $cards[$CardsStorage[$i]->card1] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsStorage[$i]->card2 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsStorage[$i]->card2 )); ?>"><?php echo $CardsStorage[$i]->card2; ?></a></td>
                <td align='center'><?php echo $cards[$CardsStorage[$i]->card2] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsStorage[$i]->card3 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsStorage[$i]->card3 )); ?>"><?php echo $CardsStorage[$i]->card3; ?></a></td>
                <td align='center'><?php echo $cards[$CardsStorage[$i]->card3] ?></td>
                <?php
                $cardnb ++;
            }
        } 
        ?>
	</tr>
	<?php endfor ?>
    <?php for ($i = 0; $i < sizeof($CardsGStorage); $i++): ?>
	<tr>
        <?php if (array_key_exists ( $CardsGStorage[$i]->nameid , $cards )) {?>
            <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsGStorage[$i]->nameid )); ?>"><?php echo $CardsGStorage[$i]->nameid; ?></a></td>
            <td align='center'><?php echo $cards[$CardsGStorage[$i]->nameid] ?></td>
        <?php
        }else{
            $cardnb = 0;
            if (array_key_exists ( $CardsGStorage[$i]->card0 , $cards )) {?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsGStorage[$i]->card0 )); ?>"><?php echo $CardsGStorage[$i]->card0; ?></a></td>
                <td align='center'><?php echo $cards[$CardsGStorage[$i]->card0] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsGStorage[$i]->card1 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsGStorage[$i]->card1 )); ?>"><?php echo $CardsGStorage[$i]->card1; ?></a></td>
                <td align='center'><?php echo $cards[$CardsGStorage[$i]->card1] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsGStorage[$i]->card2 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsGStorage[$i]->card2 )); ?>"><?php echo $CardsGStorage[$i]->card2; ?></a></td>
                <td align='center'><?php echo $cards[$CardsGStorage[$i]->card2] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsGStorage[$i]->card3 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsGStorage[$i]->card3 )); ?>"><?php echo $CardsGStorage[$i]->card3; ?></a></td>
                <td align='center'><?php echo $cards[$CardsGStorage[$i]->card3] ?></td>
                <?php
                $cardnb ++;
            }
        } 
        ?>
	</tr>
	<?php endfor ?>
    <?php for ($i = 0; $i < sizeof($CardsCart); $i++): ?>
	<tr>
        <?php if (array_key_exists ( $CardsCart[$i]->nameid , $cards )) {?>
            <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsCart[$i]->nameid )); ?>"><?php echo $CardsCart[$i]->nameid; ?></a></td>
            <td align='center'><?php echo $cards[$CardsCart[$i]->nameid] ?></td>
        <?php
        }else{
            $cardnb = 0;
            if (array_key_exists ( $CardsCart[$i]->card0 , $cards )) {?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsCart[$i]->card0 )); ?>"><?php echo $CardsCart[$i]->card0; ?></a></td>
                <td align='center'><?php echo $cards[$CardsCart[$i]->card0] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsCart[$i]->card1 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsCart[$i]->card1 )); ?>"><?php echo $CardsCart[$i]->card1; ?></a></td>
                <td align='center'><?php echo $cards[$CardsCart[$i]->card1] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsCart[$i]->card2 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsCart[$i]->card2 )); ?>"><?php echo $CardsCart[$i]->card2; ?></a></td>
                <td align='center'><?php echo $cards[$CardsCart[$i]->card2] ?></td>
                <?php
                $cardnb ++;
            }
            if (array_key_exists ( $CardsCart[$i]->card3 , $cards )) {
                if  ($cardnb > 0){echo "</tr><tr>"; $cardnb--;}?>
                <td align='center'> <a href="<?php echo $this->url('item', 'view', array("id" => $CardsCart[$i]->card3 )); ?>"><?php echo $CardsCart[$i]->card3; ?></a></td>
                <td align='center'><?php echo $cards[$CardsCart[$i]->card3] ?></td>
                <?php
                $cardnb ++;
            }
        } 
        ?>
	</tr>
	<?php endfor ?>
</table>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('TraceMVPNoCards')) ?> <a href="javascript:history.go(-1)"><?php echo htmlspecialchars(Flux::message('GoBackLabel')) ?></a>.</p>
<?php endif ?>

