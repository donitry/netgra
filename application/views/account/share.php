<?php echo validation_errors(); ?>

<?php echo form_open('account/share','class="share_form" id="share_form"', array('verification' => $verification)); ?>

<h5>Username</h5>
<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />

<h5>Password</h5>
<input type="text" name="password" value="" size="50" />

<h5>Accountsite</h5>
<input type="text" name="accountsite" value="" size="50" />

<h5>Account extInfo</h5>
<input type="text" name="account_extInfo" value="<?php echo set_value('account_extInfo'); ?>" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>