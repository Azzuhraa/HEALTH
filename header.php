<?php
error_reporting(0);
require_once 'config/config.php';
require_once 'config/koneksi.php';
require_once 'lib/site_title.php';
require_once 'lib/redirect.php';

$sqlHal = 'SELECT * FROM halaman';
$qryHal = $mysqli->query($sqlHal) or die($mysqli->error);

$sqlKat = 'SELECT
kategori.id_kategori,
kategori.kategori
FROM
kategori
INNER JOIN berita ON kategori.id_kategori = berita.id_kategori
GROUP BY
kategori.kategori
ORDER BY
kategori.id_kategori ASC
LIMIT 0, 5';
$qryKat = $mysqli->query($sqlKat) or die($mysqli->error);

$sqlBreaking = 'SELECT berita.id_berita, berita.judul FROM berita ORDER BY berita.tgl_posting DESC LIMIT 0, 5';
$qryBreaking = $mysqli->query($sqlBreaking);

$url = $_SERVER['REQUEST_URI'];
$explode_url = explode("/", $url);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Health</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/hover-min.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="stylesheet" href="assets/wow/css/animate.css">
  <script src="<?php echo $base_url; ?>assets/jquery/jquery-1.12.0.min.js"></script>
  <link href="images/logo1.jpg" rel="icon">
    <link href="images/logo1.jpg" rel="logo1">
</head>
<body>
	<div class="row header-wrapper">
		<div class="container">
		<div class="header">
			<h3 class="site-title">
			<br>
				<center> H E A L T H </center>

			</h3>
			
		

    <!-- Collect the nav links, forms, and other content for toggling -->
    			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      				<ul class="nav navbar-nav">

              <?php if ($explode_url[2] == 'index.php' || $explode_url[2] == '') { ?>

        				<li class="active"><a href="index.php" class="hvr-sweep-to-top"><i class="glyphicon glyphicon-home"></i></a></li>

              <?php } else { ?>

                <li><a href="index.php" class="hvr-sweep-to-top"><i class="glyphicon glyphicon-home"></i></a></li>

              <?php } ?>

              <?php while ($kat_menu=$qryKat->fetch_array()) { ?>

              <?php if (isset($_GET['kat']) && $kat_menu['id_kategori'] == $_GET['id']) { ?>

	        			<li class="active">
                  <a class="hvr-sweep-to-top" href="<?php echo $base_url."kategori.php?id=".$kat_menu['id_kategori']."&amp;kat=".strtolower($kat_menu['kategori']); ?>">
                    <?php echo $kat_menu['kategori']; ?>
                    </a>
                </li>

              <?php } else { ?>

	        			<li>
                  <a class="hvr-sweep-to-top" href="<?php echo $base_url."kategori.php?id=".$kat_menu['id_kategori']."&amp;kat=".strtolower($kat_menu['kategori']); ?>">
                    <?php echo $kat_menu['kategori']; ?>
                  </a>
                </li>

              <?php } ?>

              <?php } ?>
    	  			</ul>
             
    			</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
		  </nav>
		</div>
	</div>
</div>
<div class="clear"></div>