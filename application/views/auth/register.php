<h1><?php echo lang('register_user_heading');?></h1>
<p><?php echo lang('register_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>
<div class="well col-md-6">
<?php echo form_open("auth/register");?>

      <p>
            <?php echo lang('register_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name,[],array('class'=>'form-control'));?>
      </p>

      <p>
            <?php echo lang('register_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name,NULL,array('class'=>'form-control'));?>
      </p>
      
      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('register_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity,NULL,array('class'=>'form-control'));
          echo '</p>';
      }
      ?>

      <p>
            <?php echo lang('register_user_company_label', 'company');?> <br />
            <?php echo form_input($company,NULL,array('class'=>'form-control'));?>
      </p>

      <p>
            <?php echo lang('register_user_email_label', 'email');?> <br />
            <?php echo form_input($email,NULL,array('class'=>'form-control'));?>
      </p>

      <p>
            <?php echo lang('register_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone,NULL,array('class'=>'form-control'));?>
      </p>

      <p>
            <?php echo lang('register_user_password_label', 'password');?> <br />
            <?php echo form_input($password,NULL,array('class'=>'form-control'));?>
      </p>

      <p>
            <?php echo lang('register_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm,NULL,array('class'=>'form-control'));?>
      </p>


      <p><?php echo form_submit('submit', lang('register_user_submit_btn'), array('class'=>'btn btn-primary'));?></p>

<?php echo form_close();?>
</div>