<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Login - SI PENA</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<!-- FAVICONS -->
		<link rel="icon" href="img/favicon_bps.ico" type="image/x-icon">
        <!--base css styles-->
        <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/normalize/normalize.css">

        <!--page specific css styles-->

        <!--flaty css styles-->
        <link rel="stylesheet" href="css/flaty.css">
        <link rel="stylesheet" href="css/flaty-responsive.css">

        <link rel="shortcut icon" href="img/favicon.html">

        <script src="assets/modernizr/modernizr-2.6.2.min.js"></script>
    </head>
    <body class="login-page">
	
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
<style>
.login-page {
    width: 100%;
    height: auto;   
    background-image: url('img/Kantor BPS Kabupaten Tapanuli Utara.JPG');
    background-repeat: no-repeat;
    background-size: contain;
}
</style>
        <!-- BEGIN Main Content -->
        <div class="login-wrapper">
            <!-- BEGIN Login Form -->
			<form action="login.php" id="form-login" method="post">
                <h3><center>Aplikasi Perencanaan Pengolahan Data</center></h3>
				<?php
				session_start();
				include "koneksinya.php";	
				include "plugins/AES/function.php";
				if(isset($_POST['username']) && isset($_POST['password'] )){
					$sql_cari=mysql_query("select * from user where username='".$_POST['username']."' and password='".$_POST['password']."'");
					$cari=mysql_num_rows($sql_cari);
					$data=mysql_fetch_array($sql_cari);
					if($cari>=1){
						echo'<div class="alert alert-success">
							<button class="close" data-dismiss="alert">&times;</button>
							<h4>Sukses!</h4>
							<p>Username Anda ditemukan.</p>
						</div>';
						$_SESSION['username']=$data['username'];
						$_SESSION['password']=$data['password'];
						$_SESSION['level']=$data['status'];
						echo $_SESSION['username'];
						echo'<script>window.location="index.php?'.paramEncrypt('page=main').'";</script>';
					}else{
						echo'<div class="alert alert-error">
							<button class="close" data-dismiss="alert">&times;</button>
							<h4>Error!</h4>
							<p>Username atau password Anda salah.</p>
						</div>';
					}
				}
				if(isset($_POST['email'])){
						echo'<div class="alert alert-error">
							<button class="close" data-dismiss="alert">&times;</button>
							<h4>Error!</h4>
							<p>Password baru sudah dikirm ke email.</p>
						</div>';
					}
				?>
                <hr/>
                <div class="control-group">
                    <div class="controls">
                        <input type="text" placeholder="Username" class="input-block-level" name="username" id="username" data-rule-required="true" data-rule-minlength="3"/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="password" placeholder="Password" class="input-block-level" name="password" id="password" data-rule-required="true" data-rule-minlength="6"/>
                    </div>
                </div>               
                <div class="control-group">
                    <div class="controls">
						<button type="submit" class="btn btn-primary input-block-level">Masuk</button>
                    <br>
						<a href="#" type="button" class="btn btn-primary input-block-level goto-forgot pull-right">Lupa Password?</a>
					</div>
                </div>
                <hr/> <hr/> 
                <p class="clearfix">
					<center>@2018 BPS Kabupaten Tapanuli Utara</center>
                </p>
            </form>
            <!-- END Login Form -->

            <!-- BEGIN Forgot Password Form -->
            <form id="form-forgot" action="login.php" method="post" class="hide">
                <h3>Lupa Password</h3>
                <hr/>
                <div class="control-group">
                    <div class="controls">
						<input type="text"  placeholder="Email"  name="email" id="email" class="input-block-level" data-rule-required="true" data-rule-email="true" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary input-block-level">Kirim ke Email</button>
                    </div>
                </div>
                <hr/>
                <p class="clearfix">
                    <a href="#" class="goto-login pull-left">← Kembali ke halaman Login</a>
					<center>@2018 BPS Kabupaten Tapanuli Utara</center>
                </p>
            </form>
            <!-- END Forgot Password Form -->

           
        </div>
        <!-- END Main Content -->

        <!--basic scripts-->
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="assets/jquery/jquery-1.10.1.min.js"><\/script>')</script>
        <script src="assets/bootstrap/bootstrap.min.js"></script>
		<script src="assets/nicescroll/jquery.nicescroll.min.js"></script>

		<!--page specific plugin scripts-->
        <script type="text/javascript" src="assets/jquery-validation/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="assets/jquery-validation/dist/additional-methods.min.js"></script>
		<!--flaty scripts-->
        <script src="js/flaty.js"></script>
        <script type="text/javascript">
            function goToForm(form)
            {
                $('.login-wrapper > form:visible').fadeOut(500, function(){
                    $('#form-' + form).fadeIn(500);
                });
            }
            $(function() {
                $('.goto-login').click(function(){
                    goToForm('login');
                });
                $('.goto-forgot').click(function(){
                    goToForm('forgot');
                });
			});
			$("#form-login").validate({
				errorElement: "span",
				errorClass: "help-inline",
				focusInvalid: false,
				ignore: "",
				invalidHandler: function(e, t) {},
				highlight: function(e) {
					$(e).closest(".control-group").removeClass("success").addClass("error")
				},
				success: function(e) {
					e.closest(".control-group").removeClass("error").addClass("success")
				},
				
			});
			$("#form-forgot").validate({
				errorElement: "span",
				errorClass: "help-inline",
				focusInvalid: false,
				ignore: "",
				invalidHandler: function(e, t) {},
				highlight: function(e) {
					$(e).closest(".control-group").removeClass("success").addClass("error")
				},
				success: function(e) {
					e.closest(".control-group").removeClass("error").addClass("success");
				},
				
			});
		</script>
    </body>
</html>
