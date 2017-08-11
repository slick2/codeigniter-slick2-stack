<h1><?php echo lang('edit_user_heading'); ?></h1>
<p><?php echo lang('edit_user_subheading'); ?></p>

<?php if (validation_errors()): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-edit"></i>&nbsp;Edit User</div>
            <div class="panel-body">
                <?php echo form_open(uri_string()); ?>

                <p>
                    <?php echo lang('edit_user_fname_label', 'first_name'); ?> <br />
                    <?php echo form_input($first_name, [], array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('edit_user_lname_label', 'last_name'); ?> <br />
                    <?php echo form_input($last_name, [], array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('edit_user_company_label', 'company'); ?> <br />
                    <?php echo form_input($company, [], array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('edit_user_phone_label', 'phone'); ?> <br />
                    <?php echo form_input($phone, [], array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('edit_user_password_label', 'password'); ?> <br />
                    <?php echo form_input($password, NULL, array('class' => 'form-control')); ?>
                </p>

                <p>
                    <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br />
                    <?php echo form_input($password_confirm, NULL, array('class' => 'form-control')); ?>
                </p>

                <?php if ($this->ion_auth->is_admin()): ?>
                    <div class="checkbox">
                        <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                        <?php foreach ($groups as $group): ?>
                            <label class="checkbox">
                                <?php
                                $gID = $group['id'];
                                $checked = null;
                                $item = null;
                                foreach ($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                        $checked = ' checked="checked"';
                                        break;
                                    }
                                }

                                ?>
                                <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>

                <?php echo form_hidden('id', $user->id); ?>
                <?php echo form_hidden($csrf); ?>

                <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), array('class' => 'btn btn-sm btn-info')); ?></p>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>