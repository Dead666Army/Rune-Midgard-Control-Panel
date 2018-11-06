<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars($title); ?></h2>
<p class="toggler"><a href="javascript:toggleSearchForm()">Search...</a></p>
<form class="search-form" method="get">
	<?php echo $this->moduleActionFormInputs($params->get('module'), $params->get('action')); ?>
    <p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($params->get('name')) ?>" />
        ...
        <input type="submit" value="Search" />
        <input type="button" value="Reset" onclick="reload()" />
    </p>
</form>
<?php if ($items): ?>
    <?php echo $paginator->infoText() ?>
    <table class="horizontal-table">
        <thead>
            <tr>
                <th><?php echo $paginator->sortableColumn('title', 'Shop'); ?></th>
                <th><?php echo $paginator->sortableColumn('merchant', 'Merchant'); ?></th>
                <th>Position</th>
                <th><?php echo $paginator->sortableColumn('item_name', 'Item Name'); ?></th>
                <th>Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <a href="<?php echo $this->url('buyingstore', 'viewshop', array("id" => $item->shop_id)); ?>"><?php echo $item->title; ?></a>
                    </td>
                    <td><?php echo $item->merchant; ?></td>
                    <td>
                        <?php echo sprintf('%s %s, %s', $item->map, $item->x, $item->y); ?>
                    </td>
                    <td>
                        <?php if ($itemImage = $this->iconImage($item->item_id)): ?>
                        <img src="<?php echo "$itemImage?nocache=" . rand() ?>" />
                        <?php endif; ?>
                        <?php if ($auth->actionAllowed('item', 'view')): ?>
                            <a href="<?php echo $this->url('item', 'view', array("id" => $item->item_id)); ?>"><?php echo $item->item_name; ?></a>
                        <?php else: ?>
                            <?php echo $item->item_name ?>
                        <?php endif ?>
                        <?php if ($item->slots && !$item->char_name): ?>
                            <?php echo htmlspecialchars(' [' . $item->slots . ']') ?>
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
    <?php echo $paginator->getHTML() ?>
<?php else: ?>
    <p>No Items found. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>
