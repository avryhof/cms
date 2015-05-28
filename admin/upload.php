<?
  require_once("../config.inc.php");
	
  if (file_exists("upload.log")) { 
	  unlink("upload.log"); 
  }
  
  $uploadfolder = $basepath . "/uploads" . (!empty($_GET['folder']) ? '/' . $_GET['folder'] : '');
  $uploadurl = $baseurl . "/uploads" . (!empty($_GET['folder']) ? '/' . $_GET['folder'] : '');
  
  file_put_contents("./upload.log", print_r($_FILES,true));
  
  foreach($_FILES['file']['name'] as $filekey => $filename) {
	  $filename = str_replace(array('%20',' '),'-',$filename);
  
	  $uploadfile = $uploadfolder.'/'.$filename;
  
	  $extension = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));
  
	  if (!move_uploaded_file($_FILES['file']['tmp_name'][$filekey],$uploadfile)) {
		  $debug_output = print_r($_POST,true)."\n\n".print_r($_FILES,true)."\n\n$uploadfile";
		  file_put_contents("./upload.log", $debug_output,FILE_APPEND);
		  exit("$filename <em>failed</em>");
	  } else {
	  }
  }
  exit("Files uploaded");
?>