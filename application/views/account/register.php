<?php echo validation_errors(); ?>

<?php echo form_open('account','class="register_form" id="register_form"', array('verification' => $verification)); ?>

<h5>Username</h5>
<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />

<h5>Password</h5>
<input type="text" name="password" value="" size="50" />

<h5>Password Confirm</h5>
<input type="text" name="passconf" value="" size="50" />

<h5>Modile Phone</h5>
<input type="text" name="phone" value="<?php echo set_value('phone'); ?>" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>