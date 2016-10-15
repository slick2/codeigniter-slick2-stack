<div id="session-flash">
	<?php if ($this->session->flashdata('success') || $this->session->flashdata('error') || $this->session->flashdata('message')): ?>

		<div>

			<?php if ($this->session->flashdata('success'))
			{
				?>
				<div class="alert alert-success fade in">
		<?php echo $this->session->flashdata('success'); ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
				<?php unset($_SESSION['success']) ?>
			<?php } ?>

			<?php if ($this->session->flashdata('error'))
			{
				?>
				<div class="alert alert-warning fade in">
				<?php echo $this->session->flashdata('error'); ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
				<?php unset($_SESSION['error']) ?>

			<?php } ?>

				<?php if ($this->session->flashdata('message'))
				{
					?>
				<div class="alert alert-info fade in">
				<?php echo $this->session->flashdata('message'); ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php unset($_SESSION['message']) ?>

	<?php } ?>
		</div>
<?php else : ?>
		<style type="text/css" media="screen">
			#session-flash {
				display: none;
			}
		</style>
<?php endif; ?>
</div>
