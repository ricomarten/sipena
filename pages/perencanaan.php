<!-- BEGIN Breadcrumb -->
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
			<form action="#" class="form-horizontal">
                                   <div class="control-group">
                                      <label class="control-label">Input</label>
                                      <div class="controls">
                                         <input type="text" class="span6" />
                                         <span class="help-inline">Some hint here</span>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Disabled Input</label>
                                      <div class="controls">
                                         <input class="span6" type="text" placeholder="Disabled input here..." disabled />
                                         <span class="help-inline">Some hint here</span>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Readonly Input</label>
                                      <div class="controls">
                                         <input class="span6" type="text" placeholder="Readonly input here..." disabled />
                                         <span class="help-inline">Some hint here</span>
                                      </div>
                                   </div>
                                   <div class="control-group warning">
                                      <label class="control-label">Input with warning</label>
                                      <div class="controls">
                                         <input type="text" class="span6" />
                                         <span class="help-inline">Some hint here</span>
                                      </div>
                                   </div>
                                   <div class="control-group error">
                                      <label class="control-label">Input with error</label>
                                      <div class="controls">
                                         <input type="text" class="span6" />
                                         <span class="help-inline">Some hint here</span>
                                      </div>
                                   </div>
                                   <div class="control-group info">
                                      <label class="control-label">Input with info</label>
                                      <div class="controls">
                                         <input type="text" class="span6" />
                                         <span class="help-inline">Some hint here</span>
                                      </div>
                                   </div>
                                   <div class="control-group success">
                                      <label class="control-label">Input with success</label>
                                      <div class="controls">
                                         <input type="text" class="span6" />
                                         <span class="help-inline">Some hint here</span>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Input with Popover</label>
                                      <div class="controls">
                                         <input type="text" class="span6 show-popover" data-trigger="hover" data-content="Popover body goes here. Popover body goes here." data-original-title="Popover header" />
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Input with Tooltip</label>
                                      <div class="controls">
                                         <input type="text" class="span6 show-tooltip" data-trigger="hover" data-original-title="Tooltip text goes here" />                       
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Auto Complete</label>
                                      <div class="controls">
                                         <input type="text" class="span6" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Alabama&quot;,&quot;Alaska&quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;California&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]" />
                                         <p class="help-block">Start typing to auto complete!. E.g: California</p>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Email Address Input</label>
                                      <div class="controls">
                                         <div class="input-prepend">
                                            <span class="add-on">@</span><input class="" type="text" placeholder="Email Address" />
                                         </div>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Email Address Input</label>
                                      <div class="controls">
                                         <div class="input-icon left">
                                            <i class="icon-envelope"></i>
                                            <input class="" type="text" placeholder="Email Address" />    
                                         </div>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Currency Input</label>
                                      <div class="controls">
                                         <div class="input-prepend input-append">
                                            <span class="add-on">$</span><input class="" type="text" /><span class="add-on">.00</span>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                        <label class="control-label">Prepended inputs</label>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on">@</span>
                                                <input type="text" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Appended icon</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input type="text" placeholder="Secret key" class='input-medium'>
                                                <span class="add-on"><i class="icon-key"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Appended inputs</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input type="text" placeholder="Price" class='input-small'>
                                                <span class="add-on">$</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Prepended and appended input</label>
                                        <div class="controls">
                                            <div class="input-append input-prepend">
                                                <span class="add-on">$</span>
                                                <input type="text" placeholder="XX" class='input-small'>
                                                <span class="add-on">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Input with button</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input type="text" placeholder="..." class='input-large'>
                                                <button class="btn btn-primary" type="button">Go!</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <div class="input-append input-prepend">
                                                <span class="add-on"><i class="icon-search"></i></span>
                                                <input type="text" placeholder="Search here..." class='input-medium'>
                                                <button class="btn" type="button">Search!</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <div class="input-append input-prepend">
                                                <span class="add-on"><i class="icon-search"></i></span>
                                                <input type="text" placeholder="Search here..." class='input-medium'>
                                                <button class="btn btn-inverse" type="button">Search</button>
                                                <button class="btn btn-danger" type="button">Back</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <div class="input-append input-prepend">
                                                <span class="add-on"><i class="icon-edit"></i></span>
                                                <input type="text" placeholder="New things.." class='input-medium'>
                                                <button class="btn" type="button">Save!</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Even more buttons..</label>
                                        <div class="controls">
                                            <div class="input-append input-prepend">
                                                <button class="btn" type="button">Left</button>
                                                <input type="text" placeholder="Which side?" class='input-medium'>
                                                <button class="btn" type="button">Right</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Input with dropdown</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input class="input-medium" type="text">
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                        Action
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#">Some action</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Another action</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <div class="input-append input-prepend">
                                                <button class="btn">Check</button>
                                                <input class="input-medium" type="text">
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                        Action
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#">Some action</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Another action</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Segmented dropdown</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input class="input-medium" type="text">
                                                <div class="btn-group">
                                                    <button class="btn">First</button>
                                                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#">Some action</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Another action</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="control-group">
                                      <label class="control-label">Default Dropdown</label>
                                      <div class="controls">
                                         <select class="span6" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="">Select...</option>
                                            <option value="Category 1">Category 1</option>
                                            <option value="Category 2">Category 2</option>
                                            <option value="Category 3">Category 5</option>
                                            <option value="Category 4">Category 4</option>
                                         </select>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Default Dropdown(Multiple)</label>
                                      <div class="controls">
                                         <select class="span6" multiple="multiple" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="Category 1">Category 1</option>
                                            <option value="Category 2">Category 2</option>
                                            <option value="Category 3">Category 5</option>
                                            <option value="Category 4">Category 4</option>
                                            <option value="Category 3">Category 6</option>
                                            <option value="Category 4">Category 7</option>
                                            <option value="Category 3">Category 8</option>
                                            <option value="Category 4">Category 9</option>
                                         </select>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Custom Dropdown</label>
                                      <div class="controls">
                                         <select class="span6 chosen" data-placeholder="Choose a Category" tabindex="1">
                                            <option value=""> </option>
                                            <option value="Category 1">Category 1</option>
                                            <option value="Category 2">Category 2</option>
                                            <option value="Category 3">Category 5</option>
                                            <option value="Category 4">Category 4</option>
                                         </select>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Grouped Custom Dropdown</label>
                                      <div class="controls">
                                         <select data-placeholder="Your Favorite Football Team" class="chosen span6" tabindex="-1" id="selS0V">
                                            <option value=""> </option>
                                            <optgroup label="NFC EAST">
                                               <option>Dallas Cowboys</option>
                                               <option>New York Giants</option>
                                               <option>Philadelphia Eagles</option>
                                               <option>Washington Redskins</option>
                                            </optgroup>
                                            <optgroup label="NFC NORTH">
                                               <option>Chicago Bears</option>
                                               <option>Detroit Lions</option>
                                               <option>Green Bay Packers</option>
                                               <option>Minnesota Vikings</option>
                                            </optgroup>
                                            <optgroup label="NFC SOUTH">
                                               <option>Atlanta Falcons</option>
                                               <option>Carolina Panthers</option>
                                               <option>New Orleans Saints</option>
                                               <option>Tampa Bay Buccaneers</option>
                                            </optgroup>
                                            <optgroup label="NFC WEST">
                                               <option>Arizona Cardinals</option>
                                               <option>St. Louis Rams</option>
                                               <option>San Francisco 49ers</option>
                                               <option>Seattle Seahawks</option>
                                            </optgroup>
                                            <optgroup label="AFC EAST">
                                               <option>Buffalo Bills</option>
                                               <option>Miami Dolphins</option>
                                               <option>New England Patriots</option>
                                               <option>New York Jets</option>
                                            </optgroup>
                                            <optgroup label="AFC NORTH">
                                               <option>Baltimore Ravens</option>
                                               <option>Cincinnati Bengals</option>
                                               <option>Cleveland Browns</option>
                                               <option>Pittsburgh Steelers</option>
                                            </optgroup>
                                            <optgroup label="AFC SOUTH">
                                               <option>Houston Texans</option>
                                               <option>Indianapolis Colts</option>
                                               <option>Jacksonville Jaguars</option>
                                               <option>Tennessee Titans</option>
                                            </optgroup>
                                            <optgroup label="AFC WEST">
                                               <option>Denver Broncos</option>
                                               <option>Kansas City Chiefs</option>
                                               <option>Oakland Raiders</option>
                                               <option>San Diego Chargers</option>
                                            </optgroup>
                                         </select>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Custom Dropdown Multiple Select</label>
                                      <div class="controls">
                                         <select data-placeholder="Your Favorite Football Teams" class="chosen span6" multiple="multiple" tabindex="6">
                                            <option value=""> </option>
                                            <optgroup label="NFC EAST">
                                               <option>Dallas Cowboys</option>
                                               <option>New York Giants</option>
                                               <option>Philadelphia Eagles</option>
                                               <option>Washington Redskins</option>
                                            </optgroup>
                                            <optgroup label="NFC NORTH">
                                               <option selected>Chicago Bears</option>
                                               <option>Detroit Lions</option>
                                               <option>Green Bay Packers</option>
                                               <option>Minnesota Vikings</option>
                                            </optgroup>
                                            <optgroup label="NFC SOUTH">
                                               <option>Atlanta Falcons</option>
                                               <option selected>Carolina Panthers</option>
                                               <option>New Orleans Saints</option>
                                               <option>Tampa Bay Buccaneers</option>
                                            </optgroup>
                                            <optgroup label="NFC WEST">
                                               <option>Arizona Cardinals</option>
                                               <option>St. Louis Rams</option>
                                               <option>San Francisco 49ers</option>
                                               <option>Seattle Seahawks</option>
                                            </optgroup>
                                            <optgroup label="AFC EAST">
                                               <option>Buffalo Bills</option>
                                               <option>Miami Dolphins</option>
                                               <option>New England Patriots</option>
                                               <option>New York Jets</option>
                                            </optgroup>
                                            <optgroup label="AFC NORTH">
                                               <option>Baltimore Ravens</option>
                                               <option>Cincinnati Bengals</option>
                                               <option>Cleveland Browns</option>
                                               <option>Pittsburgh Steelers</option>
                                            </optgroup>
                                            <optgroup label="AFC SOUTH">
                                               <option>Houston Texans</option>
                                               <option>Indianapolis Colts</option>
                                               <option>Jacksonville Jaguars</option>
                                               <option>Tennessee Titans</option>
                                            </optgroup>
                                            <optgroup label="AFC WEST">
                                               <option>Denver Broncos</option>
                                               <option>Kansas City Chiefs</option>
                                               <option>Oakland Raiders</option>
                                               <option>San Diego Chargers</option>
                                            </optgroup>
                                         </select>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Custom Dropdown Diselect</label>
                                      <div class="controls">
                                         <select data-placeholder="Your Favorite Type of Bear" class="chosen-with-diselect span6" tabindex="-1" id="selCSI">
                                            <option value=""> </option>
                                            <option>American Black Bear</option>
                                            <option>Asiatic Black Bear</option>
                                            <option>Brown Bear</option>
                                            <option>Giant Panda</option>
                                            <option selected="">Sloth Bear</option>
                                            <option>Sun Bear</option>
                                            <option>Polar Bear</option>
                                            <option>Spectacled Bear</option>
                                         </select>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Radio Buttons</label>
                                      <div class="controls">
                                         <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option1" /> Option 1
                                         </label>
                                         <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option2" checked /> Option 2
                                         </label>  
                                         <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option2" /> Option 3
                                         </label>  
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Radio Buttons</label>
                                      <div class="controls">
                                         <label class="radio inline">
                                            <input type="radio" name="optionsRadios2" value="option1" /> Option 1
                                         </label>
                                         <label class="radio inline">
                                            <input type="radio" name="optionsRadios2" value="option2" checked /> Option 2
                                         </label>  
                                         <label class="radio inline">
                                            <input type="radio" name="optionsRadios2" value="option2" /> Option 3
                                         </label>  
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Checkbox</label>
                                      <div class="controls">
                                         <label class="checkbox">
                                            <input type="checkbox" value="" /> Checkbox 1
                                         </label>
                                         <label class="checkbox">
                                            <input type="checkbox" value="" /> Checkbox 2
                                         </label>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Checkbox</label>
                                      <div class="controls">
                                         <label class="checkbox inline">
                                            <input type="checkbox" value="" /> Checkbox 1
                                         </label>
                                         <label class="checkbox inline">
                                            <input type="checkbox" value="" /> Checkbox 2
                                         </label>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                      <label class="control-label">Textarea</label>
                                      <div class="controls">
                                         <textarea class="span6" rows="3"></textarea>
                                      </div>
                                   </div>
                                   <div class="form-actions">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                      <button type="button" class="btn">Cancel</button>
                                   </div>
                                </form>
			</div>	
		<?php } ?>
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
		alert("semua isian harus terisi");
	}else{		
		// Add record
		$.post("pages/histori_add.php", {
			risiko: risiko,
			mitigasi: mitigasi,
			status_risiko: status_risiko
		}, function (data, status) {
			alert(data);
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
    var conf = confirm("Apakah yakin akan menghapus resiko \""+risiko+"\"?");
    if (conf == true) {
        $.post("pages/histori_delete.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
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
		alert("semua isian harus terisi");
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
                alert(data);
                $("#update_dev").modal("hide");
                // reload Users by using readRecords();
                readRecords();
            }
        );
	}
}

</script>

<!--page specific plugin scripts-->
<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
