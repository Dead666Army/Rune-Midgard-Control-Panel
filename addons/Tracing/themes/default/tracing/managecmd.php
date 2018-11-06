<?php 
if (!defined('FLUX_ROOT')) exit;
?>
<h2><?php echo $title ?></h2>
<?php if (!empty($errorMessage)): ?>
    <p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php endif ?>
<form action="<?php echo $this->urlWithQs ?>" method="post" class="generic-form">
	<table width="100%"> 
        <tr>
            <th width="100"><label for="cmd_justification"><?php echo htmlspecialchars(Flux::message('Justification')) ?></label></th>
            <td><input type="text" name="cmd_justification" id="cmd_justification" value="<?php echo htmlspecialchars($justification) ?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="update" /></td>
        </tr>
    </table>
</form>