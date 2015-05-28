<? 
	require_once("admin-config.inc.php");
	
	$enable_captions = false;
	
	$id = intval($_GET['id']);
	
	if ($id > 0) {
		$action = "edit";
		$slide = $db->query("SELECT * FROM `slides` WHERE `id` = $id")->fetch_assoc();
		$is_edit = true;
	} else {
		$action = "add";
		$is_edit = false;
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
    <title><?= ($action == "add" ? "Add slide" : $slide['title']); ?> | Admin</title>
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
        
        <form action="../admin/slide_save.php" method="post" class="form">
        <input type="hidden" name="action" value="<?= $action; ?>">
        <input type="hidden" name="id" value="<?= $id; ?>">
        
        <div class="row">
        	<div class="col-xs-12 col-sm-9">
                <div class="btn-group">
                    <a href="slides.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                    <? if ($is_edit) { ?>
                    <a href="#" id="delete" class="btn btn-danger"><i class="fa fa-times"></i> Delete</a>
                    <? } ?>
                </div>
                
                <div class="form-group">
                    <label for="alt">Title</label>
                    <input type="text" name="alt" id="alt" class="form-control" value='<?= $slide['alt']; ?>'>
                </div>
                
                <div class="form-group">
                  <label for="src" class="col-xs-12 col-sm-2 control-label">Image</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="hidden" name="src" id="src" value="<?= $slide['src']; ?>">
                    <div class="droparea" id="src_drop" rel="src" data-folder="slides"></div>
                    <img src="<?= (!empty($slide['src']) ? $slide['src'] : 'http://placehold.it/200&text=Drop+Slide+Image+Here'); ?>" id="src_preview" style="max-width:300px" class="img-thumbnail">
                  </div>
                </div>
                
 				<? if ($enable_captions) { ?>               
                <div class="form-group">
                	<label for="caption">Caption</label>
                    <textarea name="caption" id="caption" class="form-control"><?= stripslashes($slide['caption']); ?></textarea>
                </div>
                <? } ?>
                
            </div>
            <div class="col-xs-12 col-sm-3">
            	<div class="panel panel-default">
                	<div class="panel-body">
                        <div class="checkbox">
                        	<label>
                            	<input type="checkbox" name="active" id="active" value="1" <?= ($slide['active'] == 1 ? 'checked' : ''); ?>> Active
                            </label>
                        </div>
                        <div class="form-group">
                        	<label for="orientation">Orientation</label>
                            <select name="orientation" id="orientation" class="form-control">
                            	<option value="0" id="portrait" <?= ($slide['orientation'] == 0 ? 'selected' : ''); ?>>Portrait</option>
                                <option value="1" id="landscape" <?= ($slide['orientation'] == 1 ? 'selected' : ''); ?>>Landscape</option>
                            </select>
                        </div>
                        <div class="form-group">
                        	<label for="order">Order</label>
                            <input type="text" name="order" id="order" class="form-control" value="<?= $slide['order']; ?>">
                        </div>
                        <div class="form-group">
                        	<label for="lang">Language</label>
                            <input type="text" name="lang" id="lang" class="form-control" value="<?= $slide['lang']; ?>" placeholder="en" disabled>
                        </div>
                        <p>
                            <strong>Created:</strong><br><?= (!empty($slide['created']) ? $slide['created'] : date("Y-m-d H:i:s")); ?><br>
                            <strong>Modified:</strong><br><?= (!empty($slide['modified']) ? $slide['modified'] : date("Y-m-d H:i:s")); ?>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.12.0/dropzone.min.js"></script>
    <? if ($enable_captions) { ?>
    <script src="ckeditor/ckeditor.js"></script>
    <? } ?>
    <script src="js/main.js"></script>
    <script>
		$(document).ready(function(e) {
			$("#delete").click(function(e) {
				e.preventDefault();
				if ( confirm("Delete this item?") ) {
					window.location = "slide_save.php?action=delete&id=<?= $slide['id']; ?>";
				}
			});
			
			$(".droparea").each(function(index, element) {
				var upload_folder = $(this).data("folder");
				var target_field = $(this).attr("rel");
				/*
				console.log(upload_folder);
				console.log(target_field);
				*/
				$("#" + $(this).attr("id")+","+"#" + target_field + "_preview").dropzone({
					url: "upload.php?folder="+upload_folder,
					uploadMultiple: true,
					dictDefaultMessage: 'Drop here to upload',
					complete: function (file) {
						var filename = '<?= $baseurl; ?>/uploads/'+upload_folder+'/' + file.name;
						filename = filename.replace(' ','-').replace(' ','-').replace(' ','-');
						console.log(filename);
						$("#" + target_field).val(filename);
						$("#" + target_field + "_preview").attr("src",filename);
						if ($("#" + target_field + "_preview").width() > $("#" + target_field + "_preview").height()) {
							$("#orientation").val(1);
							$("#portrait").attr("selected",0);
							$("#landscape").attr("selected",1);
						} else {
							$("#orientation").val(0);
							$("#portrait").attr("selected",1);
							$("#landscape").attr("selected",0);
					    }
						$(".dz-details img").hide();
					}
				});
				
			});
			
			<? if ($enable_captions) { ?>
			editorLite( 'content' );	
			<? } ?>		
		});
	</script>
    
    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>