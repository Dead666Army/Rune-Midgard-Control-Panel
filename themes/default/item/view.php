<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('ItemView')) ?></h2>
<?php if ($item): ?>
<?php $icon = $this->iconImage($item->item_id); ?>
<h3>
	<?php if ($icon): ?><img src="<?php echo $icon ?>" /><?php endif ?>
	#<?php echo htmlspecialchars($item->item_id) ?>: <?php echo htmlspecialchars($item->name) ?>
</h3>
<table class="vertical-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemID')) ?></th>
		<td><?php echo htmlspecialchars($item->item_id) ?></td>
		<?php if ($image=$this->itemImage($item->item_id)): ?>
		<td rowspan="<?php echo ($server->isRenewal)?9:8 ?>" style="width: 150px; text-align: center; vertical-alignment: middle">
			<img src="<?php echo $image ?>" />
		</td>
		<?php endif ?>
		<th><?php echo htmlspecialchars(Flux::message('ItemSale')) ?></th>
		<td>
			<?php if ($item->cost): ?>
				<span class="for-sale yes">
					<?php echo htmlspecialchars(Flux::message('ItemYes')) ?>
				</span>
			<?php else: ?>
				<span class="for-sale no">
					<?php echo htmlspecialchars(Flux::message('ItemNo')) ?>
				</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemIdentifier')) ?></th>
		<td><?php echo htmlspecialchars($item->identifier) ?></td>
		<th><?php echo htmlspecialchars(Flux::message('ItemCashShop')) ?></th>
		<td>
			<?php if ($item->cost): ?>
				<?php echo number_format((int)$item->cost) ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ItemNotForSale')) ?></span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemName')) ?></th>
		<td><?php echo htmlspecialchars($item->name) ?></td>
		<th><?php echo htmlspecialchars(Flux::message('ItemType')) ?></th>
		<td><?php echo $this->itemTypeText($item->type, $item->view) ?></td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemBuy')) ?></th>
		<td><?php echo number_format((int)$item->price_buy) ?></td>
		<th><?php echo htmlspecialchars(Flux::message('ItemWeight')) ?></th>
		<td><?php echo round($item->weight, 1) ?></td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemSell')) ?></th>
		<td>
			<?php if (is_null($item->price_sell) && $item->price_buy): ?>
				<?php echo number_format(floor($item->price_buy / 2)) ?>
			<?php else: ?>
				<?php echo number_format((int)$item->price_sell) ?>
			<?php endif ?>
		</td>
		<th><?php echo htmlspecialchars(Flux::message('ItemWeaponLevel')) ?></th>
		<td><?php echo number_format((int)$item->weapon_level) ?></td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemRange')) ?></th>
		<td><?php echo number_format((int)$item->range) ?></td>
		<th><?php echo htmlspecialchars(Flux::message('ItemDefense')) ?></th>
		<td><?php echo number_format((int)$item->defence) ?></td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemSlots')) ?></th>
		<td><?php echo number_format((int)$item->slots) ?></td>
		<th><?php echo htmlspecialchars(Flux::message('ItemRefineable')) ?></th>
		<td>
			<?php if ($item->refineable): ?>
				<?php echo htmlspecialchars(Flux::message('ItemYes')) ?>
			<?php else: ?>
				<?php echo htmlspecialchars(Flux::message('ItemNo')) ?>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemAttack')) ?></th>
		<td><?php echo number_format((int)$item->attack) ?></td>
		<th><?php echo htmlspecialchars(Flux::message('ItemMinEquip')) ?></th>
		<td><?php echo number_format((int)$item->equip_level_min) ?></td>
	</tr>
	<?php if($server->isRenewal): ?>
	<tr>
		<th>MATK</th>
		<td><?php echo number_format((int)$item->matk) ?></td>
		<th>Max Equip Level</th>
		<td>
			<?php if ($item->equip_level_max == 0): ?>
				<span class="not-applicable">None</span>
			<?php else: ?>
				<?php echo number_format((int)$item->equip_level_max) ?>
			<?php endif ?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemLocation')) ?></th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($locs=$this->equipLocations($item->equip_locations)): ?>
				<?php echo htmlspecialchars(implode(' + ', $locs)) ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemEquipUpper')) ?></th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($upper=$this->equipUpper($item->equip_upper)): ?>
				<?php echo htmlspecialchars(implode(' / ', $upper)) ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneM')) ?></span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemEquipJobs')) ?></th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($jobs=$this->equippableJobs($item->equip_jobs)): ?>
				<?php echo htmlspecialchars(implode(' / ', $jobs)) ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneM')) ?></span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemEquipJobsGender')) ?></th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($item->equip_genders === '0'): ?>
				<?php echo htmlspecialchars(Flux::message('ItemEquipJobsGenderMale')) ?>
			<?php elseif ($item->equip_genders === '1'): ?>
				<?php echo htmlspecialchars(Flux::message('ItemEquipJobsGenderFemale')) ?>
			<?php elseif ($item->equip_genders === '2'): ?>
				<?php echo htmlspecialchars(Flux::message('ItemEquipJobsGenderBoth')) ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ItemUnknown')) ?></span>
			<?php endif ?>
		</td>
	</tr>
	<?php if (($isCustom && $auth->allowedToSeeItemDb2Scripts) || (!$isCustom && $auth->allowedToSeeItemDbScripts)): ?>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemScript')) ?></th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->script)): ?>
				<?php echo $script ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneM')) ?></span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemScriptEquip')) ?></th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->equip_script)): ?>
				<?php echo $script ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneM')) ?></span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemScriptUnEquip')) ?></th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->unequip_script)): ?>
				<?php echo $script ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneM')) ?></span>
			<?php endif ?>
		</td>
	</tr>
	<?php endif ?>
    <?php if(Flux::config('ShowItemDesc')):?>
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('ItemDescription')) ?></th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if($item->itemdesc): ?>
                <?php echo $item->itemdesc ?>
            <?php else: ?>
                <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('ListNoneF')) ?></span>
			<?php endif ?>
		</td>
	</tr>
    <?php endif ?>
    
</table>
<?php if ($itemDrops): ?>
<h3><?php echo htmlspecialchars($item->name) ?><?php echo htmlspecialchars(Flux::message('ItemDroppedBy')) ?></h3>
<table class="vertical-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('MonsterID')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('MonsterName')) ?></th>
		<th><?php echo htmlspecialchars($item->name) ?> <?php echo htmlspecialchars(Flux::message('MonsterDrop')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('MonsterLevel')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('MonsterRace')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('MonsterElement')) ?></th>
	</tr>
	<?php foreach ($itemDrops as $itemDrop): ?>
	<tr class="item-drop-<?php echo $itemDrop['type'] ?>">
		<td align="center">
			<?php if ($auth->actionAllowed('monster', 'view')): ?>
				<?php echo $this->linkToMonster($itemDrop['monster_id'], $itemDrop['monster_id']) ?>
			<?php else: ?>
				<?php echo $itemDrop['monster_id'] ?>
			<?php endif ?>
		</td>
		<td>
			<?php if ($itemDrop['type'] == 'mvp'): ?>
				<span class="mvp"><?php echo htmlspecialchars(Flux::message('MonsterMVP')) ?></span>
			<?php endif ?>
			<?php echo htmlspecialchars($itemDrop['monster_name']) ?>
		</td>
		<td align="center"><strong><?php echo $itemDrop['drop_chance'] ?>%</strong></td>
		<td align="center"><?php echo number_format($itemDrop['monster_level']) ?></td>
		<td><?php echo Flux::monsterRaceName($itemDrop['monster_race']) ?></td>
		<td>
			<em><?php echo Flux::elementName($itemDrop['monster_element']) ?></em>
			<?php echo floor($itemDrop['monster_ele_lv']) ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>

<?php else: ?>
<p><?php echo Flux::message('ItemNone') ?></p>
<?php endif ?>
