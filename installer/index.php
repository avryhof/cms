<?
	require_once($_SERVER['DOCUMENT_ROOT']."/installer/installer-config.inc.php");
?>
<!DOCTYPE html>
<html lang="en" class="no-js"><!-- InstanceBegin template="/Templates/installer-pages.dwt.php" codeOutsideHTMLIsLocked="false" --><!--<![endif]-->
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>CMS &raquo; Install</title>
    <!-- InstanceEndEditable -->
    
    <!-- Latest compiled and minified Bootstrap core CSS -->
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/jasny/bootstrap/dist/css/jasny-bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css">        
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <![endif]-->
  <!-- InstanceBeginEditable name="head" -->
  <!-- InstanceEndEditable -->
</head>

  <body>
    <div class="container">
      <div class="row">
      	<div class="col-xs-12">
        	<h1><i class="fa fa-code"></i> CMS Installer</h1>
        </div>
        <div class="col-xs-12">
        <!-- InstanceBeginEditable name="content" -->
        
        <ol class="breadcrumb">
  			<li class="active"><span>Database</span></li>
		</ol>
        
        <p>Below you should enter your database connection details. If you're not sure about these, contact your host.</p>
        
        <form class="form-horizontal" action="index2.php" method="post">
        	<div class="form-group">
            	<label for="db_name" class="col-xs-12 col-sm-3 control-label">Database Name</label>
                <div class="col-xs-12 col-sm-6">
                	<input type="text" class="form-control" name="db_name" id="db_name">
                </div>
                <div class="col-xs-12 col-sm-3">
                	<p class="help-block">The name of the database you want your CMS in.</p>
                </div>
            </div>
            <div class="form-group">
            	<label for="db_user" class="col-xs-12 col-sm-3 control-label">User Name</label>
                <div class="col-xs-12 col-sm-6">
                	<input type="text" class="form-control" name="db_user" id="db_user">
                </div>
                <div class="col-xs-12 col-sm-3">
                	<p class="help-block">Your MySQL username.</p>
                </div>
            </div>
            <div class="form-group">
            	<label for="db_pass" class="col-sm-3 control-label">Password</label>
                <div class="col-xs-12 col-sm-6">
                	<input type="text" class="form-control" name="db_pass" id="db_pass">
                </div>
                <div class="col-xs-12 col-sm-3">
                	<p class="help-block">&hellip;and MySQL password.</p>
                </div>
            </div>
            <div class="form-group">
            	<label for="db_host" class="col-xs-12 col-sm-3 control-label">Database Host</label>
                <div class="col-xs-12 col-sm-6">
                	<input type="text" class="form-control" name="db_host" id="db_host" placeholder="localhost">
                </div>
                <div class="col-xs-12 col-sm-3">
                	<p class="help-block">99% chance you won't need to change this value.</p>
                </div>
            </div>
            <div class="form-group">
            	<label for="next" class="col-xs-12 col-sm-3 control-label">&nbsp;</label>
                <div class="col-xs-12 col-sm-6">
                	<button type="submit" name="next" id="next" class="btn btn-default">Next &raquo;</button>
                </div>
                <div class="col-xs-12 col-sm-3">
                </div>
            </div>
        </form>
        
        <!-- InstanceEndEditable -->
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/<?= $bootstrap['version']; ?>/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
	<!-- InstanceBeginEditable name="code" -->
    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>