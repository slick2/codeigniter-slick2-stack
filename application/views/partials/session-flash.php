
<?php if ($this->session->flashdata('success') || $this->session->flashdata('error') || $this->session->flashdata('message')): ?>
	<div id="session-flash">
		<br />
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-dismissable fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $this->session->flashdata('success'); ?>
			</div>
			<?php unset($_SESSION['success']) ?>
		<?php endif; ?>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-warning alert-dismissable fade in"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('error'); ?>
			</div>
			<?php unset($_SESSION['error']) ?>

		<?php endif; ?>

		<?php if ($this->session->flashdata('message')): ?>
			<div class="alert alert-info alert-dismissable fade in"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('message'); ?>
			</div>
			<?php unset($_SESSION['message']) ?>

		<?php endif; ?>

	</div>
<?php else : ?>
	<style type="text/css" media="screen">
		#session-flash {
			display: none;
		}
	</style>
<?php endif; ?>

