<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.php">Home</a>
			<span class="divider"><i class="icon-angle-right"></i></span>
		</li>
		<i class="icon-dashboard"></i><li class="active">Dashboard</li>
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
				<h3><i class="icon-dashboard"></i></i>Dashboard</h3>
				<div class="box-tool">
					<a data-action="config" data-modal="setting-modal-1" href="#"><i class="icon-gear"></i></a>
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">			
				<?php
				$sql=mysqli_query($conn,"select * from kegiatan");
				$i=0;
				while($data=mysqli_fetch_array($sql)){
					$max=mysqli_num_rows($sql);
					if($i%3==0) echo '<div class="row-fluid">';
					$awal = strtotime($data['jadwal_awal']);
					$akhir = strtotime($data['jadwal_selesai']);
					$datediff = $akhir - $awal;
					echo '<div class="span4"><div class="well">';
					echo '<center><canvas id="canvas-preview'.$i.'" style="width:100%;"></canvas><div id="preview-textfield'.$i.'"></div></center>';
					echo "<h4>".$data['nama']."</h4>";
					echo "<p>Jadwal: ".tanggal($data['jadwal_awal'])." s.d. ".tanggal($data['jadwal_selesai'])." (".(round($datediff / (60 * 60 * 24))+1)." hari)<br>";
					echo "Prediksi: ".$data['prediksi'].".</p>";
					echo '</div></div>';		
					$i++;
					if($i%3==0 || $max==$i) echo '</div>';
				}
				?>	
			</div>
		</div>
	</div>
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
	$sql=mysqli_query($conn,"select * from kegiatan");
	$i=0;
	while($data=mysqli_fetch_array($sql)){
		//$datediff = strtotime($data['jadwal_selesai']) - strtotime($data['jadwal_awal']);
		//$A=(round($datediff / (60 * 60 * 24))+1);
		$A=$data['hari_kerja'];
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