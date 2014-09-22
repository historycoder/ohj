<?php

$dbcon = parse_ini_file('conf/dbcon.ini');
$searchterm = array();
$vol_number = "";
$page_numbers = "";
$pages = array();

if (!empty($_POST['page']) || !empty($_GET['page'])) {
	$current_page = !empty($_POST['page']) ? substr($_POST['page'],0,3) : substr($_GET['page'],0,3);
}
if (!empty($_POST['ipp']) || !empty($_GET['ipp'])) {
	$items_per_page = !empty($_POST['ipp']) ? substr($_POST['ipp'],0,3) : substr($_GET['ipp'],0,3);
}

if (!empty($_POST['pages']) || !empty($_GET['pages'])) {
	
	if (!empty($_POST['vol']) || !empty($_GET['vol'])) {
		$vol_number = !empty($_POST['vol']) ? substr($_POST['vol'],0,3) : substr($_GET['vol'],0,3);
		if (preg_match('/[^\d]/', $vol_number)) { exit; }
	}
	
	$page_numbers = !empty($_POST['pages']) ? substr($_POST['pages'],0,12) : substr($_GET['pages'],0,12);
	if (preg_match('/[^\d-,]/', $page_numbers)) { exit; }
	
	if (preg_match('/,/',$page_numbers)) {
		$pages_plus_notes = explode(",", $page_numbers);
		foreach($pages_plus_notes as $page_set) {
			$page_num = explode("-", $page_set);
			for ($i = $page_num[0]; $i <= $page_num[1]; $i++) {
				array_push($pages, $i);
			}
		}
	} else {
		if (preg_match('/-/',$page_numbers)) {
			$page_set = explode("-", $page_numbers);
			for ($i = $page_set[0]; $i <= $page_set[1]; $i++) {
				array_push($pages, $i);
			}
		} else {
			array_push($pages, $page_numbers);
		}
	}
	//print_r($pages);
	
}
if (!empty($_POST['searchterm']) || !empty($_GET['searchterm'])) {
	$searchterm = !empty($_POST['searchterm']) ? substr($_POST['searchterm'],0,50) : substr($_GET['searchterm'],0,50);
	if (preg_match('/[^a-zA-Z0-9 \']/', $searchterm)) { exit; }
	$searchterms = explode(" ", $searchterm);
}


?>

<!doctype html public 
  "-//w3c//dtd html 4.01 transitional//en"
  "http://www.w3.org/tr/1999/rec-html401-19991224/loose.dtd">
<html>
  <head>
    <title>blank html 4 transitional page</title>
    <meta http-equiv="content-type" 
          content="text/html; charset=utf-8">
  </head>
  <body>
		<div style="width:100%"> 
		<div style="width:40%;margin: 0 auto;">	 	
  	<?php
  		
  		echo( '<br/><a href="results.php?page=' . $current_page . '&ipp=' . $items_per_page . '&searchterm=' . $searchterm . '">Back to results</a><br/>' );
  		
		if (count($pages) > 1) {
			
	    	//for ($i = $pages[0]; $i <= $pages[1]; $i++) {
	    	foreach($pages as $page_no) {
	    		$page_url = str_pad($vol_number, 4, '0', STR_PAD_LEFT) . $page_no . ".html";
				$page_html = file_get_contents($dbcon['html_dir'] . "/" . $page_url);
				$pattern_array = array('/[\xA0]/', '/[\xB0]/');
				$replacements = array('&nbsp;', '&deg;');
				$page_html = preg_replace($pattern_array, $replacements, $page_html);
				foreach ($searchterms as $st) {
					if (preg_match('/'.$st.'/si',$page_html, $matches) < 1) { continue; };
					$page_html = preg_replace('/'.$st.'/si','<span style="color:#cc0000;font-weight:bold">'.$matches[0].'</span>',$page_html);
				}
				echo( '<br/>'.$page_html.'<br/>' );
	    	}
	    	
	    } else {
	    	
	    	$page_url = str_pad($vol_number, 4, '0', STR_PAD_LEFT) . $pages[0] . ".html";
	    	$page_html = file_get_contents($dbcon['html_dir'] . "/" . $page_url);
	    	$page_html = preg_replace('/[\xA0]/','&nbsp;',$page_html);
	    	foreach ($searchterms as $st) {
				if (preg_match('/'.$st.'/si',$page_html, $matches) < 1) { continue; };
				$page_html = preg_replace('/'.$st.'/si','<span style="color:#cc0000;font-weight:bold">'.$matches[0].'</span>',$page_html);
			}
			echo( $page_html );
			
	    }
    
    ?>
  		</div>
    
   	</div>
  </body>
</html>