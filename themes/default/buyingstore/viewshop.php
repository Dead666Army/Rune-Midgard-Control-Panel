<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars($title); ?></h2>
<?php if ($store): ?>
	<h3 style="text-align:right; margin:0; padding:0;font-style: italic"><img style="position:relative;top:7px;" src="<?php echo $this->iconImage(671) ?>?nocache=<?php echo rand() ?>" /> <?php echo $store->title ?> </h3>
	<h4 style="text-align:right; color:blue; margin:0; margin-bottom:15px; "> <?php echo $store->map; ?>, <?php echo $store->x; ?>, <?php echo $store->y; ?> </h4>

	<?php if ($items): ?>
		<table class="horizontal-table">
			<thead>
				<tr>
					<th>ID</th>
					<th><?php echo Flux::message('ItemName') ?></th>
					<th><?php echo Flux::message('ItemPrice') ?></th>
					<th><?php echo Flux::message('ItemAmount') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($items as $item): ?>
					<tr>
						<td width="50" align="right" style="">
							<?php if ($auth->actionAllowed('item', 'view')): ?>
								<a href="<?php echo $this->url('item', 'view', array("id" => $item->nameid)); ?>"><?php echo $item->nameid; ?></a>
							<?php else: ?>
								<?php echo $item->nameid ?>
							<?php endif ?>
						</td>
						<td>
							<img src="<?php echo $this->iconImage($item->nameid) ?>?nocache=<?php echo rand() ?>" />
							<?php if ($auth->actionAllowed('item', 'view')): ?>
								<a href="<?php echo $this->url('item', 'view', array("id" => $item->nameid)); ?>"><?php echo $item->item_name; ?></a>
							<?php else: ?>
								<?php echo $item->item_name ?>
							<?php endif ?>
							<?php if ($item->char_name): ?>
								Of <?php echo $item->char_name ?>
							<?php endif; ?>
						</td>
						<td style="color:goldenrod; text-shadow:1px 1px 0px brown;">
							<?php echo number_format($item->price, 0, ',', ' '); ?> z
						</td>
						<td>
							<?php echo $item->amount ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	<?php else: ?>
		<p><?php echo Flux::message('ItemNone') ?></p>
	<?php endif ?>
<?php else: ?>
	<p><?php echo Flux::message('BuyingNone') ?></p>
<?php endif ?>
