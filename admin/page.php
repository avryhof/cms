<? 
	require_once("admin-config.inc.php");
	
	$id = intval($_GET['id']);
	
	if ($id > 0) {
		$action = "edit";
		$page = $db->query("SELECT * FROM `pages` WHERE `id` = $id")->fetch_assoc();
		$is_edit = true;
	} else {
		$action = "add";
		$is_edit = false;
	}
	
	$parentpages = $db->query("SELECT `id`,`title` FROM `pages` ORDER BY `title`");
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
    <title><?= ($action == "add" ? "Add Page" : $page['title']); ?> | Admin</title>
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
        
        <form action="../admin/page_save.php" method="post" class="form">
        <input type="hidden" name="action" value="<?= $action; ?>">
        <input type="hidden" name="id" value="<?= $id; ?>">
        
        <div class="row">
        	<div class="col-xs-12 col-sm-9">
                <div class="btn-group">
                    <a href="index.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                    <? if ($is_edit) { ?>
                    <a href="<?= $baseurl; ?>/index.php?id=<?= $page['id']; ?>" class="btn btn-default"><i class="fa fa-pencil"></i> Edit Inline</a>
                    <a href="#" id="delete" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
                    <? } ?>
                </div>
                
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value='<?= $page['title']; ?>'>
                </div>
                
                <div class="form-group">
                    <label for="alt_url">Alternate Link</label>
                    <input type="text" name="alt_url" id="alt_url" class="form-control" value="<?= $page['alt_url']; ?>">
                </div>
                
                <div class="form-group">
                	<label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control"><?= stripslashes($page['content']); ?></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3">
            	<div class="panel panel-default">
                	<div class="panel-body">
                        <div class="checkbox">
                        	<label>
                            	<input type="checkbox" name="active" id="active" value="1" <?= ($page['active'] == 1 ? 'checked' : ''); ?>> Active
                            </label>
                        </div>
                        <div class="checkbox">
                        	<label>
                            	<input type="checkbox" name="homepage" id="homepage" value="1" <?= ($page['homepage'] == 1 ? 'checked' : ''); ?>> Homepage
                            </label>
                        </div>
                        <div class="form-group">
                        	<label for="parent">Parent</label>
                            <select name="parent" id="parent" class="form-control">
                            	<option value="-1" <?= ($page['parent'] == -1 ? 'selected' : ''); ?>>No Parent</option>
                                <? while($parentpage = $parentpages->fetch_assoc()) { ?>
                                	<option value="<?= $parentpage['id']; ?>" <?= ($page['parent'] == $parentpage['id'] ? 'selected' : ''); ?>><?= $parentpage['title']; ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="form-group">
                        	<label for="order">Order</label>
                            <input type="text" name="order" id="order" class="form-control" value="<?= $page['order']; ?>">
                        </div>
                        <div class="form-group">
                        	<label for="lang">Language</label>
                            <input type="text" name="lang" id="lang" class="form-control" value="<?= $page['lang']; ?>" placeholder="en" disabled>
                        </div>
                        <p>
                        	<strong>Visits:</strong><br><?= intval($page['visits']); ?><br>
                            <strong>Created:</strong><br><?= (!empty($page['created']) ? $page['created'] : date("Y-m-d H:i:s")); ?><br>
                            <strong>Modified:</strong><br><?= (!empty($page['modified']) ? $page['modified'] : date("Y-m-d H:i:s")); ?>
                        </p>
                    </div>
                </div>
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
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<!-- InstanceBeginEditable name="code" -->
    
    <script src="ckeditor/ckeditor.js"></script>
    <script src="js/main.js"></script>
    <script>
		$(document).ready(function(e) {
			$("#delete").click(function(e) {
				e.preventDefault();
				if ( confirm("Delete this item?") ) {
					window.location = "page_save.php?action=delete&id=<?= $page['id']; ?>";
				}
			});
			editor( 'content' );			
		});
	</script>
    
    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>