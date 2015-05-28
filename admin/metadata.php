<? 
	require_once("admin-config.inc.php");
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
    <title>Website Metadata | Admin</title>
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
  
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
  	
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
        
        <form class="form-horizontal" action="metadata_save.php" method="post">
        	<div class="btn-group">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            
        	<div class="panel panel-default">
              <div class="panel-heading">Website</div>
              <div class="panel-body">
              
                <div class="form-group">
                  <label for="name" class="col-xs-12 col-sm-2 control-label">Title</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="<?= $metadata['name']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="desc" class="col-xs-12 col-sm-2 control-label">Description</label>
                  <div class="col-xs-12 col-sm-10">
                    <textarea name="desc" id="desc" rows="2" class="form-control"><?= $metadata['desc']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="keywords" class="col-xs-12 col-sm-2 control-label">Keywords</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" name="keywords" id="keywords" value="<?= $metadata['keywords']; ?>" class="form-control tokenfield">
                  </div>
                </div>
                <div class="form-group">
                  <label for="author" class="col-xs-12 col-sm-2 control-label">Author</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="author" id="author" value="<?= $metadata['author']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="contact" class="col-xs-12 col-sm-2 control-label">Contact Form Recipient</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="contact" id="contact" value="<?= $metadata['contact']; ?>">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Geographic Information</div>
              <div class="panel-body">
              	<p class="text-center"><a href="#" id="detect_location" class="btn btn-primary"><i class="fa fa-map-marker"></i> Detect Coordinates</a></p>
                <div class="form-group">
                  <label for="location_country" class="col-xs-12 col-sm-2 control-label">Country</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="location_country" id="location_country" value="<?= $metadata['location']['country']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="location_region" class="col-xs-12 col-sm-2 control-label">Region</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" name="location_region" id="location_region" value="<?= $metadata['location']['region']; ?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label for="location_city" class="col-xs-12 col-sm-2 control-label">City</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" name="location_city" id="location_city" value="<?= $metadata['location']['city']; ?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label for="location_lang" class="col-xs-12 col-sm-2 control-label">Language</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="location_lang" id="location_lang" value="<?= $metadata['location']['lang']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="location_timezone" class="col-xs-12 col-sm-2 control-label">Timezone</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="location_timezone" id="location_timezone" value="<?= $metadata['location']['timezone']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="location_coords_latitude" class="col-xs-12 col-sm-2 control-label">Latitude</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="location_coords_latitude" id="location_coords_latitude" value="<?= $metadata['location']['coords']['latitude']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="location_coords_longitude" class="col-xs-12 col-sm-2 control-label">Longitude</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="location_coords_longitude" id="location_coords_longitude" value="<?= $metadata['location']['coords']['longitude']; ?>">
                  </div>
                </div>
              </div>
            </div>
			
            <div class="panel panel-default">
              <div class="panel-heading">Images</div>
              <div class="panel-body">
              	<div class="form-group">
                  <label for="images_logo" class="col-xs-12 col-sm-2 control-label">Logo</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="hidden" name="images_logo" id="images_logo" value="<?= $metadata['images']['logo']; ?>">
                    <div class="droparea" id="images_logo_drop" rel="images_logo" data-folder="meta-images"></div>
                    <img src="<?= (!empty($metadata['images']['logo']) ? $metadata['images']['logo'] : 'http://placehold.it/150&text=Drop+Logo+Here'); ?>" id="images_logo_preview" class="img-thumbnail">
                  </div>
                </div>
                <div class="form-group">
                  <label for="images_favicon" class="col-xs-12 col-sm-2 control-label">Favorites Icon</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="hidden" name="images_favicon" id="images_favicon" value="<?= $metadata['images']['favicon']; ?>">
                    <div class="droparea" id="images_favicon_drop" rel="images_favicon" data-folder="meta-images"></div>
                    <img src="<?= (!empty($metadata['images']['favicon']) ? $metadata['images']['favicon'] : 'http://placehold.it/32'); ?>" id="images_favicon_preview" class="img-thumbnail">
                    <p class="help-block">Drag new images into the spots above to upload them.</p>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Facebook</div>
              <div class="panel-body">
              
                <div class="form-group">
                  <label for="facebook_username" class="col-xs-12 col-sm-2 control-label">Username</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="facebook_username" id="facebook_username" value="<?= $metadata['facebook']['username']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="facebook_userid" class="col-xs-12 col-sm-2 control-label">User ID</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" name="facebook_userid" id="facebook_userid" value="<?= $metadata['facebook']['userid']; ?>" class="form-control">
                    <p class="help-block"><a href="http://findmyfacebookid.com/" target="_blank">Click Here</a> and enter http://facebook.com/<span id="facebookname"></span></p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="facebook_pagename" class="col-xs-12 col-sm-2 control-label">Page Name</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" name="facebook_pagename" id="facebook_pagename" value="<?= $metadata['facebook']['pagename']; ?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label for="facebook_pageid" class="col-xs-12 col-sm-2 control-label">Page ID</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="facebook_pageid" id="facebook_pageid" value="<?= $metadata['facebook']['pageid']; ?>">
                    <p class="help-block"><a href="https://www.facebook.com/" id="pagelink" target="_blank">Click Here</a>, and scroll down to see your Facebook Page ID</p>                   
                  </div>
                </div>
                <div class="form-group">
                  <label for="facebook_appid" class="col-xs-12 col-sm-2 control-label">App ID</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="facebook_appid" id="facebook_appid" value="<?= $metadata['facebook']['appid']; ?>">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Twitter</div>
              <div class="panel-body">
              	<div class="form-group">
                  <label for="twitter_username" class="col-xs-12 col-sm-2 control-label">Username</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="twitter_username" id="twitter_username" value="<?= $metadata['twitter']['username']; ?>">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Google</div>
              <div class="panel-body">
              	<div class="form-group">
                  <label for="google_ua" class="col-xs-12 col-sm-2 control-label">Google Analytics UA</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="google_ua" id="google_ua" value="<?= $metadata['google']['ua']; ?>" placeholder="UA-XXXXX-X">
                  </div>
                </div>
                <div class="form-group">
                  <label for="google_publisher" class="col-xs-12 col-sm-2 control-label">Google+ Publisher Page</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="google_publisher" id="google_publisher" value="<?= $metadata['google']['publisher']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="google_author" class="col-xs-12 col-sm-2 control-label">Google+ Author Profile</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="google_author" id="google_author" value="<?= $metadata['google']['author']; ?>">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Other Social Media</div>
              <div class="panel-body">
              	<div class="form-group">
                  <label for="youtube" class="col-xs-12 col-sm-2 control-label">YouTUBE Channel</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="youtube" id="youtube" value="<?= $metadata['youtube']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="instagram" class="col-xs-12 col-sm-2 control-label">Instagram</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="instagram" id="instagram" value="<?= $metadata['instagram']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="flickr" class="col-xs-12 col-sm-2 control-label">Flickr</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="flickr" id="flickr" value="<?= $metadata['flickr']; ?>">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">Bootstrap Settings</div>
              <div class="panel-body">
              	<div class="form-group">
                  <label for="bootstrap_version" class="col-xs-12 col-sm-2 control-label">Bootstrap Version</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="bootstrap_version" id="bootstrap_version" value="<?= $metadata['bootstrap']['version']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="bootstrap_theme" class="col-xs-12 col-sm-2 control-label">Theme</label>
                  <div class="col-xs-12 col-sm-10">
                    <input type="text" class="form-control" name="bootstrap_theme" id="bootstrap_theme" value="<?= $metadata['bootstrap']['theme']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="theme_pick" class="col-xs-12 col-sm-2 control-label">Bootstrap Themes</label>
                  <div class="col-xs-12 col-sm-10">
                    <select name="theme_pick" id="theme_pick" class="form-control">
                    	<option value="default" <?= ($metadata['bootstrap']['theme'] == "default" ? 'selected' : ''); ?>>Default</option>
                        <?
							$bootswatches = json_decode(file_get_contents("http://api.bootswatch.com/"));
							foreach($bootswatches->themes as $bootswatch) {
								$swatch = strtolower($bootswatch->name);
						?>
                        	<option value="<?= $swatch; ?>" <?= ($metadata['bootstrap']['theme'] == $swatch ? 'selected' : ''); ?>><?= $bootswatch->name; ?></option>
                        <?
							}
						?>
                    </select>
                    <p class="help-block"><img src="http://bootswatch.com/2/<?= $metadata['bootstrap']['theme']; ?>/thumbnail.png" id="swatch-preview" style="width:350px;height:auto;<?= ($metadata['bootstrap']['theme'] == "default" || $metadata['bootstrap']['theme'] == "" ? 'display:none;' : ''); ?>"></p>
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
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.12.0/dropzone.min.js"></script>
    <script>
	$(document).ready(function(e) {

		$("#detect_location").click(function(e) {
			e.preventDefault();
			if (navigator.geolocation) {
        		navigator.geolocation.getCurrentPosition(function (pos) {
					document.getElementById("location_coords_latitude").value = pos.coords.latitude;
					document.getElementById("location_coords_longitude").value = pos.coords.longitude;
					$.getJSON("http://api.geonames.org/findNearbyPostalCodesJSON", {
						lat: pos.coords.latitude,
						lng: pos.coords.longitude,
						maxRows: 1,
						username: 'dairybusiness'
					}, function( place ) {
						$("#location_country").val(place.postalCodes[0].countryCode.toLowerCase());
						$("#location_region").val(place.postalCodes[0].adminCode1);
						$("#location_city").val(place.postalCodes[0].placeName);
					});
					$.getJSON("http://api.geonames.org/timezoneJSON", {
						lat: pos.coords.latitude,
						lng: pos.coords.longitude,
						username: 'dairybusiness'
					}, function( place ) {
						$("#location_timezone").val(place.timezoneId);
					});
				});
    		} else {
        		console.log("Geolocation is not supported by this browser.");
    		}			
		});
			
		$('.tokenfield').tokenfield();
		
		$("#facebook_username").keyup(function(e) { $("#facebookname").html($(this).val()); });
		$("#facebook_username").change(function(e) { $("#facebookname").html($(this).val()); });
		$("#facebook_pagename").keyup(function(e) { $("#pagelink").attr("href",'https://www.facebook.com/'+$(this).val()+'/info?tab=page_info'); });
		$("#facebook_pagename").change(function(e) { $("#pagelink").attr("href",'https://www.facebook.com/'+$(this).val()+'/info?tab=page_info'); });
		
		$(".droparea").each(function(index, element) {
			var upload_folder = $(this).data("folder");
			var target_field = $(this).attr("rel");
			
			console.log(upload_folder);
			console.log(target_field);
			
			$("#" + $(this).attr("id")+","+"#" + target_field + "_preview").dropzone({
				url: "upload.php?folder="+upload_folder,
				uploadMultiple: true,
				dictDefaultMessage: 'Drop here to upload',
				complete: function (file) {
					var filename = '<?= $baseurl; ?>/uploads/'+upload_folder+'/' + file.name;
					filename = filename.replace(' ','-');
					console.log(filename);
					$("#" + target_field).val(filename);
					$("#" + target_field + "_preview").attr("src",filename);
					$(".dz-details img").hide();
				}
			});
		});
			
		$("#theme_pick option").click(function(e) {
			var newtheme = $(this).val();
			$("#bootstrap_theme").val(newtheme);
			if (newtheme == "default") {
				$("#swatch-preview").hide();
			} else {
				$("#swatch-preview").show();
				$("#swatch-preview").attr("src",'http://bootswatch.com/2/'+$(this).val()+'/thumbnail.png');
			}
		});
    });
	</script>
    
    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>