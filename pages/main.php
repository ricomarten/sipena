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
<link href='css/fullcalendar.css' rel='stylesheet' />
<script src='js/moment.min.js'></script> 
<script src='js/fullcalendar.js'></script>
<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
		height: 550,
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,listWeek'
		},
		buttonText:{
			today:    'Hari ini',
			month:    'Lihat per Bulan',
			week:     'week',
			day:      'day',
			list:     'List'
		},
		defaultDate: '<?php echo date("Y-m-d")?>',
		navLinks: true, // can click day/week names to navigate views
     	editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: [
		<?php	
			$sql=mysqli_query($conn,"SELECT kal.*,k.nama FROM `kalender_kegiatan` kal left join kegiatan k on k.id=kal.id_kegiatan ");
			while($data=mysqli_fetch_array($sql)){
				echo " {";
				echo "title: '".str_replace("Pengolahan","",$data['nama'])."',";
				echo "start: '".$data['tanggal']."',";
				//echo "end: '".$data['jadwal_selesai']."'";
				echo "},";
			}
		?>
        
      ]
    });

  });

</script>
<style>
#preview-textfield{
  text-align: center; font-size: 2em; font-weight: bold;
  color: black; font-family: 'Amaranth', sans-serif;
 
}
</style>
<!-- BEGIN Main Content -->
<div class="row-fluid">
	<div class="span6">
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
				$sql=mysqli_query($conn,"select * from kegiatan LIMIT 4");
				$i=0;
				$max=mysqli_num_rows($sql);
				while($data=mysqli_fetch_array($sql)){		
					if($i%2==0) echo '<div class="row-fluid">';
					$awal = strtotime($data['jadwal_awal']);
					$akhir = strtotime($data['jadwal_selesai']);
					$datediff = $akhir - $awal;
					echo '<div class="span6"><div class="well">';
					echo '<center><canvas id="canvas-preview'.$i.'" style="width:100%;"></canvas><div id="preview-textfield'.$i.'"></div></center>';
					echo "".$data['nama']."";
					echo "<p>Jadwal: ".tanggal($data['jadwal_awal'])." s.d. ".tanggal($data['jadwal_selesai'])." (".(round($datediff / (60 * 60 * 24))+1)." hari)<br>";
					echo "Prediksi: ".$data['prediksi'].".</p>";
					echo '</div></div>';		
					$i++;
					if($i%2==0 && $max!=2) echo '</div>';
					if($i%2==0 && $max==2) echo '</div>';
					if($i%2==0 && $max==3 && $i==2)  echo '</div>';
					if($i%2==1 && $max==1 && $i==1)  echo '</div>';
				}
				?>	
				<div class="row-fluid">
					<div class="span12 pull-right">
					<ul class="pager">
						<li class="next"><?php echo "<a href='index.php?".paramEncrypt('page=dashboard')."'>Lihat Dashboard Selengkapnya &rarr;</a>";?></li>
					</ul>
					</div>
				</div>			
			</div>
		</div>
	</div>

	<div class="span6">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-calendar"></i>Kalender Kegiatan</h3>
				<div class="box-tool">
					<a data-action="config" data-modal="setting-modal-1" href="#"><i class="icon-gear"></i></a>
					<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div id='calendar'></div>
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
	$sql=mysqli_query($conn,"select * from kegiatan LIMIT 4");
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