<h3><?php echo lang('change_password_heading');?></h3>

<div id="infoMessage"><?php echo $message;?></div>

<div class="well col-md-6">
<?php echo form_open("auth/change_password");?>

      <p>
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password,[], array('class'=>'form-control'));?>
      </p>

      <p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?php echo form_input($new_password, [], array('class'=>'form-control'));?>
      </p>

      <p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm, array('class'=>'form-control'));?>
      </p>

      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', lang('change_password_submit_btn', array('class'=>'btn btn-primary')));?></p>

<?php echo form_close();?>
</div>
