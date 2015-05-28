<?

function is_mobile() {
	$devicetypes = array('Android','iOS','Tizen','Blackberry','Sailfish','Mobile','Meego');
	return preg_match('/('.implode('|',$devicetypes).')/i',$_SERVER['HTTP_USER_AGENT']);
}

function htmlmail ($to, $subject, $message, $from = NULL ) {
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "To:  $to\r\n";
	if (!empty($from)) { $headers .= "From: $from\r\n"; }
	return mail($to, $subject, $message, $headers);
}

function fill_template($template_file, $data) {
	$retn = file_get_contents($template_file);
	foreach($data as $var => $val) {
		$retn = str_replace('{'.$var.'}',$var,$retn);
	}
	return $retn;
}

function updatecount($table, $id) {
	global $db;
	$current = $db->query("SELECT `visits` FROM `$table` WHERE `id` = $id")->fetch_assoc();
	$db->update($table, array("visits" => ($current['visits'] + 1)), "`id` = $id");
}

function getpages($parent = -1) {
	global $db;
	$retn = array();
	$pages = $db->query("SELECT * FROM `pages` WHERE `parent` = $parent ORDER BY `order`");
	while($page = $pages->fetch_assoc()) {
		$children = $db->query("SELECT * FRPM `pages` WHERE `parent` = $page[id]");
		if ($children->num_rows > 0) {
			$retn[$page['title']] = getpages($page['id']);
		} else {
			$retn[$page['title']] = $page;
		}
	}
	return $retn;
}

function show_pages_list($parent_id = -1, $dropdown = false, $custom_class = false) {
	global $db;
	$pages = $db->query("SELECT * FROM `pages` WHERE `parent` = $parent_id ORDER BY `order`");
	if ($pages->num_rows > 0) {
		echo "<ul ".($parent_id > 0 && $dropdown ? 'class="dropdown-menu" role="menu"' : (!$custom_class ? '' : 'class="'.$custom_class.'"')).">";
		while($page = $pages->fetch_assoc()) {
			$has_subpages = ($db->query("SELECT * FROM `pages` WHERE `parent` = $page[id]")->num_rows > 0);
			if ($has_subpages) {
				$href = "#";
			} else {
				$href = (empty($page['alt_url']) ? 'index.php?pageid='.$page['id'] : $page['alt_url']);
			}
		?>
		<li <?= ($has_subpages && $dropdown ? 'class="dropdown"' : ''); ?>>
        	<a href="<?= $href; ?>" <?= ($has_subpages && $dropdown ? 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"' : ''); ?>>
				<?= $page['title']; ?>
                <? if ($has_subpages && $dropdown) { ?>
                	<span class="caret"></span>
                <? } ?>
            </a>
			<? show_pages_list($page['id'], $dropdown); ?>
        </li>
		<?
		}
		echo "</ul>";
	}
}

function menuarray($menu, $stdout = true) {
	if (!$stdout) {
		$output = '';
		foreach($menu as $mt => $mh) {
			if (is_array($mh)) {
				$output .= '<ul >';
				$output .= menuitem($mt, $mh, false, menuarray($mh,false));
				$output .= '</ul>';
			} else {
				menuitem($mt, $mh, true);
			}
		}
		return $output;
	} else {
		foreach($menu as $mt => $mh) {
			if (is_array($mh)) {
				echo '<ul >';
				menuitem($mt, $mh, true, menuarray($mh));
				echo '</ul>';
			} else {
				menuitem($mt, $mh, true);
			}
		}
	}
}

function menuitem($title, $href, $stdout = false, $dropdown = false) {
	$thispage = (basename($href) == basename($_SERVER['PHP_SELF']));
	if (!$dropdown) {
		$menuitem = '<li'.($thispage ? ' class="active"' : '').'><a href="'.$href.'">'.$title.'</a></li>';
	} else {
		$menuitem = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="" role="button" aria-expanded="false">'.$title.' <span class="caret"></span></a>'. $dropdown . '</li>';
	}
	if (!$stdout) {
		return $menuitem;
	} else {
		echo $menuitem;
	}
}

function print_r_to_json($input) {
	$line_ex = '/\[(?P<key>.*?)\]\s+?\\=\>\s+?(?P<val>.*?)$/i';
	$lines = explode("\n",$input);
	$output = array();
	foreach($lines as $key => $line) {
		$line = trim(str_replace(array("\n","\r"),'',$line));
		if ($line !== "Array" && $line !== "(" && $line !== ")") {
			preg_match($line_ex,$line,$matches);
			$line = preg_replace($line_ex,'"\\1":"\\2"',$line);
			if (isset($matches['val'])) {
				$key = $matches['key'];
				$output[$key] = $matches['val'];
			}
			if (!empty($line)) {
				$lines[$key] = $line;
			} else {
				unset($lines[$key]);
			}
		} else {
			unset($lines[$key]);
		}
	}
	return json_encode($output);
	// return "{".implode(",",$lines)."}";
}

function recurse_copy($src,$dst) {
  $dir = opendir($src);
  @mkdir($dst);
  while(false !== ( $file = readdir($dir)) ) {
    if (( $file != '.' ) && ( $file != '..' )) {
      if ( is_dir($src . '/' . $file) ) {
        recurse_copy($src . '/' . $file,$dst . '/' . $file);
      } else {
        copy($src . '/' . $file,$dst . '/' . $file);
      }
    }
  }
  closedir($dir);
} 

class CurlClass {
	var $curl_url, $curlerror;

	function xml2json($xml) {
		$xmlobj = simplexml_load_string($xml);
		return json_encode($xmlobj);
	}

	function curl_get($url, array $get = NULL, array $options = array()) {
		$this->curl_url = $url. (strpos($url, '?') === FALSE ? '?' : '') . (is_array($get) ? http_build_query($get) : '');
		$defaults = array(
			CURLOPT_URL => $this->curl_url,
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_TIMEOUT => 4
		);

		$ch = curl_init();
		curl_setopt_array($ch, ($options + $defaults));
		if( ! $result = curl_exec($ch)) {
			$this->curlerror = curl_error($ch);
			trigger_error(curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}

	function curl_post($url, array $post = NULL, array $options = array()) {
		$this->curl_url = $url. (strpos($url, '?') === FALSE ? '?' : ''). (is_array($post) ? http_build_query($post) : '');
		$defaults = array(
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_URL => $url,
			CURLOPT_FRESH_CONNECT => 1,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_FORBID_REUSE => 1,
			CURLOPT_TIMEOUT => 4,
			CURLOPT_POSTFIELDS => http_build_query($post)
		);

		$ch = curl_init();
		curl_setopt_array($ch, ($options + $defaults));
		if( ! $result = curl_exec($ch)) {
			$this->curlerror = curl_error($ch);
			trigger_error(curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}

	function delete($url, array $get = NULL, array $options = array()) {
	  $this->curl_url = $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get);
	  $defaults = array(
		CURLOPT_HEADER => 0,
		CURLOPT_URL => $url,
		CURLOPT_FRESH_CONNECT => 1,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_FORBID_REUSE => 1,
		CURLOPT_TIMEOUT => 4,
		CURLOPT_CUSTOMREQUEST, "DELETE"
	  );
	  $ch = curl_init();
	  curl_setopt_array($ch, ($options + $defaults));
	  if( ! $result = curl_exec($ch)) {
		$this->curlerror = curl_error($ch);
		trigger_error(curl_error($ch));
	  }
	  curl_close($ch);
	  return $result;
	}

	function put($url, array $post = NULL, array $options = array()) {
	  $this->curl_url = $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($post);
	  $defaults = array(
		CURLOPT_HEADER => 0,
		CURLOPT_URL => $url,
		CURLOPT_FRESH_CONNECT => 1,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_FORBID_REUSE => 1,
		CURLOPT_TIMEOUT => 4,
		CURLOPT_CUSTOMREQUEST, "PUT",
		CURLOPT_POSTFIELDS => (is_array($_POST) ? http_build_query($post) : $post)
	  );
	  $ch = curl_init();
	  curl_setopt_array($ch, ($options + $defaults));
	  if( ! $result = curl_exec($ch)) {
		$this->curlerror = curl_error($ch);
		trigger_error(curl_error($ch));
	  }
	  curl_close($ch);
	  return $result;
	}
}

?>