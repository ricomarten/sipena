<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.php">Home</a>
			<span class="divider"><i class="icon-angle-right"></i></span>
		</li>
		<i class="icon-shield"></i><li class="active">Histori Risiko</li>
	</ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-shield"></i> Daftar Histori Risiko Pengolahan Data</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div class="pull-right">
					<button class="btn btn-info" data-toggle="modal" data-target="#tambah_dev"><i class="icon-plus"></i> Tambah Histori</button>
					<br/>
					<br/>
				</div>
				<input type="text" id="myInput" onkeyup="Searching()" placeholder="Cari risiko.." title="Type in a name">
				<table id="user" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><center>No</center></th>    
							<th><center>Risiko yang Pernah Terjadi</center></th>
							<th><center>Tindakan Mitigasi Risiko</center></th>
							<th><center>Status</center></th>
							<th><center>Aksi</center></th>
						</tr>
					</thead>
					<tbody class="records_content">	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal hide fade" id="tambah_dev" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Histori Risiko</h4>
            </div>
            <div class="modal-body">
            
            <form name="modul" action="?<?php echo paramEncrypt('page=pengguna'); ?>" class="form-horizontal"  method="post" >
				<div class="box-body">
					<div class="control-group">
						<label class="span-2 control-label">Risiko yang Terjadi</label>
						<div class="span-10">
							<textarea id="risiko" name="risiko"  rows="3"></textarea>	
						</div>
					</div>
					<div class="control-group">
						<label class="span-2 control-label">Tindakan Mitigasi</label>
						<div class="span-10">	
							<textarea id="mitigasi" name="mitigasi"  rows="3"></textarea>							
						</div>
					</div>
					<div class="control-group">
						<label class="span-2 control-label">Status</label>
						<div class="span-10">       
							<textarea id="status" name="status"  rows="3"></textarea>
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
</div><!-- Modal - Update -->
<div class="modal hide fade" id="update_dev" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Pengguna</h4>
            </div>
            <div class="modal-body">

            <form name="modul" action="?<?php echo paramEncrypt('page=pengguna'); ?>" class="form-horizontal"  method="post" >
            <div class="box-body">
				<input type="hidden" id="u_id" name="u_id"/>
                <div class="control-group">
                  <label class="span-2 control-label">Risiko yang Terjadi</label>					
                  <div class="span-10">       
					<textarea id="u_risiko" name="u_risiko"  rows="3"></textarea>			  
                  </div>
                </div>
				<div class="control-group">
					<label class="span-2 control-label">Tindakan Mitigasi</label>
					<div class="span-10">	
						<textarea id="u_mitigasi" name="u_mitigasi"  rows="3"></textarea>							
					</div>
				</div>
				<div class="control-group">
					<label class="span-2 control-label">Status</label>					
					<div class="span-10">       
						<textarea id="u_status" name="u_status"  rows="3"></textarea>			  
					</div>
                </div>
            </div>
			</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateDetails()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- END Modal>
<!-- END Main Content -->
<script>
$(document).ready(function () {
	readRecords();
});
//searching
function Searching() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("user");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
// READ records
function readRecords() {
    $.get("pages/histori_read.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

// Add Record
function addRecord() {
	// get values
    var risiko 			= $("#risiko").val();
    var mitigasi 		= $("#mitigasi").val();
	var status_risiko	= $("#status").val();
	if(risiko=='' || mitigasi==''  || status_risiko==''){
		 swal("","Semua isian harus terisi","warning");
	}else{		
		// Add record
		$.post("pages/histori_add.php", {
			risiko: risiko,
			mitigasi: mitigasi,
			status_risiko: status_risiko
		}, function (data, status) {
			swal(data);
			// close the popup
			$("#tambah_dev").modal("hide");
			// read records again
			readRecords();
			// clear fields from the popup
			$("#risiko").val("");
			$("#mitigasi").val("");
			$("#status").val("");		
		});    		
	}
}
// Delete Record
function Delete(id,risiko) {
	swal("Apakah yakin akan menghapus perencanaan \""+risiko+"\"?", {
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
			$.post("pages/histori_delete.php", {
				id: id
			},
				function (data, status) {
					readRecords();
				}
			);
			break;
		default:
			//swal("Batal menghapus");
			break;
	}
	});
    
}
function GetDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#u_id").val(id);
    $.post("pages/histori_readDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#u_id").val(user.id);
            $("#u_risiko").val(user.risiko);
            $("#u_mitigasi").val(user.mitigasi);
            $("#u_status").val(user.status);
        }
    );
    // Open modal popup
    $("#update_dev").modal("show");
	
}
function UpdateDetails() {
    // get values
    var id = $("#u_id").val();
    var risiko = $("#u_risiko").val();
    var mitigasi = $("#u_mitigasi").val();
    var status_risiko = $("#u_status").val();
    if(risiko=='' || mitigasi=='' || status_risiko==''){
		 swal("","Semua isian harus terisi","warning");
	}else{
        // Update the details by requesting to the server using ajax
        $.post("pages/histori_updateDetails.php", {
    			id:id,
				risiko: risiko,
    			mitigasi: mitigasi,
    			status_risiko: status_risiko
            },
            function (data, status) {
                // hide modal popup
                swal(data);
                $("#update_dev").modal("hide");
                // reload Users by using readRecords();
                readRecords();
            }
        );
	}
}

</script>