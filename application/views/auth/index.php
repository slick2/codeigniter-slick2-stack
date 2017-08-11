<script type="text/javascript">
    $(document).ready(function () {
        $('#table1').dataTable();
    });
</script>

<h3><?php echo lang('index_heading'); ?></h3>
<p><?php echo lang('index_subheading'); ?></p>

<div id="infoMessage"><?php echo $message; ?></div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-table"></i>&nbsp;Users</div>
            <div class="panel-body">
                <table cellpadding=0 cellspacing=10 class="table table-striped table-condensed table-hover" id="table1">
                    <thead>
                        <tr>
                            <th><?php echo lang('index_fname_th'); ?></th>
                            <th><?php echo lang('index_lname_th'); ?></th>
                            <th><?php echo lang('index_email_th'); ?></th>
                            <th><?php echo lang('index_groups_th'); ?></th>
                            <th><?php echo lang('index_status_th'); ?></th>
                            <th><?php echo lang('index_action_th'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <?php if ($user->id == $this->authInfo['id']) continue; ?>

                            <tr>
                                <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <?php foreach ($user->groups as $group): ?>
                                        <?php echo $group->name . ' ' ?>
                                    <?php endforeach ?>
                                </td>
                                <td><?php echo ($user->active) ? anchor("auth/deactivate/" . $user->id, lang('index_active_link')) : anchor("auth/activate/" . $user->id, lang('index_inactive_link')); ?></td>
                                <td><?php echo anchor("auth/edit_user/" . $user->id, '<i class="fa fa-edit"></i>&nbsp;Edit', array('class' => 'btn btn-xs btn-info')); ?></td>
                            </tr>
                        <?php endforeach; ?>
                </table>
                </tbody>
            </div>
        </div>
    </div>
</div>
<p><?php echo anchor('auth/create_user', '<i class="fa fa-plus"></i>&nbsp;' . lang('index_create_user_link'), array('class' => 'btn btn-xs btn-info')) ?> | <?php echo anchor('auth/create_group', '<i class="fa fa-plus"></i>&nbsp;' . lang('index_create_group_link'), array('class' => 'btn btn-xs btn-info')) ?></p>