<?php 
	require_once("config.inc.php");
	  
	$id = intval($_GET['pageid']);
	
	if ($id < 1) {
	  $curpage = $db->query("SELECT * FROM `pages` WHERE `homepage` = 1 LIMIT 1")->fetch_assoc();
	} else {
	  $curpage = $db->query("SELECT * FROM `pages` WHERE `id` = $id LIMIT 1")->fetch_assoc();
	}
	
	updatecount("pages", $curpage['id']);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="<?= $metadata['location']['lang']; ?>" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="<?= $metadata['location']['lang']; ?>" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="<?= $metadata['location']['lang']; ?>" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="<?= $metadata['location']['lang']; ?>" class="no-js"><!-- InstanceBegin template="/Templates/pages.dwt.php" codeOutsideHTMLIsLocked="false" --><!--<![endif]--><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title><?= $metadata['name']; ?></title>
    <!-- InstanceEndEditable -->
    
    <? require_once($basepath."/blocks/metadata.php"); ?>
    
    <? if ($local) { ?>
    	<!-- Latest compiled and minified Bootstrap core CSS -->
        <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css">        
    <? } else { ?>
		<!-- Bootstrap core CSS -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/<?= $bootstrap['version']; ?>/css/bootstrap.min.css" rel="stylesheet">
        <!-- Optional theme -->
        <!-- <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css"> -->
        <!-- Bootstrap Theme -->
        <? if ($bootstrap['theme'] == "default") { ?>
        <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <? } else { ?>
    	<link href="//maxcdn.bootstrapcdn.com/bootswatch/<?= $bootstrap['version']; ?>/<?= $bootstrap['theme'].'/bootstrap.min.css'; ?>" rel="stylesheet">
        <? } ?>
    <? } ?>
    
    <? require_once($basepath . "/inline_edit_head.php"); ?>
    
    <!-- FontAwesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

	<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" rel="stylesheet">
	
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/style.css">
    
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <![endif]-->
	<!-- InstanceBeginEditable name="head" -->
	<!-- InstanceEndEditable -->
</head>
<body>
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    
    <div class="container" id="main-container">
    	<div class="row" id="above_nav">
            <div class="col-xs-12 col-sm-6">
                
            </div>
            <div class="col-xs-12 col-sm-6">
                
            </div>
        </div>
        
        <? require_once($basepath."/blocks/navbar.php"); ?>

		<!-- InstanceBeginEditable name="content" -->
        <div>
          <h1><?= $curpage['title']; ?></h1>
          <div id="page_<?= $curpage['id']; ?>_content"><?= $curpage['content']; ?></div>
        </div>
        <!-- InstanceEndEditable -->
    </div>
    
    <section>
        <div class="container" id="main-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-12 text-center">
                    All Rights Reserved, &copy; <?= date("Y"); ?> <?= $metadata['author']; ?>
                </div>
            </div>
            <div class="row">
            	<div class="col-xs-12 text-center">
                	<a href="<?= $baseurl; ?>/sitemap.php">Site Map</a> | <a href="<?= $baseurl; ?>/<?= $admin_folder; ?>/login.php">Login</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/<?= $bootstrap['version']; ?>/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/20140415/jquery.cycle2.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/20140415/jquery.cycle2.center.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.0.3/wow.min.js"></script>
    <!-- User Scripts -->
    <script src="js/main.js"></script>
    
    <? require_once($basepath . "/inline_edit_foot.php"); ?>
    
	<!-- InstanceBeginEditable name="scripts" -->
    <!-- InstanceEndEditable -->
    
    <? require_once($basepath . "/blocks/analytics.php"); ?>
    
</body>
<!-- InstanceEnd --></html>