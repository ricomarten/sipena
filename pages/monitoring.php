<!-- BEGIN Breadcrumb -->
<!--page specific css styles-->
        <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen.min.css" />
        <link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/clockface/css/clockface.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.php">Home</a>
			<span class="divider"><i class="icon-angle-right"></i></span>
		</li>
		<i class="icon-bar-chart"></i><li class="active">Perencanaan Pengolahan Data</li>
	</ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-bar-chart"></i> Daftar Perencanaan Pengolahan Data</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div class="pull-right">
					<a href="?<?php echo paramEncrypt('page=perencanaan&aksi=entri'); ?>" class="btn btn-info"><i class="icon-plus"></i> Entri Perencanaan</a>
					<br/>
					<br/>
				</div>
				 <div class="clearfix"></div>
				<table class="table table-advance" id="table1">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Kegiatan Pengolahan Data</th>
							<th>Keterangan</th>
							<th>Rekomendasi</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql=mysql_query("select * from kegiatan");
					$i=1;
					while($data=mysql_fetch_array($sql)){
						$awal = strtotime($data['jadwal_awal']);
						$akhir = strtotime($data['jadwal_selesai']);
						$datediff = $akhir - $awal;
						//echo round($datediff / (60 * 60 * 24));
						
						echo "<tr>";
						echo "<td>".$i."</td>";
						echo "<td>".$data['nama']."</td>";
						echo "<td>".$data['prediksi']."</td>";
						echo "<td>".$data['rekomendasi']."</td>";			
						echo "</tr>";
						$i++;
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- END Main Content -->

<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
