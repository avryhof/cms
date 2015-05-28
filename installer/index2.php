<? 
	require_once($_SERVER['DOCUMENT_ROOT']."/installer/installer-config.inc.php");
	
	/* Setup Database Parameters. */
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$ini_lines = array();
		foreach(array("db_host","db_user","db_pass","db_name") as $var) {
			if ($var == "db_host" && empty($_POST['db_host'])) {
				$ini_lines[] = "$var = localhost";
			} else {
				$ini_lines[] = "$var = ".$_POST[$var];
			}
		}
		file_put_contents($configfile,implode("\n",$ini_lines));
	}
	
	if (file_exists($configfile)) {
		$config = parse_ini_file($configfile);
		
		define('DB_HOST', $config['db_host']);
		define('DB_USER', $config['db_user']);
		define('DB_PASS', $config['db_pass']);
		define('DB_NAME', $config['db_name']);

		$db = new Database("mysqli://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_NAME);
	}
	
	/* Import required database tables. */
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		foreach(array("pages","metadata","users") as $import_table) {
			$query = stripslashes(file_get_contents("db/".$import_table.".sql"));
			if (!empty($query)) {
				$db->query($query);
				if ($db->errno > 0) {
					$is_error = true;
					echo "<pre>ERROR: " . $db->error . "\n\nQUERY:\n\n" . $db->last_query . "\n\nSQL:\n\n" . $sql . "</pre>";
				}
			}
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
            <li class="active"><span>Site Setup</span></li>
		</ol>
        
        <h2>Welcome</h2>
        <hr>
        <p>Welcome to the CMS installation process! Just fill in the information below and you'll be on your way to using a powerful personal Website Management System.</p>
        <h2>Information Needed</h2>
        <hr>
        <p>Please provide the following information. Don't worry, you can always change these settings later.</p>
        
        <form class="form-horizontal" action="index3.php" method="post">
        	<div class="form-group">
            	<label for="name" class="col-xs-12 col-sm-2 control-label">Site Title</label>
                <div class="col-xs-12 col-sm-10">
                	<input type="text" class="form-control" name="name" id="name" value="<?= $metadata['name']; ?>">
                </div>
            </div>
        	
            <div class="form-group">
            	<label for="username" class="col-xs-12 col-sm-2 control-label">Username</label>
                <div class="col-xs-12 col-sm-10">
                	<input type="text" class="form-control" name="username" id="username">
                    <p class="help-block">Usernames can have only alphanumeric characters, spaces, underscores, hyphens, periods and the @ symbol.</p>
                </div>
            </div>
            
            <div class="form-group">
            	<label for="password" class="col-xs-12 col-sm-2 control-label">Password</label>
                <div class="col-xs-12 col-sm-10">
                	<input type="text" class="form-control" name="password" id="password">
                    <p class="help-block">Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, nubbers and symbols like ! &quot; ? $ % ^ &amp; ).</p>
                </div>
            </div>
            
            <div class="form-group">
            	<label for="email" class="col-xs-12 col-sm-2 control-label">Your Email</label>
                <div class="col-xs-12 col-sm-10">
                	<input type="email" class="form-control" name="email" id="email">
                    <p class="help-block">Double-check your email address before continuing.</p>
                </div>
            </div>
            
            <div class="form-group">
            	<label for="next" class="col-xs-12 col-sm-2 control-label">&nbsp;</label>
                <div class="col-xs-12 col-sm-10">
                	<button type="submit" name="next" id="next" class="btn btn-default">Install CMS &raquo;</button>
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