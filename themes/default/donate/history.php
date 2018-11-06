<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('DonateHistoryTitle')) ?></h2>
<h3><?php echo htmlspecialchars(Flux::message('DonateHistoryCompleted')) ?></h3>
<?php if ($completedTxn): ?>
<p><?php echo htmlspecialchars(sprintf(Flux::message('DonateHistoryCompletedNb'), number_format($completedTotal))) ?></p>
<table class="vertical-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryTransaction')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryDate')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryEmail')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryAmount')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryCurrency')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateCredit')) ?>(s)</th>
	</tr>
	<?php foreach ($completedTxn as $txn): ?>
	<tr>
		<td><?php echo htmlspecialchars($txn->txn_id) ?></td>
		<td><?php echo $this->formatDateTime($txn->payment_date) ?></td>
		<td><?php echo htmlspecialchars($txn->payer_email) ?></td>
		<td><?php echo htmlspecialchars($txn->mc_gross) ?></td>
		<td><?php echo htmlspecialchars($txn->mc_currency) ?></td>
		<td><?php echo number_format($txn->credits) ?></td>
	</tr>
	<?php endforeach ?>
</table>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('DonateHistoryCompletedNone')) ?></p>
<?php endif ?>

<h3><?php echo htmlspecialchars(Flux::message('DonateHistoryHeld')) ?></h3>
<?php if ($heldTxn): ?>
<p><?php echo htmlspecialchars(sprintf(Flux::message('DonateHistoryHeldNb'), number_format($heldTotal))) ?></p>
<table class="vertical-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryTransaction')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryDate')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryEmail')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryAmount')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryCurrency')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateCredit')) ?>(s)</th>
	</tr>
	<?php foreach ($heldTxn as $txn): ?>
	<tr>
		<td><?php echo htmlspecialchars($txn->txn_id) ?></td>
		<td><?php echo $this->formatDateTime($txn->payment_date) ?></td>
		<td><?php echo htmlspecialchars($txn->payer_email) ?></td>
		<td><?php echo htmlspecialchars($txn->mc_gross) ?></td>
		<td><?php echo htmlspecialchars($txn->mc_currency) ?></td>
		<td><?php echo number_format($txn->credits) ?></td>
	</tr>
	<tr>
		<td colspan="6">
			<?php echo Flux::message('DonateHistoryHeldDelay') ?>
			<strong><?php echo $this->formatDateTime($txn->hold_until) ?></strong>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('DonateHistoryHeldNone')) ?></p>
<?php endif ?>

<h3><?php echo htmlspecialchars(Flux::message('DonateHistoryFailed')) ?></h3>
<?php if ($failedTxn): ?>
<p><?php echo htmlspecialchars(sprintf(Flux::message('DonateHistoryFailedNb'), number_format($failedTotal))) ?></p>
<table class="vertical-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryTransaction')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryDate')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryEmail')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryAmount')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryCurrency')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateCredit')) ?>(s)</th>
	</tr>
	<?php foreach ($failedTxn as $txn): ?>
	<tr>
		<td><?php echo htmlspecialchars($txn->txn_id) ?></td>
		<td><?php echo $this->formatDateTime($txn->payment_date) ?></td>
		<td><?php echo htmlspecialchars($txn->payer_email) ?></td>
		<td><?php echo htmlspecialchars($txn->mc_gross) ?></td>
		<td><?php echo htmlspecialchars($txn->mc_currency) ?></td>
		<td><?php echo number_format($txn->credits) ?></td>
	</tr>
	<?php endforeach ?>
</table>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('DonateHistoryFailedNone')) ?></p>
<?php endif ?>
