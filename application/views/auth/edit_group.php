<h3><?php echo lang('edit_group_heading');?></h3>
<p><?php echo lang('edit_group_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>
<div class="well col-md-6">
<?php echo form_open(current_url());?>

      <p>
            <?php echo lang('edit_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name, NULL,array('class'=>'form-control'));?>
      </p>

      <p>
            <?php echo lang('edit_group_desc_label', 'description');?> <br />
            <?php echo form_input($group_description, NULL,array('class'=>'form-control'));?>
      </p>

      <p><?php echo form_submit('submit', lang('edit_group_submit_btn'), array('class'=>'btn btn-primary'));?></p>

<?php echo form_close();?>
</div>