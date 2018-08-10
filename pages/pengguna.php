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
		.priority-4{
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
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.php">Home</a>
			<span class="divider"><i class="icon-angle-right"></i></span>
		</li>
		<i class="icon-group"></i><li class="active">Pengguna</li>
	</ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-group"></i> Daftar Pengguna</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div class="pull-right">
					<button class="btn btn-info" data-toggle="modal" data-target="#tambah_dev"><i class="icon-plus"></i> Tambah Pengguna</button>
					<br/>
					<br/>
				</div>
				<input type="text" id="myInput" onkeyup="Searching()" placeholder="Cari username.." title="Type in a username">
				<table id="user" class="table table-bordered table-hover tutorial-table">
					<thead>
						<tr>
							<th class="priority-1"><center>Username</center></th>    
							<th class="priority-4"><center>Password</center></th>
							<th class="priority-3"><center>Status Pengguna</center></th>
							<th class="priority-2"><center>Aksi</center></th>
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
                <h4 class="modal-title" id="myModalLabel">Tambah Pengguna</h4>
            </div>
            <div class="modal-body">
            
            <form name="modul" action="?<?php echo paramEncrypt('page=pengguna'); ?>" class="form-horizontal"  method="post" >
				<div class="box-body">
					<div class="control-group">
						<label class="span-2 control-label">Username</label>
						<div class="span-10">       
							<input type="text" class="form-control" id="username" name="username" required>			  
						</div>
					</div>
					<div class="control-group">
						<label class="span-2 control-label">Password</label>
						<div class="span-10">       
							<input type="text" class="form-control" id="password" name="password" required>			  
						</div>
					</div>
					<div class="control-group">
						<label class="span-2 control-label">Level User</label>
						<div class="span-10">
						<?php
						$query=mysqli_query($conn,"select * from status_user");
						$i=1;
						while($data=mysqli_fetch_array($query)){
							echo "<div class='radio'>
								<label><input type='radio' value ='".$data['kode_status']."' id='level".$i."' name='level'> ".$data['nama']."</label>
							</div>";
							$i++;
						}
						?>  
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
                <div class="control-group">
                  <label class="span-2 control-label">Username</label>					
                  <div class="span-10">       
					<input type="text" class="form-control" id="u_username" name="u_username" readonly required>			  
                  </div>
                </div>
               <div class="control-group">
                  <label class="span-2 control-label">Password</label>					
                  <div class="span-10">       
					<input type="text" class="form-control" id="u_password" name="u_password" required>			  
                  </div>
                </div>
				<div class="control-group">
					<label class="span-2 control-label">Level User</label>
					<div class="span-10">
					<?php
					$query=mysqli_query($conn,"select * from status_user");
					$i=1;
					while($data=mysqli_fetch_array($query)){
						echo "<div class='radio'>
							<label><input type='radio' value ='".$data['kode_status']."' id='u_level".$i."' name='u_level'> ".$data['nama']."</label>
						</div>";
						$i++;
					}
					?>  
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
    td = tr[i].getElementsByTagName("td")[0];
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
    $.get("pages/pengguna_read.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

// Add Record
function addRecord() {
	// get values
    var username = $("#username").val();
    var password = $("#password").val();
	var level = "";
	var radios = document.getElementsByName('level');
	for (var i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			var level=radios[i].value;
		}
	}
	if(username=='' || password==''  || level==''){
		 swal("","Semua isian harus terisi","warning");
	}else{
		if(password.length<6){
			swal("","Password minimal 6 karakter","warning");
		}else{
			// Add record
			$.post("pages/pengguna_add.php", {
				username: username,
				password: password,
				level: level
			}, function (data, status) {
				swal(data);
				// close the popup
				$("#tambah_dev").modal("hide");
				// read records again
				readRecords();
				// clear fields from the popup
				$("#username").val("");
				$("#password").val("");
				$("#level").val("");		
			});    
		}
	}
}
// Delete Record
function Delete(username) {
	swal("Apakah yakin akan menghapus user \""+username+"\"?", {
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
			$.post("pages/pengguna_delete.php", {
				username: username
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
function GetDetails(username) {
    // Add User ID to the hidden field for furture usage
    $("#u_username").val(username);
    $.post("pages/pengguna_readDetails.php", {
            username: username
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#u_username").val(user.username);
            $("#u_password").val(user.password);
            $("#u_level").val(user.level);
        }
    );
    // Open modal popup
    $("#update_dev").modal("show");
	
}
function UpdateDetails() {
    // get values
    var username = $("#u_username").val();
    var password = $("#u_password").val();
	var level = "";
	var radios = document.getElementsByName('u_level');
	for (var i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			var level=radios[i].value;
		}
	}
    if(username=='' || password=='' || level==''){
		 swal("","Semua isian harus terisi","warning");
	}else{
        // Update the details by requesting to the server using ajax
        $.post("pages/pengguna_updateDetails.php", {
    			username: username,
    			password: password,
    			level: level
            },
            function (data, status) {
                // hide modal popup
                alert(data);
                $("#update_dev").modal("hide");
                // reload Users by using readRecords();
                readRecords();
            }
        );
	}
}

</script>