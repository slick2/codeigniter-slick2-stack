<h3><?php echo lang('create_user_heading'); ?></h3>
<p><?php echo lang('create_user_subheading'); ?></p>

<?php if (validation_errors()): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-plus"></i>&nbsp;Add User</div>
            <div class="panel-body">
                <?php echo form_open("auth/create_user"); ?>

                <p>
                    <?php echo lang('create_user_fname_label', 'first_name'); ?> <br />
                    <?php echo form_input($first_name, [], array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('create_user_lname_label', 'last_name'); ?> <br />
                    <?php echo form_input($last_name, NULL, array('class' => 'form-control')); ?>
                </p>

                <?php
                if ($identity_column !== 'email') {
                    echo '<p>';
                    echo lang('create_user_identity_label', 'identity');
                    echo '<br />';
                    echo form_error('identity');
                    echo form_input($identity, NULL, array('class' => 'form-control'));
                    echo '</p>';
                }

                ?>

                <p>
                    <?php echo lang('create_user_company_label', 'company'); ?> <br />
                    <?php echo form_input($company, NULL, array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('create_user_email_label', 'email'); ?> <br />
                    <?php echo form_input($email, NULL, array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('create_user_phone_label', 'phone'); ?> <br />
                    <?php echo form_input($phone, NULL, array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('create_user_password_label', 'password'); ?> <br />
                    <?php echo form_input($password, NULL, array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br />
                    <?php echo form_input($password_confirm, NULL, array('class' => 'form-control')); ?>
                </p>


                <p><?php echo form_submit('submit', lang('create_user_submit_btn'), array('class' => 'btn btn-info btn-sm')); ?></p>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>