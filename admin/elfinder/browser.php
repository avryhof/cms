<?
	$field = $_GET['field'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>File Manager</title>
		<link rel="stylesheet" type="text/css" media="screen" href="//code.jquery.com/ui/1.7.2/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/theme.css">
        <style>
			body {
				margin:0;
				padding:0;
				overflow:hidden;
			}
			#elfinder { border: none; }
    		.elfinder-toolbar, .elfinder-statusbar { border-radius: 0 !important; }
			.ui-resizable-handle {
				display:none !important;
			}
		</style>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

    <script src="//code.jquery.com/jquery-1.7.2.min.js"></script>
		<script src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
		<script src="js/elfinder.min.js"></script>
		<script>
			var $window = $(window);
    
			var options = {
				resizable : true,
				url : 'php/connector.php',
				getFileCallback : function(file) {
					// window.opener.CKEDITOR.tools.callFunction(funcNum, file);
					window.opener.document.getElementById('<?= $field; ?>').value = file.url;
					window.close();
				}
			};
			
			var funcNum = getUrlParam('CKEditorFuncNum');
			var $elfinder = $('#elfinder').elfinder(options);
			winSize();
			
			$window.resize(function(){ winSize(); });

			function getUrlParam(paramName) {
				var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
				var match = window.location.search.match(reParam) ;
				return (match && match.length > 1) ? match[1] : '' ;
			} 
						
			function winSize() {
				var win_height = $window.height();
				if( $elfinder.height() != win_height ){
					$elfinder.height(win_height).resize();
				}
			}
		</script>

	</body>
</html>