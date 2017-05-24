
<?php 

/**
 * Version 1.0
 * https://legacyig.net/
 * Developed by Mask7OfDragon
 */

  session_start();


  # Incluimos archivo de configuración

  require $_SERVER['DOCUMENT_ROOT'] . '/app/config.php';


  # Seguridad para recibir los datos

  function security($var) {

    $_result = strip_tags($var);

    return $_result;
  }

  $_currency = security($_REQUEST['identifier']);

  # Vista principal de conversion.
  
  function Get_currency() {

    $_dig = $GLOBALS['_currency'];

    $url = 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=XLM,XRP,BTC,ETH,LTC,DASH,XMR,ZEC,DOGE,XDN,XLM,NAV,ETC&tsyms=' . $_dig;
    $crypto = file_get_contents($url);
    $get_crypto = json_decode($crypto, true);

    return $get_crypto;
  }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/assets/icon/favicon.ico">

    <title><?php echo APP_TITLE ?> · Conversion de <?php echo $_currency; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="/assets/material/material.min.css" rel="stylesheet">
  <link href="/assets/material/project.min.css" rel="stylesheet">

  <link href="/assets/normalize/normalize.css" rel="stylesheet">

    <link href="/assets/style/starter-template.css" rel="stylesheet">  
  </head>

  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand"><?php echo APP_TITLE ?></a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/">Documentación</a>
          </li> 
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Modulos del mercado</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Comercio</a>            
              <a class="dropdown-item" href="#">Mercado monetario</a>
            </div>
          </li>                                      
        </ul>      
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="btn btn-outline-success" href="">Available in github</a>
            </li>
        </ul>        
      </div>
    </nav>

    <div class="container">

      <div class="row">

      <?php 

        foreach(Get_currency() as $cc => $value) {

           echo '<div class="col-sm-2 p-2">
                  <div class="card">
                    <div class="card-block">
                      <h4 class="card-title">'. $cc.'</h4>
                      <h6 class="card-subtitle mb-2 text-muted">cambio de '.$_currency.'</h6>
                      <p class="card-text">'. $value[$_currency] .' '. $cc.'</p>
                      <a href="/'. $cc.'" class="card-link">Conversión</a>
                    </div>
                  </div>
                </div>';

        }

      ?>

      </div>

    </div>

    <footer class="footer">
      <div class="container">
        <span class="text-muted"><?php echo APP_COPY ?></span>
      </div>
    </footer>

    <!-- .assets -->
    <script type="/assets/vendor/jquery-slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="/assets/vendor/jquery.min.js"><\/script>')</script>
    <script src="/assets/vendor/tether.min.js"></script>

    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>      
  </body>
</html>
