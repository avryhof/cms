<? 
	require_once("admin-config.inc.php");
	
	$page = intval($_GET['page']);
	$widget = json_decode(file_get_contents($basepath."/widgets/".$_GET['widget'].".json"));
	
	$template = $widget->template;
	
	$field_exp = '/\{(.*?)\}/is';
	preg_match_all($field_exp, $template, $fields);
?>
<!DOCTYPE html>
<html lang="en" class="no-js"><!-- InstanceBegin template="/Templates/admin-dialogs.dwt.php" codeOutsideHTMLIsLocked="false" --><!--<![endif]-->
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
        <!-- InstanceBeginEditable name="content" -->
        
        <form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <?
			$globalfields = array(
				"baseurl" => $baseurl,
				"admin_folder" => "$baseurl/$admin_folder"
			);
			foreach($fields[1] as $field) {
				if (strpos($field,":")) {
					list($fieldtype,$fieldname)= explode(":",$field);
					$fieldval = '';
				} else {
					$fieldtype = "hidden";
					$fieldname = $field;
					$fieldval = $globalfields[$field];
				}
		?>
        <? if ($fieldtype !== "hidden") { ?>
        <div class="form-group">
        	<label for="<?= $fieldname; ?>" class="col-xs-12 col-sm-2 control-label"><?= ucwords(implode(" ",explode("_",$fieldname))); ?></label>
            <div class="col-xs-12 col-sm-10">
        <? } ?>
        		<input type="<?= $fieldtype; ?>" name="<?= $fieldname; ?>" id="<?= $fieldname; ?>" value="<?= $fieldval; ?>" class="myfield <?= ($fieldtype !== "hidden" ? 'form-control' : ''); ?>">
        <? if ($fieldtype !== "hidden") { ?>
            </div>
        </div>
        <? } ?>
        <?
			}
		?>
        <div class="form-group text-center">
        	<a href="#" id="use_button" class="btn btn-primary">Insert Widget</a>
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
    
    <script>
	$(document).ready(function(e) {
		var template = '<?= $template; ?>';
		
		$("#use_button").click(function(e) {
			$(".myfield").each(function(index, element) {
				template = replace_var($(this).attr("type"), $(this).attr("id"), $(this).val(), template);
			});
			window.opener.CKEDITOR.instances.page_<?= $page; ?>_content.insertHtml( template );
			window.close();
        });
    });
	
	function replace_var(fieldType, field, fieldval, template) {
		return template.replace('{' + (fieldType !== "hidden" ? fieldType + ':' : '') + field + '}', fieldval);
	}
	</script>
    
    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>