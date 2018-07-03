<!-- BEGIN Navbar -->
        <div id="navbar" class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN Brand -->
                    <a href="#" class="brand">
                        <img src="img/SI PENA.png" width="250">
                    </a>
                    <!-- END Brand -->

                    <!-- BEGIN Responsive Sidebar Collapse -->
                    <a href="#" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-reorder"></i>
                    </a>
                    <!-- END Responsive Sidebar Collapse -->

                    <!-- BEGIN Navbar Buttons -->
                    <ul class="nav flaty-nav pull-right">
                        <!-- BEGIN Button User -->
                        <li class="user-profile">
                            <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                                <img class="nav-user-photo" src="img/demo/avatar/avatar2.jpg" alt="Penny's Photo" />
                                <span class="hidden-phone" id="user_info">
                                    <?php
									if($_SESSION['level']==0) $level="Administrator";
									elseif($_SESSION['level']==1) $level="Seksi IPDS";
									elseif($_SESSION['level']==2) $level="Subject Matter";
									elseif($_SESSION['level']==3) $level="Kepala BPS";
									echo $_SESSION['username']." (".$level.")";
									?>
                                </span>
                                <i class="icon-caret-down"></i>
                            </a>

                            <!-- BEGIN User Dropdown -->
                            <ul class="dropdown-menu dropdown-navbar" id="user_menu">   
								
                                <li class="visible-phone">
                                    <a href="#">
                                        <i class="icon-user"></i>
                                        <?php
											if($_SESSION['level']==0) $level="Administrator";
											elseif($_SESSION['level']==1) $level="Seksi IPDS";
											elseif($_SESSION['level']==2) $level="Subject Matter";
											elseif($_SESSION['level']==3) $level="Kepala BPS";
											echo $_SESSION['username']." (".$level.")";
										?>
                                    </a>
                                </li>

                                <li class="divider visible-phone"></li>
								<li>
                                    <a href="logout.php">
                                        <i class="icon-off"></i>
                                        Keluar
                                    </a>
                                </li>
                            </ul>
                            <!-- BEGIN User Dropdown -->
                        </li>
                        <!-- END Button User -->
                    </ul>
                    <!-- END Navbar Buttons -->
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </div>
        <!-- END Navbar -->
		<!-- BEGIN Container -->
        <div class="container-fluid" id="main-container">
            <!-- BEGIN Sidebar -->
            <div id="sidebar" class="nav-collapse">
                <!-- BEGIN Navlist -->
                <ul class="nav nav-list">
				<?php
				if($_SESSION['level']==0){
					if($page=='main') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php'><i class='icon-home'></i><span>Home</span></a></li>";
					if($page=='pengaturan') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=pengaturan')."'><i class='icon-wrench'></i><span>Pengaturan</span></a></li>";
					if($page=='perencanaan') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=perencanaan')."'><i class='icon-pencil'></i><span>Perencanaan</span></a></li>";
					if($page=='monitoring') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=monitoring')."'><i class='icon-bar-chart'></i><span>Monitoring</span></a></li>";
					if($page=='simulasi') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=simulasi')."'><i class='icon-list-alt'></i><span>Simulasi Pengolahan</span></a></li>";
					if($page=='histori') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=histori')."'><i class='icon-shield'></i><span>Histori Risiko</span></a></li>";
					if($page=='pengguna') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=pengguna')."'><i class='icon-group'></i><span>Kelola Pengguna</span></a></li>";
				}
				else if($_SESSION['level']==1){
					if($page=='main') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php'><i class='icon-home'></i><span>Home</span></a></li>";
					if($page=='pengaturan') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=pengaturan')."'><i class='icon-wrench'></i><span>Pengaturan</span></a></li>";
					if($page=='perencanaan') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=perencanaan')."'><i class='icon-pencil'></i><span>Perencanaan</span></a></li>";
					if($page=='monitoring') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=monitoring')."'><i class='icon-bar-chart'></i><span>Monitoring</span></a></li>";
					if($page=='simulasi') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=simulasi')."'><i class='icon-list-alt'></i><span>Simulasi Pengolahan</span></a></li>";
					if($page=='histori') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=histori')."'><i class='icon-shield'></i><span>Histori Risiko</span></a></li>";
					//if($page=='pengguna') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=pengguna')."'><i class='icon-group'></i><span>Kelola Pengguna</span></a></li>";
				}
				else{
					if($page=='main') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php'><i class='icon-home'></i><span>Home</span></a></li>";
					//if($page=='pengaturan') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=pengaturan')."'><i class='icon-wrench'></i><span>Pengaturan</span></a></li>";
					//if($page=='perencanaan') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=perencanaan')."'><i class='icon-pencil'></i><span>Perencanaan</span></a></li>";
					if($page=='monitoring') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=monitoring')."'><i class='icon-bar-chart'></i><span>Monitoring</span></a></li>";
					if($page=='simulasi') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=simulasi')."'><i class='icon-list-alt'></i><span>Simulasi Pengolahan</span></a></li>";
					if($page=='histori') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=histori')."'><i class='icon-shield'></i><span>Histori Risiko</span></a></li>";
					//if($page=='pengguna') echo "<li class='active'>"; else echo "<li>"; echo"<a href='index.php?".paramEncrypt('page=pengguna')."'><i class='icon-group'></i><span>Kelola Pengguna</span></a></li>";
				}
				?>
                   <li> 
						<a href="box.html">
                            <i class="icon-list-alt"></i>
                            <span>Box</span>
                        </a>
                    </li>
                </ul>
                <!-- END Navlist -->

                <!-- BEGIN Sidebar Collapse Button -->
                <div id="sidebar-collapse" class="visible-desktop">
                    <i class="icon-double-angle-left"></i>
                </div>
                <!-- END Sidebar Collapse Button -->
            </div>
            <!-- END Sidebar -->