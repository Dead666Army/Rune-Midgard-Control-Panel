<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('ItemTitle')) ?></h2>
<p class="toggler"><a href="javascript:toggleSearchForm()"><?php echo Flux::message('SearchLabel')?></a></p>
<form class="search-form" method="get">
	<?php echo $this->moduleActionFormInputs($params->get('module')) ?>
	<p>
		<label for="item_id"><?php echo Flux::message('ItemID')?> :</label>
		<input type="text" name="item_id" id="item_id" value="<?php echo htmlspecialchars($params->get('item_id')) ?>" />
		...
		<label for="name"><?php echo Flux::message('ItemName')?> :</label>
		<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($params->get('name')) ?>" />
		...
		<label for="type"><?php echo Flux::message('ItemType')?> :</label>
		<select name="type">
			<option value="-1"<?php if (($type=$params->get('type')) === '-1') echo ' selected="selected"' ?>>
			<?php echo Flux::message('ItemAny')?>
			</option>
			<?php foreach (Flux::config('ItemTypes')->toArray() as $typeId => $typeName): ?>
				<option value="<?php echo $typeId ?>"<?php if (($type=$params->get('type')) === strval($typeId)) echo ' selected="selected"' ?>>
					<?php echo htmlspecialchars($typeName) ?>
				</option>
				<?php $itemTypes2 = Flux::config('ItemTypes2')->toArray() ?>
				<?php if (array_key_exists($typeId, $itemTypes2)): ?>
					<?php foreach ($itemTypes2[$typeId] as $typeId2 => $typeName2): ?>
					<option value="<?php echo $typeId ?>-<?php echo $typeId2 ?>"<?php if (($type=$params->get('type')) === ($typeId . '-' . $typeId2)) echo ' selected="selected"' ?>>
						<?php echo htmlspecialchars($typeName . ' - ' . $typeName2) ?>
					</option>
					<?php endforeach ?>
				<?php endif ?>
			<?php endforeach ?>
		</select>
		...
		<label for="equip_loc"><?php echo Flux::message('ItemLocation')?> :</label>
		<select name="equip_loc">
			<option value="-1"<?php if (($equip_loc=$params->get('equip_loc')) === '-1') echo ' selected="selected"' ?>>
			<?php echo Flux::message('ItemAny')?>
			</option>
			<?php foreach (Flux::config('EquipLocationCombinations')->toArray() as $locId => $locName): ?>
				<option value="<?php echo $locId ?>"<?php if (($equip_loc=$params->get('equip_loc')) === strval($locId)) echo ' selected="selected"' ?>>
					<?php echo htmlspecialchars($locName) ?>
				</option>
			<?php endforeach ?>
		</select>
	</p>
	<p>
		<label for="npc_buy"><?php echo Flux::message('ItemBuy')?> :</label>
		<select name="npc_buy_op">
			<option value="eq"<?php if (($npc_buy_op=$params->get('npc_buy_op')) == 'eq') echo ' selected="selected"' ?>><?php echo Flux::message('ItemEqual')?></option>
			<option value="gt"<?php if ($npc_buy_op == 'gt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemGreater')?></option>
			<option value="lt"<?php if ($npc_buy_op == 'lt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemLess')?></option>
		</select>
		<input type="text" name="npc_buy" id="npc_buy" value="<?php echo htmlspecialchars($params->get('npc_buy')) ?>" />
		...
		<label for="npc_sell"><?php echo Flux::message('ItemSell')?> :</label>
		<select name="npc_sell_op">
			<option value="eq"<?php if (($npc_sell_op=$params->get('npc_sell_op')) == 'eq') echo ' selected="selected"' ?>><?php echo Flux::message('ItemEqual')?></option>
			<option value="gt"<?php if ($npc_sell_op == 'gt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemGreater')?></option>
			<option value="lt"<?php if ($npc_sell_op == 'lt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemLess')?></option>
		</select>
		<input type="text" name="npc_sell" id="npc_sell" value="<?php echo htmlspecialchars($params->get('npc_sell')) ?>" />
		...
		<label for="weight"><?php echo Flux::message('ItemWeight')?> :</label>
		<select name="weight_op">
			<option value="eq"<?php if (($weight_op=$params->get('weight_op')) == 'eq') echo ' selected="selected"' ?>><?php echo Flux::message('ItemEqual')?></option>
			<option value="gt"<?php if ($weight_op == 'gt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemGreater')?></option>
			<option value="lt"<?php if ($weight_op == 'lt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemLess')?></option>
		</select>
		<input type="text" name="weight" id="weight" value="<?php echo htmlspecialchars($params->get('weight')) ?>" />
	</p>
	<p>
		<label for="range"><?php echo Flux::message('ItemRange')?> :</label>
		<select name="range_op">
			<option value="eq"<?php if (($range_op=$params->get('range_op')) == 'eq') echo ' selected="selected"' ?>><?php echo Flux::message('ItemEqual')?></option>
			<option value="gt"<?php if ($range_op == 'gt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemGreater')?></option>
			<option value="lt"<?php if ($range_op == 'lt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemLess')?></option>
		</select>
		<input type="text" name="range" id="range" value="<?php echo htmlspecialchars($params->get('range')) ?>" />
		...
		<label for="slots"><?php echo Flux::message('ItemSlots')?> :</label>
		<select name="slots_op">
			<option value="eq"<?php if (($slots_op=$params->get('slots_op')) == 'eq') echo ' selected="selected"' ?>><?php echo Flux::message('ItemEqual')?></option>
			<option value="gt"<?php if ($slots_op == 'gt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemGreater')?></option>
			<option value="lt"<?php if ($slots_op == 'lt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemLess')?></option>
		</select>
		<input type="text" name="slots" id="slots" value="<?php echo htmlspecialchars($params->get('slots')) ?>" />
		...
		<label for="defense"><?php echo Flux::message('ItemDefense')?> :</label>
		<select name="defense_op">
			<option value="eq"<?php if (($defense_op=$params->get('defense_op')) == 'eq') echo ' selected="selected"' ?>><?php echo Flux::message('ItemEqual')?></option>
			<option value="gt"<?php if ($defense_op == 'gt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemGreater')?></option>
			<option value="lt"<?php if ($defense_op == 'lt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemLess')?></option>
		</select>
		<input type="text" name="defense" id="defense" value="<?php echo htmlspecialchars($params->get('defense')) ?>" />
	</p>
	<p>
		<label for="attack"><?php echo Flux::message('ItemAttack')?> :</label>
		<select name="attack_op">
			<option value="eq"<?php if (($attack_op=$params->get('attack_op')) == 'eq') echo ' selected="selected"' ?>><?php echo Flux::message('ItemEqual')?></option>
			<option value="gt"<?php if ($attack_op == 'gt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemGreater')?></option>
			<option value="lt"<?php if ($attack_op == 'lt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemLess')?></option>
		</select>
		<input type="text" name="attack" id="attack" value="<?php echo htmlspecialchars($params->get('attack')) ?>" />
		...
		<?php if($server->isRenewal): ?>
		<label for="matk">MATK:</label>
		<select name="matk_op">
			<option value="eq"<?php if (($matk_op=$params->get('matk_op')) == 'eq') echo ' selected="selected"' ?>><?php echo Flux::message('ItemEqual')?></option>
			<option value="gt"<?php if ($matk_op == 'gt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemGreater')?></option>
			<option value="lt"<?php if ($matk_op == 'lt') echo ' selected="selected"' ?>><?php echo Flux::message('ItemLess')?></option>
		</select>
		<input type="text" name="matk" id="matk" value="<?php echo htmlspecialchars($params->get('matk')) ?>" />
		...
		<?php endif ?>
		<label for="refineable"><?php echo Flux::message('ItemRefineable')?> :</label>
		<select name="refineable" id="refineable">
			<option value=""<?php if (!($refineable=$params->get('refineable'))) echo ' selected="selected"' ?>><?php echo Flux::message('ItemAll')?></option>
			<option value="yes"<?php if ($refineable == 'yes') echo ' selected="selected"' ?>><?php echo Flux::message('ItemYes')?></option>
			<option value="no"<?php if ($refineable == 'no') echo ' selected="selected"' ?>><?php echo Flux::message('ItemNo')?></option>
		</select>
		...
		<label for="for_sale"><?php echo Flux::message('ItemSale')?> :</label>
		<select name="for_sale" id="for_sale">
			<option value=""<?php if (!($for_sale=$params->get('for_sale'))) echo ' selected="selected"' ?>><?php echo Flux::message('ItemAll')?></option>
			<option value="yes"<?php if ($for_sale == 'yes') echo ' selected="selected"' ?>><?php echo Flux::message('ItemYes')?></option>
			<option value="no"<?php if ($for_sale == 'no') echo ' selected="selected"' ?>><?php echo Flux::message('ItemNo')?></option>
		</select>
		...
		<label for="custom"><?php echo Flux::message('IteItemCustommAll')?> :</label>
		<select name="custom" id="custom">
			<option value=""<?php if (!($custom=$params->get('custom'))) echo ' selected="selected"' ?>><?php echo Flux::message('ItemAll')?></option>
			<option value="yes"<?php if ($custom == 'yes') echo ' selected="selected"' ?>><?php echo Flux::message('ItemYes')?></option>
			<option value="no"<?php if ($custom == 'no') echo ' selected="selected"' ?>><?php echo Flux::message('ItemNo')?></option>
		</select>
		...
		<input type="submit" value="<?php echo Flux::message('ButtonSearch')?>" />
		<input type="button" value="<?php echo Flux::message('ButtonReset')?>" onclick="reload()" />
	</p>
</form>
<?php if ($items): ?>
<?php echo $paginator->infoText() ?>
<table class="horizontal-table">
	<tr>
		<th><?php echo $paginator->sortableColumn('item_id',  Flux::message('ItemID')) ?></th>
		<th colspan="2"><?php echo $paginator->sortableColumn('name',  Flux::message('ItemName')) ?></th>
		<th><?php echo Flux::message('ItemType')?></th>
		<th><?php echo Flux::message('ItemLocation')?></th>
		<th><?php echo $paginator->sortableColumn('price_buy', Flux::message('ItemBuy')) ?></th>
		<th><?php echo $paginator->sortableColumn('price_sell', Flux::message('ItemSell')) ?></th>
		<th><?php echo $paginator->sortableColumn('weight', Flux::message('ItemWeight')) ?></th>
		<th><?php echo $paginator->sortableColumn('attack', Flux::message('ItemAttack')) ?></th>
		<?php if($server->isRenewal): ?>
		<th><?php echo $paginator->sortableColumn('matk', 'MATK') ?></th>
		<?php endif ?>
		<th><?php echo $paginator->sortableColumn('defense', Flux::message('ItemDefense')) ?></th>
		<th><?php echo $paginator->sortableColumn('range', Flux::message('ItemRange')) ?></th>
		<th><?php echo $paginator->sortableColumn('slots', Flux::message('ItemSlots')) ?></th>
		<th><?php echo $paginator->sortableColumn('refineable', Flux::message('ItemRefineable')) ?></th>
		<th><?php echo $paginator->sortableColumn('cost', Flux::message('ItemSale')) ?></th>
		<th><?php echo $paginator->sortableColumn('origin_table', Flux::message('ItemCustom') ) ?></th>
	</tr>
	<?php foreach ($items as $item): ?>
	<tr>
		<td align="center">
			<?php if ($auth->actionAllowed('item', 'view')): ?>
				<?php echo $this->linkToItem($item->item_id, $item->item_id) ?>
			<?php else: ?>
				<?php echo htmlspecialchars($item->item_id) ?>
			<?php endif ?>
		</td>
		<?php if ($icon=$this->iconImage($item->item_id)): ?>
			<td width="24"><img src="<?php echo htmlspecialchars($icon) ?>?nocache=<?php echo rand() ?>" /></td>
			<td><?php echo htmlspecialchars($item->name) ?></td>
		<?php else: ?>
			<td colspan="2"><?php echo htmlspecialchars($item->name) ?></td>
		<?php endif ?>
		<td align="center">
			<?php if ($type=$this->itemTypeText($item->type, $item->view)): ?>
				<?php echo htmlspecialchars($type) ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo Flux::message('ItemUnknown') ?><?php echo " (".$item->type.")" ?></span>
			<?php endif ?>
		</td>
		<td align="center">
			<?php if ($loc=$this->equipLocationCombinationText($item->equip_locations)): ?>
				<?php echo htmlspecialchars($loc) ?>
			<?php else: ?>
				<span class="not-applicable"><?php echo Flux::message('ItemUnknown') ?><?php echo " (".$item->equip_locations.")" ?></span>
			<?php endif ?>
		</td>
		<td align="center"><?php echo number_format((int)$item->price_buy) ?></td>
		<td align="center"><?php echo number_format((int)$item->price_sell) ?></td>
		<td align="center"><?php echo round($item->weight, 1) ?></td>
		<td align="center"><?php echo number_format((int)$item->attack) ?></td>
		<?php if($server->isRenewal): ?>
			<td align="center"><?php echo number_format((int)$item->matk) ?></td>
		<?php endif ?>
		<td align="center"><?php echo number_format((int)$item->defense) ?></td>
		<td align="center"><?php echo number_format((int)$item->range) ?></td>
		<td align="center"><?php echo number_format((int)$item->slots) ?></td>
		<td align="center">
			<?php if ($item->refineable): ?>
				<span class="refineable yes"><?php echo Flux::message('ItemYes') ?></span>
			<?php else: ?>
				<span class="refineable no"><?php echo Flux::message('ItemNo') ?></span>
			<?php endif ?>
		</td>
		<td align="center">
			<?php if ($item->cost): ?>
				<span class="for-sale yes"><a href="<?php echo $this->url('purchase') ?>" title="Go to Item Shop"><?php echo Flux::message('ItemYes') ?></a></span>
			<?php else: ?>
				<span class="for-sale no"><?php echo Flux::message('ItemNo') ?></span>
			<?php endif ?>
		</td>
		<td align="center">
			<?php if (preg_match('/item_db2$/', $item->origin_table)): ?>
				<?php echo Flux::message('ItemYes') ?>
			<?php else: ?>
				<?php echo Flux::message('ItemNo') ?>
			<?php endif ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php echo $paginator->getHTML() ?>
<?php else: ?>
<p><?php echo Flux::message('ItemNone') ?></p>
<?php endif ?>
