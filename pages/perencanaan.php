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
					<br/>
				</div>
				 <div class="clearfix"></div>
				<table class="table table-advance" id="table1">
					<thead>
						<tr>
							<th>Nama Kegiatan Pengolahan Data</th>
							<th style="width:100px">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql=mysql_query("select * from kegiatan");
					while($data=mysql_fetch_array($sql)){
						echo "<tr>";
						echo "<td>".$data['nama']."</td>";
						echo "<td>
								<div class='btn-group'>
									<a class='btn btn-small show-tooltip' title='Edit' href='#'><i class='icon-edit'></i></a>
									<a class='btn btn-small btn-danger show-tooltip' title='Delete' href='#'><i class='icon-trash'></i></a>
								</div>
							</td>";
						echo "</tr>";
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
					<label class="control-label">Rencana Hari Kerja</label>
					<div class="controls">
						<button class="add_form_field">Tambah Hari <i class="icon-plus"></i></button>
						<div class="container1">					
							<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input class="date-picker" size="16" type="text" name="hari[]"></div>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Jumlah PC yang Ddigunakan</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="pc" name="pc">
							<span class="add-on">buah</i></span>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<button type="button" class="btn btn-primary" onclick="SimpanEntri();">Submit</button>			
					<a href="?<?php echo paramEncrypt('page=perencanaan'); ?>" type="button" class="btn">Cancel</a>
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
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	$("#olah").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	$("#jam_kerja").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	$("#pc").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
function SimpanEntri(){
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
	if(nama=="" || jadwal_awal=="" || jadwal_akhir=="" || target=="" || olah=="" || jam_kerja=="" || pc=="" || hari.length==0 ){
	    alert("Semua isian harus terisi")
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
			  if(pesan[0]=="Berhasil menambahkan permintaan"){
				  alert(pesan[0]);
				  location.href='index.php?'+pesan[1];
			  }else{
				  alert(returndata);
			  }
			  $("#loadingImage").hide();
			}
		});
	}
}
</script>
<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/chosen-bootstrap/chosen.jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="assets/clockface/js/clockface.js"></script>
<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>
<script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
<script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script> 