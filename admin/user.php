<? 
	require_once("admin-config.inc.php");
	
	$user = $_GET['username'];
	
	if (!empty($user)) {
		$action = "edit";
		$user = $db->query("SELECT * FROM `users` WHERE `username` = '$user'")->fetch_assoc();
	} else {
		$action = "add";
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"><!-- InstanceBegin template="/Templates/admin-pages.dwt.php" codeOutsideHTMLIsLocked="false" --><!--<![endif]-->
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Admin</title>
    <!-- InstanceEndEditable -->
    <? if ($local) { ?>
    	<!-- Latest compiled and minified Bootstrap core CSS -->
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendor/jasny/bootstrap/dist/css/jasny-bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css">        
    <? } else { ?>
		<!-- Latest compiled and minified Bootstrap core CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/<?= $bootstrap['version']; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
        <!-- Optional theme -->
        <? if ($bootstrap['theme'] == "default") { ?>
        	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/<?= $bootstrap['version']; ?>/css/bootstrap-theme.min.css">
        <? } else { ?>
        	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/<?= $bootstrap['version']; ?>/<?= $bootstrap['theme']; ?>/bootstrap.min.css">
        <? } ?>
    <? } ?>
    
    <!-- Optional theme -->
    <? if ($bootstrap['theme'] == "default") { ?>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/<?= $bootstrap['version']; ?>/css/bootstrap-theme.min.css">
    <? } else { ?>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/<?= $bootstrap['version']; ?>/<?= $bootstrap['theme']; ?>/bootstrap.min.css">
    <? } ?>
    
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <![endif]-->
  <!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

  <body>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Website Admin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../<?= $admin_folder; ?>/user.php?username=<?= $_SERVER['PHP_AUTH_USER']; ?>"><i class="fa fa-user"></i> <?= $_SERVER['PHP_AUTH_USER']; ?></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
          	<li><a href="../index.php">Live Edit Pages</a></li>
            <li <?= ($pagename == "index.php" ? 'class="active"' : ''); ?>><a href="../<?= $admin_folder; ?>/index.php">Pages</a></li>
            <? 
				foreach($admin_modules as $admin_module) {
					if (in_array($admin_module,$modules)) { 
			?>
            	<li <?= ($pagename == $admin_module.".php" ? 'class="active"' : ''); ?>><a href="../<?= $admin_folder; ?>/<?= $admin_module; ?>.php"><?= ucwords($admin_module); ?></a></li>
            <? 		
					}
				}
			?>
            <li class="nav-divider"></li>
            <li <?= ($pagename == "users.php" ? 'class="active"' : ''); ?>><a href="../<?= $admin_folder; ?>/users.php">Users</a></li>
            <? if (file_exists("../admin/database-browser.php") && $_SERVER['PHP_AUTH_USER'] == $admin_user) { ?>
            	<li><a href="../<?= $admin_folder; ?>/database-browser.php" target="_blank"><i class="fa fa-database"></i> Database</a></li>
            <? } ?>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-10 main">
        <!-- InstanceBeginEditable name="content" -->
        
        <div class="row">
        	<div class="col-xs-12 col-sm-12">
            <form class="form" action="../admin/user_save.php" method="post">
            	<input type="hidden" name="action" value="<?= $action; ?>">
                <div class="btn-group">
                	<a href="../admin/users.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                    <? if ($is_edit) { ?>
                    <a href="#" id="delete" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
                    <? } ?>
        		</div>
                <div class="form-group">
                	<label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?= $user['name']; ?>" class="form-control">
                </div>
            	<div class="form-group">
                	<label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= $user['username']; ?>" class="form-control">
                </div>
                <div class="form-group">
                	<label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= $user['email']; ?>" class="form-control">
                </div>
                <div class="form-group">
                	<label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control">
                    <span class="help-block">Only enter if you are changing the password.</span>
                </div>
            </form>
            </div>
        </div>
        
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
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<!-- InstanceBeginEditable name="code" -->
    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>