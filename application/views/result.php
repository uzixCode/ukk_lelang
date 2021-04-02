<?php
if ($this->session->flashdata('result')) {
?>
<div class="alert alert-dismissable alert-<?php echo $this->session->flashdata('result')['alert'] ?> text-left">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<b>Respon:</b> <?php echo $this->session->flashdata('result')['title'] ?><br />
	<b>Pesan:</b> <?php echo $this->session->flashdata('result')['msg'] ?>
</div>
<?php
}
?>