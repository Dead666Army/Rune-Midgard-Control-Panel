<?php
if (!defined('FLUX_ROOT')) exit;
$this->loginRequired();
?>
<h2><?php echo htmlspecialchars(Flux::message('SDCreateNew')) ?></h2>
<form action="<?php echo $this->urlWithQs ?>" method="post">
	<h3><?php echo htmlspecialchars(Flux::message('SDRequired')) ?></h3>
	<table class="vertical-table" width="100%">
		<tr>
			<th><?php echo htmlspecialchars(Flux::message('AccountIdLabel')) ?></th>
			<td><input type="text" name="account_id" id="account_id" value="<?php echo $session->account->account_id ?>" readonly="readonly" /></td>
		</tr>
		<tr>
			<th><?php echo htmlspecialchars(Flux::message('TransferCharNameLabel')) ?></th>
			<td><select name="char_id"><?php echo $charselect ?></select></td>
		</tr>
		<tr>
			<th><?php echo htmlspecialchars(Flux::message('SDHeaderSubject')) ?></th>
			<td><input type="text" name="subject" id="subject" size="50" /><br /><?php echo htmlspecialchars(Flux::message('SDDescription')) ?></td>
		</tr>
		<tr>
			<th><?php echo htmlspecialchars(Flux::message('SDHeaderCategory')) ?></th>
			<td><select name="category" id="category" onchange="showInfo()">
				<?php if(!$catlist): ?>
					<option value="-1"><?php echo Flux::message('SDNoCatsAvailable') ?></option>
				<?php else: ?>
				<?php foreach($catlist as $cat):?>
					<option value="<?php echo $cat->cat_id ?>"><?php echo $cat->name ?></option>
				<?php endforeach ?>
				<?php endif ?>
				</select></td>
		</tr>
		<tr>
			<th><?php echo htmlspecialchars(Flux::message('SDWhatHappened')) ?></th>
			<td>
				<textarea name="text"></textarea>
			</td>
		</tr>
	</table>
	
	<h3><?php echo htmlspecialchars(Flux::message('SDAdditionalInfo')) ?></h3>
	<table class="vertical-table" width="100%">
		<tbody id="chatrow">
		<tr>
			<th><?php echo htmlspecialchars(Flux::message('SDChatlog')) ?></th>
			<td><input type="text" name="chatlink" id="chatlink" size="50" /><br /><?php echo Flux::message('SDPointerChatLog') ?></td>
		</tr>
		</tbody>
		
		<tbody id="ssrow">
		<tr>
			<th><?php echo htmlspecialchars(Flux::message('SDScreenshot')) ?></th>
			<td><input type="text" name="sslink" id="sslink" size="50" /><br /><?php echo Flux::message('SDPointerScreenShot') ?></td>
		</tr>
		</tbody>
		
		<tbody id="videorow">
		<tr>
			<th><?php echo htmlspecialchars(Flux::message('SDVideo')) ?></th>
			<td><input type="text" name="videolink" id="chatlink" size="50" /><br /><?php echo Flux::message('SDPointerVideoLink') ?></td>
		</tr>
		</tbody>

		<tr>
			<td colspan="2"><input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>" /><input type="submit" value="<?php echo htmlspecialchars(Flux::message('SDCreate')) ?>" /></td>
		</tr>
    </table>
</form>
