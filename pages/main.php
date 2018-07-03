<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<li class="active">
			<i class="icon-home"></i>
			<a href="index.php">Home</a>
		</li>
	</ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Main Content -->
<div class="row-fluid">
<?php if($_SESSION['level']==0 || $_SESSION['level']==1 ){ ?>
	<div class="span2">
		<div class="box box-orange">
			<div class="box-title">
				<h3>Pengaturan Aplikasi</h3>
			</div>
			<div class="box-content">
				<p><?php echo "<a href='index.php?".paramEncrypt('page=pengaturan')."'>"; ?><img src="img/Pengaturan Terkini Icon.png"></a></p>
			</div>
		</div>
	</div>
	<div class="span2">
		<div class="box box-red">
			<div class="box-title">
				<h3>Perencanaan Pengolahan</h3>
			</div>
			<div class="box-content">
				<p><?php echo "<a href='index.php?".paramEncrypt('page=perencanaan')."'>"; ?><img src="img/Perencanaan Pengolahan Data.png"></a></p>
			</div>
		</div>
	</div>
<?php } ?>
	<div class="span2">
		<div class="box">
			<div class="box-title">
				<h3>Monitoring Perencanaan</h3>
			</div>
			<div class="box-content">
				<p><?php echo "<a href='index.php?".paramEncrypt('page=monitoring')."'>"; ?><img src="img/Monitoring Perencanaan.png"></a></p>
			</div>
		</div>
	</div>
	<div class="span2">
		<div class="box">
			<div class="box-title">
				<h3>Simulasi Pengolahan</h3>
			</div>
			<div class="box-content">
				<p><?php echo "<a href='index.php?".paramEncrypt('page=simulasi')."'>"; ?><img src="img/Simulasi Pengolahan.gif"></a></p>
			</div>
		</div>
	</div>
	<div class="span2">
		<div class="box box-orange">
			<div class="box-title">
				<h3>Histori Risiko Pengolahan</h3>
			</div>
			<div class="box-content">
				<p><?php echo "<a href='index.php?".paramEncrypt('page=histori')."'>"; ?><img src="img/Risiko Pengolahan.png"></a></p>
			</div>
		</div>
	</div>
<?php if($_SESSION['level']==0){ ?>
	<div class="span2">
		<div class="box box-red">
			<div class="box-title">
				<h3>Kelola Pengguna</h3>
			</div>
			<div class="box-content">
				<p><?php echo "<a href='index.php?".paramEncrypt('page=pengguna')."'>"; ?><img src="img/Kelola Pengguna.png"></a></p>
			</div>
		</div>
	</div>
<?php } ?>
</div>
