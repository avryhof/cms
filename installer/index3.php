<? 
	require_once($_SERVER['DOCUMENT_ROOT']."/installer/installer-config.inc.php");
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$bootstrap = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT']."/vendor/twbs/bootstrap/package.json"));
		$metadata = array(
			"name" => $_POST['name'],
			"location_timezone" => "EST",
			"location_lang" => "en",
			"bootstrap_version" => $bootstrap->version,
			"bootstrap_theme" => "default"
		);
		foreach($metadata as $var => $val) {
			$db->insert("metadata", array("var" => $var, "val" => $val));
		}
		$user = array(
			"username" => $_POST['username'],
			"htpassword" => crypt($_POST['password']),
			"password" => md5($_POST['password']),
			"email" => $_POST['email']
		);
		$db->insert("users", $user);
		$htlines = array();
		$htusers = $db->query("SELECT * FROM `users` ORDER BY `username`");
		while($htuser = $htusers->fetch_assoc()) {
			$htlines[] = $htuser['username'].":".$htuser['htpassword'];
		}
		file_put_contents($_SERVER['DOCUMENT_ROOT']."/admin/.htpasswd",implode("\n",$htlines));
		if (!file_exists($_SERVER['DOCUMENT_ROOT']."/admin/.htaccess")) {
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/admin/.htaccess","AuthUserFile ".$_SERVER['DOCUMENT_ROOT']."/admin/.htpasswd\nAuthType Basic\nAuthName \"Admin\"\n\nrequire valid-user");
		}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"><!-- InstanceBegin template="/Templates/installer-pages.dwt.php" codeOutsideHTMLIsLocked="false" --><!--<![endif]-->
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
  			<li><a href="index.php">Database</a></li>
            <li><a href="index2.php">Site Setup</a></li>
            <li class="active"><span>Finished</span></li>
		</ol>
        
        <h2>Success!</h2>
        <hr>
        <p>CMS Has been installed!</p>
        <p><a href="../admin/index.php" class="btn btn-default">Log In</a></p>
        
        
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