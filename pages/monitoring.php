<!-- BEGIN Breadcrumb -->
<style>
	.tutorial-table {
	    border: #e1e0e0 1px solid;
	}
	.tutorial-table th {
	    text-align: left;
	    background: #f0F0F0;
	    padding: 10px;
	}
	.tutorial-table td {
	    border-bottom: #e1e0e0 1px solid;
	    padding: 10px;
	}
	
	@media screen and (max-width: 900px) and (min-width: 550px) {
		.priority-7{
			display:none;
		}
		.priority-6{
			display:none;
		}
		.priority-5{
			display:none;
		}
	}
	
	@media screen and (max-width: 550px) {
		.priority-7{
			display:none;
		}
		.priority-6{
			display:none;
		}
		.priority-5{
			display:none;
		}
		.priority-4{
			display:none;
		}
	}
	
	@media screen and (max-width: 300px) {
		.priority-7{
			display:none;
		}
		.priority-6{
			display:none;
		}
		.priority-5{
			display:none;
		}
		.priority-4{
			display:none;
		}
		.priority-3{
			display:none;
		}
	
	}
	.btn-bs-file{
    position:relative;
	}
	.btn-bs-file input[type="file"]{
		position: absolute;
		top: -9999999;
		filter: alpha(opacity=0);
		opacity: 0;
		width:0;
		height:0;
		outline: none;
		cursor: inherit;
	}
	</style>
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
		<i class="icon-bar-chart"></i><li class="active">Monitoring Perencanaan</li>
	</ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-bar-chart"></i> Monitoring Perencanaan</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div class="pull-left">
					<a href="export.php?page=monitoring" target="_blank"><img src="img/excel_icon.png" width="50px"></img></a>
					<br/>
				</div>
				 <div class="clearfix"></div>
				 <table class="table table-advance tutorial-table" id="table1">
					<thead>
						<tr>
							<th class="priority-3">No</th>
							<th class="priority-1">Nama Kegiatan</th>
							<th class="priority-5">Jadwal</th>
							<th class="priority-6">Rencana Pengerjaan</th>
							<th class="priority-4">Prediksi</th>
							<th class="priority-7">Rekomendasi</th>
							<th class="priority-2">Dokumen Kesepakatan</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql=mysqli_query($conn,"select * from kegiatan");
					$i=1;
					while($data=mysqli_fetch_array($sql)){
						$awal = strtotime($data['jadwal_awal']);
						$akhir = strtotime($data['jadwal_selesai']);
						$datediff = $akhir - $awal;
						//echo round($datediff / (60 * 60 * 24));
						
						echo "<tr>";
						echo "<td class='priority-3'>".$i."</td>";
						echo "<td class='priority-1'>".$data['nama']."</td>";
						echo "<td class='priority-5'>".bulan(tanggal($data['jadwal_awal']))." s.d. ".bulan(tanggal($data['jadwal_selesai']))." (".(round($datediff / (60 * 60 * 24))+1)." hari)</td>";
						echo "<td class='priority-6'>".$data['hari_kerja']." hari <ul>";
						$kal_keg=mysqli_query($conn,"select * from kalender_kegiatan where id_kegiatan='".$data['id']."' order by tanggal asc");
						while($data_kal=mysqli_fetch_array($kal_keg)){
							echo "<li>".bulan(tanggal($data_kal['tanggal']))."</li>";
						}
						echo "</ul></td>";
						echo "<td class='priority-4'>".$data['prediksi']."</td>";
						echo "<td class='priority-7'>".$data['rekomendasi']."</td>";	
						echo "<td class='priority-2'>";
						//echo "Template: <a href='upload/Kesepakatan_Perencanaan_Pengolahan.docx' target='_blank' class='btn'><i class='icon-download-alt'></i></a><br>";
						echo "Download Kesepakatan: <a href='template.php?id=".$data['id']."' target='_blank' class='btn'><i class='icon-download-alt'></i></a><br>";					
						echo "<form method='post' enctype='multipart/form-data' id='kesepakatanForm".$data['id']."' action=''>";
						echo "<div><b>Upload dokumen: </b></div><div>";
						//echo "<input name='kesepakatan".$data['id']."' id='kesepakatan".$data['id']."' type='file' />";
						echo "<label class='btn-bs-file btn btn-sm btn-primary'>Browse<input name='kesepakatan".$data['id']."' id='kesepakatan".$data['id']."' type='file' /></label>";
						
						echo "<input name='kegId' type='hidden' value='".$data['id']."' />";

						echo "</div></form>";
						echo "<div id='hasilDokumen".$data['id']."'>";
						if (isset($data['dokumen']) && $data['dokumen'] != "") { // Test if image exists
							echo "<p class='myImage".$data['id']."'><a href='upload/".$data['dokumen']."'>".$data['dokumen']."</a></p>"; // If image exists we display the image
							echo "Approve: <button class='btn btn-circle btn-success'><i class='icon-ok'></i></button><br>";
						
						}else{
							echo "Approve: <button class='btn btn-circle btn-danger'><i class='icon-remove'></i></button><br>";
						}						
						echo "</div>";
						echo "</td>";
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
<script src="js/jquery.form.js"></script> 
<script>
<?php
$sql=mysqli_query($conn,"select * from kegiatan");
$i=1;
while($data=mysqli_fetch_array($sql)){
	echo "$('#kesepakatan".$data['id']."').bind('change', function() { ";
	echo "\n$(\"#hasilDokumen".$data['id']."\").html('<img src=\"img/loader.gif\" alt=\"\" />');";
	echo "\n$('#kesepakatanForm".$data['id']."').ajaxForm({ ";
	echo "\nurl: 'pages/monitoring_add.php', ";
	echo "\ndataType: 'json', ";
	echo "\nsuccess: function(data){";
	echo "\n$('#hasilDokumen".$data['id']."').html(data.text);"; 
	echo "\n$(\".myImage".$data['id']."\").load(function() { ";
	echo "\n$(\".myImage".$data['id']."\").attr( data.imgURL );";
	echo "\n});"; 
	echo "\n}";
	echo "\n}).submit();";
	echo "\n});";
	echo "\n";
}

?>
/* $('#kesepakatan').bind('change', function() { // jQuery on change form
	$("#hasilDokumen").html('<img src="img/loader.gif" alt="" />');
	$('#kesepakatanForm').ajaxForm({ // AJAX form plugin to upload a single image
		url: 'pages/monitoring_add.php', // Call this file to update database and send back the correct new image and URL
		dataType: 'json', // JSON farmat
		success: function(data){
			$('#hasilDokumen').html(data.text); // We display text in the div resultImageProfile tank
			$(".myImage").load(function() { // We break the cache and force the browser to check for the image again
				$(".myImage").attr( 'a', data.imgURL );
			  }); 
		}
	}).submit();
}); */
</script>
<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
