<div class="row">
	<div class="col-sm-12">
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-table fa-fw"></i> Data</h4>
<div class="table-responsive">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>NAMA</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($table as $key => $value) {
?>
			<tr>
				<td><?= $value['name'] ?></td>
				<td align="center">
					<a href="<?= base_url('admin/'.$this->uri->segment(2).'/form/'.$value['name']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a>
				</td>
			</tr>
<?php
}
?>
	</tbody>
</table>
<div>
	<?= $this->pagination->create_links() ?>
	<span>Total data: <?= $total_data ?></span>
</div>
</div>
		</div></div>
	</div>
</div>