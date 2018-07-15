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
<style>
#preview-textfield{
  text-align: center; font-size: 2em; font-weight: bold;
  color: black; font-family: 'Amaranth', sans-serif;
}
</style>
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-bar-chart"></i>Dashboard</h3>
				<div class="box-tool">
					<a data-action="config" data-modal="setting-modal-1" href="#"><i class="icon-gear"></i></a>
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div class="row-fluid">
				<?php
				$sql=mysql_query("select * from kegiatan");
				$i=0;
				while($data=mysql_fetch_array($sql)){
					echo '<div class="span4"><div class="well">';
					echo '<center><canvas id="canvas-preview'.$i.'"></canvas><div id="preview-textfield'.$i.'"></div></center>';
					echo "<h4>".$data['nama']."</h4>";
					echo "<p>".$data['prediksi'].".</p>";
					echo '</div></div>';
					$i++;
				}
				?>
                    
					
				</div>
			</div>
		</div>
	</div>
</div>

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
				<p><?php echo "<a href='index.php?".paramEncrypt('page=histori')."'>"; ?><img src="img/Risiko Pengolahan.png"></a>
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

<script type="text/javascript" src="js/gauge.js"></script>
<script>
var opts = {
  angle: 0, // The span of the gauge arc
  lineWidth: 0.3, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.6, // // Relative to gauge radius
    strokeWidth: 0.035, // The thickness
    color: '#000000' // Fill color
  },
  staticLabels: {
  //font: "10px sans-serif",  // Specifies font
  labels: [-30, 0, 30],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
  },
  
  staticZones: [
   {strokeStyle: "#30B32D", min: -30, max: 0}, // Red from 100 to 130
   {strokeStyle: "#F03E3E", min: 0, max: 30}  // Red
	],
      
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  
};
<?php
	$sql=mysql_query("select * from kegiatan");
	$i=0;
	while($data=mysql_fetch_array($sql)){
		$datediff = strtotime($data['jadwal_selesai']) - strtotime($data['jadwal_awal']);
		$A=(round($datediff / (60 * 60 * 24))+1);
		$B=$data['target_dokumen'];
		$C=$data['waktu_olah'];
		$D=$B*$C;
		$E=$data['jam_kerja'];
		$F=$E*60;
		$G=$data['pc'];
		$H=round(($D/$F)/$G);
		if($H==0) $H=1;
		echo "var target".$i." = document.getElementById('canvas-preview".$i."'); // your canvas element
			var gauge".$i." = new Gauge(target".$i.").setOptions(opts); // create sexy gauge!
			gauge".$i.".setTextField(document.getElementById(\"preview-textfield".$i."\"));
			gauge".$i.".maxValue = 30; // set max gauge value
			gauge".$i.".setMinValue(-30);  // Prefer setter over gauge.minValue = 0
			gauge".$i.".animationSpeed = 32; // set animation speed (32 is default value)
			gauge".$i.".set(".($H-$A)."); // set actual value";
		echo "\n";
		$i++;
	}
?>

</script>