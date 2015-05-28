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
<!--[if gt IE 8]><!--> <html lang="<?= $metadata['location']['lang']; ?>" class="no-js"><!--<![endif]--><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TemplateBeginEditable name="doctitle" -->
    <title><?= $metadata['name']; ?></title>
    <!-- TemplateEndEditable -->
    <meta name="description" content="<?= $metadata['desc']; ?>" />
    <meta name="author" content="<?= $metadata['author']; ?>" />    
    <META NAME="keywords" CONTENT="<?= $metadata['keywords']; ?>" />
    <meta name="news_keywords" CONTENT="<?= $metadata['keywords']; ?>" />
    <META NAME="robot" CONTENT="index,follow" />
    <META NAME="language" CONTENT="<?= $metadata['location']['lang']; ?>" />
    <meta name="geo.region" content="<?= $metadata['location']['country']; ?>-<?= $metadata['region']; ?>" />
    <meta name="geo.placename" content="<?= $metadata['city']; ?>" />
    <meta name="geo.position" content="<?= $metadata['location']['coords']['latitude']; ?>;<?= $metadata['location']['coords']['longitude']; ?>" />
    <meta name="ICBM" content="<?= $metadata['location']['coords']['latitude']; ?>, <?= $metadata['location']['coords']['longitude']; ?>" />
    
    <? if (!empty($metadata['google']['publisher'])) { ?>
    <link rel="publisher" href="<?= $metadata['google']['publisher']; ?>" />
    <? } ?>
    <? if (!empty($metadata['google']['author'])) { ?>
    <link rel="author" href="https://plus.google.com/+<?= $metadata['google']['author']; ?>" />
    <? } ?>
    <link rel="icon" type="image/png" href="<?= $metadata['images']['favicon']; ?>" />
    
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?= $metadata['name']; ?>" />
    <meta itemprop="description" content="<?= $metadata['desc']; ?>" />
    <meta itemprop="image" content="<?= $metadata['images']['logo']; ?>" />
    
    <!-- Twitter Card data -->
    <meta name="twitter:card" value="<?= $metadata['name']; ?>" />
    <meta name="twitter:title" content="<?= $metadata['name']; ?>" />
    <meta name="twitter:description" content="<?= $metadata['desc']; ?>" />
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="<?= $metadata['images']['logo']; ?>" />
    <? if (!empty($metadata['twitter']['username'])) { ?>
    <meta name="twitter:site" content="@<?= $metadata['twitter']['username']; ?>" />
    <meta name="twitter:creator" content="@<?= $metadata['twitter']['username']; ?>" />
    <? } ?>
    
    <!-- Open Graph data -->
    <meta property="og:title" content="<?= $metadata['name']; ?>" />
    <meta property="og:site_name" content="<?= $metadata['name']; ?>" />
    <meta property="og:description" content="<?= $metadata['desc']; ?>" /> 
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= $baseurl; ?>" />
    <meta property="og:image" content="<?= $metadata['images']['logo']; ?>" />
    <meta property="og:locale" content="<?= $metadata['location']['lang']; ?>_<?= strtolower($metadata['location']['country']); ?>" />
    <? if (!empty($metadata['facebook']['username'])) { ?>
    <meta property="article:author" content="<?= $metadata['facebook']['username']; ?>" />
    <? } ?>
    <? if (!empty($metadata['facebook']['pagename'])) { ?>
    <meta property="article:publisher" content="<?= $metadata['facebook']['pagename']; ?>" />
    <? } ?>
    <meta property="article:published_time" content="<?= date("c",filectime(__FILE__)); ?>" />
    <meta property="article:modified_time" content="<?= date("c",filemtime(__FILE__)); ?>" />
    <meta property="article:section" content="Article Section" />
    <!-- <meta property="article:tag" content="Article Tag" /> -->
    <meta property="fb:admins" content="" /> 
    <? if (!empty($metadata['facebook']['appid'])) { ?>
    <meta property="fb:app_id" content="<?= $metadata['facebook']['appid']; ?>" />   
    <? } ?>
    
    <? if ($local) { ?>
    	<!-- Latest compiled and minified Bootstrap core CSS -->
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css">        
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
    <link rel="stylesheet" href="../css/style.css">
    
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <![endif]-->
	<!-- TemplateBeginEditable name="head" -->
	<!-- TemplateEndEditable -->
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
        
        <div class="navbar navbar-default" id="main-nav">
        	<div class="container">
            	<div class="navbar-header">
                	<a href="../" class="navbar-brand">&nbsp;</a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    	<span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
        		</div>
                <div class="navbar-collapse collapse" id="navbar-main">
                	<? show_pages_list(-1, true, 'nav navbar-nav') ?>
                </div>
      		</div>
    	</div>

		<!-- TemplateBeginEditable name="content" -->
        <div>
          <h1><?= $page['title']; ?></h1>
          <div id="page_<?= $curpage['id']; ?>_content" contenteditable="true"><?= $page['content']; ?></div>
        </div>
        <!-- TemplateEndEditable -->
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
                	<a href="../sitemap.php">Site Map</a> | <a href="<?= $admin_folder; ?>/login.php">Login</a>
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
    <script src="../js/main.js"></script>
    
    <? require_once($basepath . "/inline_edit_foot.php"); ?>
    
	<!-- TemplateBeginEditable name="scripts" -->
    <!-- TemplateEndEditable -->
    
    <? require_once($basepath . "/blocks/analytics.php"); ?>
    
</body>
</html>