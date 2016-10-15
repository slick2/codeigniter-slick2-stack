
<h1><?php echo lang('forgot_password_heading'); ?></h1>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>

<div id="infoMessage"><?php echo $message; ?></div>
<div class="row">
	<div class="col-lg-6">
		<div class="well">
			<?php echo form_open("auth/forgot_password"); ?>
			<fieldset>
				<p>
					<label for="identity"><?php echo (($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?></label> <br />
					<?php echo form_input($identity,NULL, array('class'=>'form-control')); ?>
				</p>

				<p><?php echo form_submit('submit', lang('forgot_password_submit_btn'), array('class' => 'btn btn-primary')); ?></p>
			</fieldset>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
