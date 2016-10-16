<?php if (validation_errors()): ?>
	<br />
	<div class="alert alert-info alert-dismissible fade in" role="alert">                
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>
<h1><?php echo lang('login_heading'); ?></h1>
<p><?php echo lang('login_subheading'); ?></p>

<div class="row">
	<div class="col-lg-6">


		<div class="well">
			<?php echo form_open("auth/login"); ?>
			<fieldset>
				<div class="form-group">
					<?php echo lang('login_identity_label', 'identity'); ?>
					<input type="text" name="identity" class="form-control">
				</div>

				<div class="form-group">
					<?php echo lang('login_password_label', 'password'); ?>
					<input type="password" name="password" class="form-control">
				</div>

				<p>
					<?php echo lang('login_remember_label', 'remember'); ?>
					<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
				</p>
				<p><?php echo form_submit('submit', lang('login_submit_btn'), array('class' => 'btn btn-primary')); ?></p>
			</fieldset>
			<?php echo form_close(); ?>

			<p><a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a></p>
		</div>

	</div>
</div>
