<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('DonateTitle')) ?></h2>
<?php if (Flux::config('AcceptDonations')): ?>
	<?php if (!empty($errorMessage)): ?>
		<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
	<?php endif ?>
	
	<p><?php echo Flux::message('DonateSubTitle') ?></p>
	<p><?php echo Flux::message('DonatePaypalexplain2') ?></p><br>
	<h3><?php echo htmlspecialchars(Flux::message('DonateReady')) ?></h3>
	<p><?php echo Flux::message('DonatePaypalexplain') ?></p>
		
	<?php
	$currency         = Flux::config('DonationCurrency');
	$dollarAmount     = (float)+Flux::config('CreditExchangeRate');
	$creditAmount     = 1;
	$rateMultiplier   = 10;
	$hoursHeld        = +(int)Flux::config('HoldUntrustedAccount');
	
	while ($dollarAmount < 1) {
		$dollarAmount  *= $rateMultiplier;
		$creditAmount  *= $rateMultiplier;
	}
	?>
	
	<?php if ($hoursHeld): ?>
		<p><?php echo Flux::message('DonateHold1') ?>
			<span class="hold-hours"><?php echo htmlspecialchars(sprintf(Flux::message('DonateHold2'), number_format($hoursHeld))) ?></span>
			<?php echo Flux::message('DonateHold3') ?></p>
		<p><?php echo Flux::message('DonateHold4') ?></p>
	<?php endif ?>

	<div class="generic-form-div" style="margin-bottom: 10px">
		<table class="generic-form-table">
			<tr>
				<th><label><?php echo htmlspecialchars(Flux::message('DonateRate')) ?></label></th>
				<td><p><?php echo $this->formatCurrency($dollarAmount) ?> <?php echo htmlspecialchars($currency) ?>
				= <?php echo number_format($creditAmount) ?> <?php echo htmlspecialchars(Flux::message('DonateCredit')) ?></p></td>
			</tr>
			<tr>
				<th><label><?php echo htmlspecialchars(Flux::message('DonateRate')) ?></label></th>
				<td><p>1 <?php echo htmlspecialchars(Flux::message('DonateCredit')) ?> = 100 CashPoints</p></td>
			</tr>
			<tr>
				<th><label><?php echo htmlspecialchars(Flux::message('DonateMinimum')) ?></label></th>
				<td><p><?php echo $this->formatCurrency(Flux::config('MinDonationAmount')) ?> <?php echo htmlspecialchars($currency) ?></p></td>
			</tr>
		</table>
	</div>
		
	<?php if (!$donationAmount): ?>
	<form action="<?php echo $this->url ?>" method="post">
		<?php echo $this->moduleActionFormInputs($params->get('module')) ?>
		<input type="hidden" name="setamount" value="1" />
		<p class="enter-donation-amount">
			<label>
			<?php echo htmlspecialchars(Flux::message('DonateSet')) ?>
				<input class="money-input" type="text" name="amount"
					value="<?php echo htmlspecialchars($params->get('amount')) ?>"
					size="<?php echo (strlen((string)+Flux::config('CreditExchangeRate')) * 2) + 2 ?>" />
				<?php echo htmlspecialchars(Flux::config('DonationCurrency')) ?>
			</label>
			<?php echo htmlspecialchars(Flux::message('DonateSetOr')) ?>
			<label>
				<input class="credit-input" type="text" name="credit-amount"
					value="<?php echo htmlspecialchars(intval($params->get('amount') / Flux::config('CreditExchangeRate'))) ?>"
					size="<?php echo (strlen((string)+Flux::config('CreditExchangeRate')) * 2) + 2 ?>" />
				<?php echo htmlspecialchars(Flux::message('DonateCredit')) ?>s
			</label>
		</p>
		<input type="submit" value="<?php echo htmlspecialchars(Flux::message('DonateConfirm')) ?>" class="submit_button" />
	</form>
	<?php else: ?>
	<p><?php echo htmlspecialchars(Flux::message('DonateConfirmReady1')) ?>
	<?php echo htmlspecialchars(Flux::message('DonateConfirmReady2')) ?></p>
		
	<p class="credit-amount-text">
		&mdash;
		<span class="credit-amount"><?php echo number_format(floor($donationAmount / Flux::config('CreditExchangeRate'))) ?></span> <?php echo htmlspecialchars(Flux::message('DonateCredit')) ?>s
		&mdash;
	</p>
		
	<p class="donation-amount-text"><?php echo htmlspecialchars(Flux::message('DonateAmount')) ?> :
		<span class="donation-amount">
		<?php echo $this->formatCurrency($donationAmount) ?>
		<?php echo htmlspecialchars(Flux::config('DonationCurrency')) ?>
		</span>
	</p>
	<p class="reset-amount-text">
		<a href="<?php echo $this->url('donate', 'index', array('resetamount' => true)) ?>"><?php echo Flux::message('DonateResetAmount') ?></a>
	</p>
	<p><?php echo $this->donateButton($donationAmount) ?></p>
	<?php endif ?>
<?php else: ?>
	<p><?php echo Flux::message('NotAcceptingDonations') ?></p>
<?php endif ?>
