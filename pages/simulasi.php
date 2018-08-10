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
		<i class="icon-list-alt"></i><li class="active">Simulasi Pengolahan Data</li>
	</ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-list-alt"></i> Simulasi Pengolahan Data</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
			<form id="entri" action="#" class="form-horizontal" onsubmit="return SimpanEntri()">
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
					<label class="control-label">Jumlah PC yang Digunakan</label>
					<div class="controls"> 
						<div class="input-append">
							<input type="text" class='input-xlarge' id="pc" name="pc">
							<span class="add-on">buah</i></span>
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
				<div class="form-actions">
					<button type="button" class="btn btn-primary" onclick="SimpanEntri();"><i class="icon-search"></i> Simulasi</button>			
					<a href="?<?php echo paramEncrypt('page=main'); ?>" type="button" class="btn">Kembali</a>
				</div>
			</form>
			</div>	
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
			swal('','You Reached the limits','warning');
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
	if(jadwal_awal=="" || jadwal_akhir=="" || target=="" || olah=="" || jam_kerja=="" || pc=="" || hari.length==0 || tanggal==""){
	    swal("","Semua isian harus terisi","warning");
	}else{ 
	    $("#loadingImage").show();
            var myForm = document.getElementById('entri');
            formData = new FormData(myForm);
          
          //disable the default form submission
          //event.preventDefault();
         
		$.ajax({
			url: 'pages/simulasi_add.php',
			type: 'POST',
			data: formData,
			async: true,
			cache: false,
			contentType: false,
			processData: false,
			success: function (returndata) {
			  var pesan=returndata.split("#");
			  if(pesan[0]=="error"){
				  swal("",pesan[1],"warning");
				  //location.href='index.php?'+pesan[1];
			  }else{
				  swal("",returndata,"success");
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