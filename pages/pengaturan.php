<style>
.datepicker{z-index:1151 !important;}
</style>
<link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.php">Home</a>
			<span class="divider"><i class="icon-angle-right"></i></span>
		</li>
		<i class="icon-wrench"></i><li class="active">Pengaturan</li>
	</ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-wrench"></i> Pengaturan Terkini</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div class="pull-right">
					<button class="btn btn-info" data-toggle="modal" data-target="#ubah_pengaturan"><i class="icon-edit"></i> Ubah Pengaturan</button>
					<br/>
					<br/>
				</div>
				<div  class="clearfix"></div>
				<div class="records_content"></div>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-time"></i> Total Jam Kerja per Hari Menurut Tanggal</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div class="pull-right">
					<button class="btn btn-info" data-toggle="modal" data-target="#ubah_pengaturan2"><i class="icon-plus"></i> Tambah Pengaturan</button>
					<br/>
				</div>
				<div class="pull-left">
					<a href="export.php?page=pengaturan" target="_blank"><img src="img/excel_icon.png" width="50px"></img></a>
					<br/>
				</div>
				<div  class="clearfix"></div>
				<table id="pengaturan" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><center>Tanggal</center></th>    
							<th><center>Jam Kerja</center></th>
							<th><center>Jumlah PC/Laptop Tersedia</center></th>
							<th><center>Aksi</center></th>
						</tr>
					</thead>
					<tbody class="records_content2">	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal - pengaturan -->
<div class="modal hide fade" id="ubah_pengaturan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pengaturan Terkini</h4>
            </div>
            <div class="modal-body">
            
            <form name="modul" action="?<?php echo paramEncrypt('page=pengguna'); ?>" class="form-horizontal"  method="post" >
            <div class="box-body">
                <div class="control-group">
					<label class="span-10 control-label">Jumlah PC/Laptop Tersedia</label>
					<div class="span-2">       
						<input type="text" class="form-control" id="pc" name="pc" required>			  
					</div>
				</div>
				<div class="control-group">
					<!--<label class="span-10 control-label">Total Jam Kerja per Hari</label>-->
					<div class="span-2">       
						<input type="hidden" class="form-control" id="jam" name="jam" value="8" required>			  
					</div>
				</div>
            </div>
			</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - pengaturan 2 -->
<div class="modal hide fade" id="ubah_pengaturan2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pengaturan Terkini</h4>
            </div>
            <div class="modal-body">
            
            <form name="modul" action="?<?php echo paramEncrypt('page=pengguna'); ?>" class="form-horizontal"  method="post" >
            <div class="box-body">
                <div class="control-group">
					<label class="span-10 control-label">Jumlah PC/Laptop Tersedia</label>
					<div class="span-2">
					<?php
					$query=mysql_query("select * from pengaturan");
					$data=mysql_fetch_array($query);
					?>
						<input type="text" class="form-control" id="pc2" name="pc2" value="<?php echo $data['pc'] ?>" readonly required>			  
					</div>
				</div>
				
				<div class="control-group">
					<label class="span-10 control-label">Tanggal</label>
					<div class="span-2 input-prepend">
						<span class="add-on"><i class="icon-calendar"></i></span>
						<input class="date-picker" size="16" type="text" id="tanggal" name="tanggal"/>
					</div>
				</div>
				<div class="control-group">
					<label class="span-10 control-label">Jam Kerja</label>
					<div class="span-2">       
						<input type="text" class="form-control" id="jam2" name="jam2" required>			  
					</div>
				</div>
            </div>
			</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord2()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->
<script>
$(document).ready(function () {
	readRecords();
	readRecords2();
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
	$("#pc2").keydown(function (e) {
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
	$("#jam").keydown(function (e) {
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
	$("#jam2").keydown(function (e) {
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
});
// READ records
function readRecords() {
    $.get("pages/pengaturan_read.php", {}, function (data, status) {
        $(".records_content").html(data);
    });	
}
function readRecords2() {
    $.get("pages/pengaturan_read2.php", {}, function (data, status) {
        $(".records_content2").html(data);
    });
}
// Add Record
function addRecord() {
	// get values
    var pc = $("#pc").val();
    var jam = $("#jam").val();
	if(pc=='' || jam==''){
		swal("","Semua isian harus terisi","warning");
	}else{	
		// Add record
		$.post("pages/pengaturan_add.php", {
			pc: pc,
			jam: jam
		}, function (data, status) {
			swal(data);
			// close the popup
			$("#ubah_pengaturan").modal("hide");
			// read records again
			readRecords();
			// clear fields from the popup
			$("#pc").val("");
			$("#jam").val("");		
		});    
	}
}
// Add Record
function addRecord2() {
	// get values
    var pc = $("#pc2").val();
	var jam = $("#jam2").val();
    var tanggal = $("#tanggal").val();
	if(jam=='' || tanggal==''|| pc==''){
		swal("","Semua isian harus terisi","warning");
	}else{	
		// Add record
		$.post("pages/pengaturan_add2.php", {
			pc: pc,
			jam: jam,
			tanggal: tanggal
		}, function (data, status) {
			swal(data);
			// close the popup
			$("#ubah_pengaturan2").modal("hide");
			// read records again
			readRecords2();
			// clear fields from the popup
			$("#jam2").val("");
			$("#tanggal").val("");		
		});    
	}
}
// Delete Record
function Delete(tgl) {
	swal("Apakah yakin akan menghapus pengaturan tanggal \""+tgl+"\"?", {
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
			$.post("pages/pengaturan_delete.php", {
				 tgl: tgl
			},
				function (data, status) {				
					readRecords2();				
				}
			);
			break;
		default:
			//swal("Batal menghapus");
			break;
	}
	});
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