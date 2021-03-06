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
		.priority-5{
			display:none;
		}
	}
	
	@media screen and (max-width: 550px) {
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
	
	@media screen and (max-width: 300px) {
		.priority-5{
			display:none;
		}
		.priority-4{
			display:none;
		}
		.priority-3{
			display:none;
		}
		.priority-2{
			display:none;
		}
	
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
		<i class="icon-pencil"></i><li class="active">Perencanaan Pengolahan Data</li>
	</ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
		<?php
		if(empty($var['aksi'])){
		?>
			<div class="box-title">
				<h3><i class="icon-pencil"></i> Daftar Perencanaan Pengolahan Data</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div class="pull-right">
					<a href="?<?php echo paramEncrypt('page=perencanaan&aksi=entri'); ?>" class="btn btn-info"><i class="icon-plus"></i> Entri Perencanaan</a>
					<br/>
				</div>
				<div class="pull-left">
					<a href="export.php?page=perencanaan" target="_blank"><img src="img/excel_icon.png" width="50px"></img></a>
					<br/>
				</div>
				 <div class="clearfix"></div>
				<table class="table table-advance tutorial-table" id="table1">
					<thead>
						<tr>
							<th class="priority-1">No</th>
							<th class="priority-2">Nama Kegiatan</th>
							<th class="priority-3">Jadwal</th>
							<th class="priority-4">Rencana Pengerjaan</th>
							<th class="priority-2">Aksi</th>
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
						echo "<td class='priority-1'>".$i."</td>";
						echo "<td class='priority-2'>".$data['nama']."</td>";
						echo "<td class='priority-3'>".bulan(tanggal($data['jadwal_awal']))." s.d. ".bulan(tanggal($data['jadwal_selesai']))." (".(round($datediff / (60 * 60 * 24))+1)." hari)</td>";
						echo "<td class='priority-4'>".$data['hari_kerja']." hari <ul>";
						$kal_keg=mysqli_query($conn,"select * from kalender_kegiatan where id_kegiatan='".$data['id']."' order by tanggal asc");
						while($data_kal=mysqli_fetch_array($kal_keg)){
							echo "<li>".tanggal($data_kal['tanggal'])."</li>";
						}
						echo "</ul></td>";
						echo "<td class='priority-2'>
								<div class='btn-group'>
									<a class='btn show-tooltip' title='Lihat Detail' href='?".paramEncrypt('page=perencanaan&aksi=detail&id='.$data['id'].'')."'><i class='icon-search'></i></a>&nbsp;
									<a class='btn btn-warning show-tooltip' title='Edit' href='?".paramEncrypt('page=perencanaan&aksi=edit&id='.$data['id'].'')."'><i class='icon-edit'></i></a>&nbsp;
									<button onclick='Delete(\"".$data['id']."\",\"".$data['nama']."\")' class='btn btn-danger' title='Hapus'><i class='icon-trash'></i></button>
								</div>
							</td>";
						echo "</tr>";
						$i++;
					}
					?>
					</tbody>
				</table>
			</div>
			
		<?php } ?>
		<?php
		if(!empty($var['aksi']) && $var['aksi']=='entri'){
		?>
			<div class="box-title">
				<h3><i class="icon-pencil"></i> Entri Perencanaan Pengolahan Data</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
			<form id="entri" action="#" class="form-horizontal" onsubmit="return SimpanEntri()">
				<div class="control-group">
					<label class="control-label">Nama Kegiatan Pengolahan Data</label>
					<div class="controls"> 
						<input type="text" class="span6" id="nama" name="nama"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jadwal Pengolahan</label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-calendar"></i></span>
							<input class="date-picker" size="16" type="text" id="jadwal_awal" name="jadwal_awal"/>
						</div>				
						sd
						<div class="input-prepend">
							<span class="add-on"><i class="icon-calendar"></i></span>
							<input class="date-picker" size="16" type="text" id="jadwal_akhir" name="jadwal_akhir"/>
						</div>
						
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Target Dokumen</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class="input-xlarge" id="target" name="target"/>
							<span class="add-on">dokumen</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Waktu Olah per Dokumen</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="olah" name="olah">
							<span class="add-on">menit</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Rencana Jam Kerja Per Hari</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="jam_kerja" name="jam_kerja">
							<span class="add-on">jam</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jumlah PC yang Akan Digunakan</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="pc" name="pc">
							<span class="add-on">buah</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<div class="controls"> 
						<button type="button" class="btn btn-primary" onclick="Simulasi();"><i class="icon-search"></i> Klik Untuk Analisis Perencanaan</button>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Rencana Hari Kerja</label>
					<div class="controls">
						<button class="add_form_field">Tambah Hari <i class="icon-plus"></i></button>
						<div class="container1">					
							<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input class="date-picker" size="16" type="text" name="hari[]"></div>
						</div>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="button" class="btn btn-primary" onclick="SimpanEntri();"><i class="icon-save"></i> Simpan</button>			
					<a href="?<?php echo paramEncrypt('page=perencanaan'); ?>" type="button" class="btn">Kembali</a>
				</div>
			</form>
			</div>	
		<?php } ?>
		<?php
		if(!empty($var['aksi']) && $var['aksi']=='edit'){
		?>
			<div class="box-title">
				<h3><i class="icon-pencil"></i> Edit Perencanaan Pengolahan Data</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
			<form id="entri" action="#" class="form-horizontal" onsubmit="return SimpanEntri()">
			<?php
				$sql=mysqli_query($conn,"select * from kegiatan where id=".$var['id']."");
				$data=mysqli_fetch_array($sql);
				echo '<input type="hidden" class="span6" id="id" name="id" value="'.$data['id'].'"/>';
			?>
				<div class="control-group">
					<label class="control-label">Nama Kegiatan Pengolahan Data</label>
					<div class="controls"> 
						<input type="text" class="span6" id="nama" name="nama" value="<?php echo $data['nama'];?>"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jadwal Pengolahan</label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-calendar"></i></span>
							<input class="date-picker" size="16" type="text" id="jadwal_awal" name="jadwal_awal" value="<?php echo tanggal($data['jadwal_awal']);?>" />
						</div>				
						sd
						<div class="input-prepend">
							<span class="add-on"><i class="icon-calendar"></i></span>
							<input class="date-picker" size="16" type="text" id="jadwal_akhir" name="jadwal_akhir" value="<?php echo tanggal($data['jadwal_selesai']);?>" />
						</div>
						
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Target Dokumen</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class="input-xlarge" id="target" name="target" value="<?php echo $data['target_dokumen'];?>"/>
							<span class="add-on">dokumen</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Waktu Olah per Dokumen</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="olah" name="olah" value="<?php echo $data['waktu_olah'];?>"/>
							<span class="add-on">menit</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Rencana Jam Kerja Per Hari</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="jam_kerja" name="jam_kerja" value="<?php echo $data['jam_kerja'];?>"/>
							<span class="add-on">jam</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jumlah PC yang Akan Digunakan</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="pc" name="pc" value="<?php echo $data['pc'];?>"/>
							<span class="add-on">buah</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<div class="controls"> 
						<button type="button" class="btn btn-primary" onclick="Simulasi();"><i class="icon-search"></i> Klik Untuk Analisis Perencanaan</button>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Rencana Hari Kerja</label>
					<div class="controls">
						<button class="add_form_field">Tambah Hari <i class="icon-plus"></i></button>
						<div class="container1">
							<?php
							$n=0;
							$sql_kal=mysqli_query($conn,"select * from kalender_kegiatan where id_kegiatan=".$var['id']." order by tanggal asc");
							while($data_kal=mysqli_fetch_array($sql_kal)){
								if($n==0){
									echo '<div><div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input class="date-picker" size="16" type="text" name="hari[]" value="'.tanggal($data_kal['tanggal']).'"></div></div><br>';
								}else{
									echo '<div><div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input class="date-picker" size="16" type="text" name="hari[]" value="'.tanggal($data_kal['tanggal']).'"></div><a href="#" class="delete"><i class="icon-remove-sign">Hapus</i></a></div><br>';
								}
							$n++;
							}
							?>
						</div>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="button" class="btn btn-primary" onclick="SimpanUpdate();"><i class="icon-save"></i> Simpan</button>			
					<a href="?<?php echo paramEncrypt('page=perencanaan'); ?>" type="button" class="btn">Kembali</a>
				</div>
			</form>
			</div>	
		<?php } ?>
		<?php
		if(!empty($var['aksi']) && $var['aksi']=='detail'){
		?>
			<div class="box-title">
				<h3><i class="icon-pencil"></i> Detail Perencanaan Pengolahan Data</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
			<form id="entri" action="#" class="form-horizontal" onsubmit="return SimpanEntri()">
			<?php
				$sql=mysqli_query($conn,"select * from kegiatan where id=".$var['id']."");
				$data=mysqli_fetch_array($sql);
			?>
				<div class="control-group">
					<label class="control-label">Nama Kegiatan Pengolahan Data</label>
					<div class="controls"> 
						<input type="text" class="span6" id="nama" name="nama" value="<?php echo $data['nama'];?>" readonly />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jadwal Pengolahan</label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-calendar"></i></span>
							<input class="date-picker" size="16" type="text" id="jadwal_awal" name="jadwal_awal" value="<?php echo tanggal($data['jadwal_awal']);?>" readonly />
						</div>				
						sd
						<div class="input-prepend">
							<span class="add-on"><i class="icon-calendar"></i></span>
							<input class="date-picker" size="16" type="text" id="jadwal_akhir" name="jadwal_akhir" value="<?php echo tanggal($data['jadwal_selesai']);?>"  readonly />
						</div>
						
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Target Dokumen</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class="input-xlarge" id="target" name="target" value="<?php echo $data['target_dokumen'];?>" readonly />
							<span class="add-on">dokumen</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Waktu Olah per Dokumen</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="olah" name="olah" value="<?php echo $data['waktu_olah'];?>" readonly />
							<span class="add-on">menit</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Rencana Jam Kerja Per Hari</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="jam_kerja" name="jam_kerja" value="<?php echo $data['jam_kerja'];?>" readonly />
							<span class="add-on">jam</i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Rencana Hari Kerja</label>
					<div class="controls">
						<div class="container1">
							<?php
							$sql_kal=mysqli_query($conn,"select * from kalender_kegiatan where id_kegiatan=".$var['id']."");
							while($data_kal=mysqli_fetch_array($sql_kal)){
								echo '<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input  size="16" type="text" name="hari[]" value="'.tanggal($data_kal['tanggal']).'"  readonly ></div><br>';
							}
							?>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jumlah PC yang Digunakan</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="pc" name="pc" value="<?php echo $data['pc'];?>" readonly />
							<span class="add-on">buah</i></span>
						</div>
					</div>
				</div>
				<div class="form-actions">			
					<a href="?<?php echo paramEncrypt('page=perencanaan'); ?>" type="button" class="btn">Kembali</a>
				</div>
			</form>
			</div>	
		<?php } ?>
		</div>
	</div>
</div>

<!-- END Main Content -->

<script>
$(document).ready(function() {
    var max_fields      = 20;
    var wrapper         = $(".container1"); 
    var add_button      = $(".add_form_field"); 
    
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<div><div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input class="date-picker" size="16" type="text" name="hari[]"/></div><a href="#" class="delete"><i class="icon-remove-sign">Hapus</i></a><div>'); //add input box
        }
		else
		{
		alert('You Reached the limits')
		}
    });
    
    $(wrapper).on("click",".delete", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
$('body').on('focus',".date-picker", function(){
    $(this).datepicker({
			 format: 'dd-mm-yyyy',
		});
});
$("#target").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	$("#olah").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	$("#jam_kerja").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	$("#pc").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
function Simulasi(){
   // get values
    var nama       	= $("#nama").val();
    var jadwal_awal = $("#jadwal_awal").val();
    var jadwal_akhir= $("#jadwal_akhir").val();
    var target      = $("#target").val();
	var olah       	= $("#olah").val();
	var jam_kerja   = $("#jam_kerja").val();
	var pc      	= $("#pc").val();
	var hari = [];
	for(var i=0; i < document.getElementsByName("hari[]").length;i++){
		hari.push(document.getElementsByName("hari[]")[i].value);
	} 
	if(jadwal_awal=="" || jadwal_akhir=="" || target=="" || olah=="" || jam_kerja=="" || pc==""  ){
	   swal("","Semua isian harus terisi","warning")
	}else{ 
	    $("#loadingImage").show();
            var myForm = document.getElementById('entri');
            formData = new FormData(myForm);
          
          //disable the default form submission
          //event.preventDefault();
         
		$.ajax({
			url: 'pages/simulasi_perencanaan.php',
			type: 'POST',
			data: formData,
			async: true,
			cache: false,
			contentType: false,
			processData: false,
			success: function (returndata) {
			  var pesan=returndata.split("#");
			  if(pesan[0]=="Berhasil menambahkan perencanaan"){
				  alert(pesan[0]);
				  location.href='index.php?'+pesan[1];
			  }else{
				  swal("",returndata,"success");
			  }
			  $("#loadingImage").hide();
			}
		});
	}
}
function SimpanEntri(){
   // get values
    var nama       	= $("#nama").val();
    var jadwal_awal = $("#jadwal_awal").val();
    var jadwal_akhir= $("#jadwal_akhir").val();
    var target      = $("#target").val();
	var olah       	= $("#olah").val();
	var jam_kerja   = $("#jam_kerja").val();
	var pc      	= $("#pc").val();
	var tanggal     = document.getElementsByName("hari[]")[0].value;
	var hari = [];
	for(var i=0; i < document.getElementsByName("hari[]").length;i++){
		hari.push(document.getElementsByName("hari[]")[i].value);
	} 
	if(nama=="" || jadwal_awal=="" || jadwal_akhir=="" || target=="" || olah=="" || jam_kerja=="" || pc=="" || hari.length==0 || tanggal==""){
	    swal("","Semua isian harus terisi","warning")
	}else{ 
	    $("#loadingImage").show();
            var myForm = document.getElementById('entri');
            formData = new FormData(myForm);
          
          //disable the default form submission
          //event.preventDefault();
         
		$.ajax({
			url: 'pages/perencanaan_add.php',
			type: 'POST',
			data: formData,
			async: true,
			cache: false,
			contentType: false,
			processData: false,
			success: function (returndata) {
			  var pesan=returndata.split("#");
			  if(pesan[0]=="Berhasil menambahkan perencanaan"){
				  swal("",pesan[0],"success")
					.then((value) => {
					  location.href='index.php?'+pesan[1];
					});
				  
			  }else{
				  swal("",returndata,"error");
			  }
			  $("#loadingImage").hide();
			}
		});
	}
}
function SimpanUpdate(){
   // get values
    var id       	= $("#id").val();
    var nama       	= $("#nama").val();
    var jadwal_awal = $("#jadwal_awal").val();
    var jadwal_akhir= $("#jadwal_akhir").val();
    var target      = $("#target").val();
	var olah       	= $("#olah").val();
	var jam_kerja   = $("#jam_kerja").val();
	var pc      	= $("#pc").val();
	var tanggal     = document.getElementsByName("hari[]")[0].value;
	var hari = [];
	for(var i=0; i < document.getElementsByName("hari[]").length;i++){
		hari.push(document.getElementsByName("hari[]")[i].value);
	} 
	if(nama=="" || jadwal_awal=="" || jadwal_akhir=="" || target=="" || olah=="" || jam_kerja=="" || pc=="" || hari.length==0 || tanggal==""){
	   swal("","Semua isian harus terisi","warning")
	}else{ 
	    $("#loadingImage").show();
            var myForm = document.getElementById('entri');
            formData = new FormData(myForm);
          
          //disable the default form submission
          //event.preventDefault();
         
		$.ajax({
			url: 'pages/perencanaan_update.php',
			type: 'POST',
			data: formData,
			async: true,
			cache: false,
			contentType: false,
			processData: false,
			success: function (returndata) {
			  var pesan=returndata.split("#");
			  if(pesan[0]=="Berhasil mengupdate perencanaan"){
				 swal("",pesan[0],"success")
					.then((value) => {
					  location.href='index.php?'+pesan[1];
					});
			  }else{
				  swal("",returndata,"error");
			  }
			  $("#loadingImage").hide();
			}
		});
	}
}
// Delete Record
function Delete(id,nama) {
	swal("Apakah yakin akan menghapus perencanaan "+nama+"?", {
	  buttons: {
		cancel: "Tidak",
		catch: {
		  text: "Hapus",
		  value: "catch",
		}
	  },
	})
	.then((value) => {
		switch (value) {
			case "catch":
			$.post("pages/perencanaan_delete.php", {
				id: id
			},
				function (data, status) {
					var pesan=data.split("#");
					if(pesan[0]=="Berhasil menghapus perencanaan"){
						swal("",pesan[0]+" "+nama,"success")
						.then((value) => {
						  location.href='index.php?'+pesan[1];
						});
					}else{
						alert(data);
					}
				}
			);
			break;
		default:
			//swal("Batal menghapus");
			break;
	}
	});
    /* var conf = confirm("Apakah yakin akan menghapus perencanaan "+nama+"?");
    if (conf == true) {
        $.post("pages/perencanaan_delete.php", {
                id: id
            },
            function (data, status) {
				var pesan=data.split("#");
				if(pesan[0]=="Berhasil menghapus perencanaan"){
					swal("",pesan[0]+" "+nama,"success")
					.then((value) => {
					  location.href='index.php?'+pesan[1];
					});
				}else{
					alert(data);
				}
            }
        );
    } */
}
</script>
<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>