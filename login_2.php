<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="description" content="Aplikasi buatan Brian Firdian">
    <meta name="author" content="Brian Firdian">
    <meta name="keyword" content="Brian Firdian, BPS, Sumut">
    <link rel="shortcut icon" href="http://103.30.94.30/project/pengolahan/packages/img/favicon.ico">

    <meta name="csrf-token" content="eoET4PYdlx9ObPJkgPhdHLb224LDOvqU8GdbeVKq">

    <title>Login</title>

    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="http://103.30.94.30/project/pengolahan/packages/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://103.30.94.30/project/pengolahan/packages/vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://103.30.94.30/project/pengolahan/packages/css/animate.css" >
    <link rel="stylesheet" href="http://103.30.94.30/project/pengolahan/packages/css/login/login.css" >

    <script src="http://103.30.94.30/project/pengolahan/packages/vendor/jquery.min.js" type="text/javascript"></script>
    <script src="http://103.30.94.30/project/pengolahan/packages/vendor/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="http://103.30.94.30/project/pengolahan/packages/js/login/login.js"></script>
  </head>
  <body>
    <div class="row">
      <div class="container">
        <div id="login-box">
          <div class="logo">
            <h1 class="logo-caption animated rotateIn delay1" style="font-size: 2em;"><span class="tweak">P</span>engawasan <span class="tweak">P</span>engolahan</h1>
            <div class="animated flip">
              <img src="http://103.30.94.30/project/pengolahan/packages/img/750.png" class="img img-responsive center-block img-logo "/>
              <h4 class="logo-caption" style="margin-top: -0.5em;">BADAN PUSAT STATISTIK<br>Provinsi Sumatera Utara <br><hr></h4>
            </div>
          </div> 
          <div class="controls">
            <form role="form" method="POST" action="http://103.30.94.30/project/pengolahan/login">
              <input type="hidden" name="_token" value="eoET4PYdlx9ObPJkgPhdHLb224LDOvqU8GdbeVKq">
              <div class="input-group input-group-lg animated zoomInDown delay2">
                <span class="input-group-addon" id="sizing-addon1">@</span>
                <input type="text" class="form-control" placeholder="Username BPS/Email BPS" name="username">
              </div>
              <br>
              <div class="input-group input-group-lg animated zoomInDown delay3">
                <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div>
              <br>
              <button type="submit" class="btn btn-default btn-block btn-custom animated zoomInDown delay4"><strong>Masuk</strong> <i class="fa fa-sign-in"></i> </button>
            </form>
          </div> 
        </div> 
      </div> 
      <div id="particles-js"></div>
    </div>
  </body>
</html>