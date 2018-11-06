<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('DonateTrusted')) ?></h2>
<?php if ($emails): ?>
<p><?php echo Flux::message('DonateTrustedSubtitle1') ?></p>
<p><?php echo Flux::message('DonateTrustedSubtitle2') ?></p>
<table class="vertical-table">
	<tr>
		<th><?php echo htmlspecialchars(Flux::message('DonateHistoryEmail')) ?></th>
		<th><?php echo htmlspecialchars(Flux::message('DonateTrustedDate')) ?></th>
	</tr>
	<?php foreach ($emails as $email): ?>
	<tr>
		<td><?php echo htmlspecialchars($email->email) ?></td>
		<td><?php echo $this->formatDateTime($email->create_date) ?></td>
	</tr>
	<?php endforeach ?>
</table>
<?php else: ?>
<p><?php echo htmlspecialchars(Flux::message('DonateTrustedNone')) ?></p>
<?php if (!Flux::config('HoldUntrustedAccount')): ?>
<p><?php echo Flux::message('DonateTrustedExplain') ?></p>
<?php endif ?>
<?php endif ?>
