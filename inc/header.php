<?php
if(!isset($_SESSION))
{
    session_start();
}
require_once('config.php');
if (isset($_SESSION['user_id'])){
    $_SESSION['time'] = time() + 3600;
    $login = true;
} else {
    $login = false;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="XXVII Congreso Latinoamericano de Estudiantes e Ingenieros Industriales y Afines">
    <title>XXVII Congreso Latinoamericano de Estudiantes e Ingenieros Industriales y Afines</title>
    <meta name="description" content="XXVII CLEIN Republica Dominicana 2018 - Santo Domingo del 29 de octubre a 3 de noviembre de 2018">
    <meta property="og:title" content="CLEIN Republica Dominicana 2018" />
    <meta property="og:site_name" content="CLEIN Republica Dominicana 2018">
    <meta property="og:url" content="<?php echo WEB_URL;?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Santo Domingo - Republica Dominicana del 29 de octubre a 3 de noviembre de 2018" />
    <meta property="og:image" itemprop="image" content="<?php echo WEB_URL;?>/img/IMAGEN-DE-HOME.jpg" />
    <meta property="og:image:url" content="<?php echo WEB_URL;?>/img/IMAGEN-DE-HOME.jpg">
    <meta property="og:image:height" content="474">
    <meta property="og:image:width" content="1280">



    <script async="" src="https://www.google-analytics.com/analytics.js"></script><script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-66351966-3', 'auto');
        ga('send', 'pageview');

    </script>











    <!--CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/lightbox.css">

    <!--JS-->
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/lightbox.min.js"></script>
    <script type="text/javascript">
        var host = "<?php echo WEB_URL;?>";
    </script>
    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript" src="js/loginControl.js"></script>

</head>
<body>
<?php include_once("analyticstracking.php") ?>
<header>
    <div class="container">
        <div class="navbar-header">
            <a href="index.php"><div class="logo">CLEIN República Dominicana 2018</div></a>
            <a href="#" id="mobile-menu-trigger" class="mobile-menu-closed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <nav id="menu">
            <?php include 'menuprincipal.php'; ?>
        </nav>

        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false">
            <?php include 'menuprincipal.php'; ?>
        </div>
    </div>
</header>
<div style="height:120px;">&nbsp;</div>