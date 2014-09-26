<?php


#break apart display array
$vol=$_GET['display'][0];
$startpage=$_GET['display'][1];
$endpage=$_GET['display'][2];
#echo $vol.$startpage.$endpage; #- for testing purposes with notes hyperlink 9/19/14

//variables for paginator
$start = 1;
$end = $start + ($endpage-$startpage);
$next = 1;
$newstartpage = $startpage;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<title>Display Pages</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
<style>
a{
	text-decoration: none;
}
.page{
display: none;
}
li{
display: inline;
}
#pagedisplay{
display: block;
}
</style>
</head>
<body>
<?php
/*if($startpage != $endpage){
	#echo "<ul class=\"pagination\">";
	#echo "<li class=\"arrow unavailable\"><a href=\"javascript:prevpage(".$x.")\">&laquo;</a></li> &nbsp";
	for($x=1; $x<=$end; $x++){
		$page = $vol.$newstartpage.".html";
		echo "<div class=\"page\" id= \"page".$x."\">";
		echo "<p>";
		include($page);
		echo "</p>";
		echo"</div>";
		$displayrange[] = $x;
		$newstartpage++;
	}
	$link = "javascript:divdisplay(page";
	/*pagination($end, 1, 1, $link);
	
	#from css-tricks.com/snippets/php/pagination-function
	function pagination($item_count, $limit, $cur_page, $link){
		$page_count = ceil($item_count/$limit);
		$current_range = array(($cur_page-2 < 1 ? 1 : $cur_page-2), ($cur_page+2 > $page_count ? $page_count : $cur_page+2));
		//First & Last Pages
		$first_page = $cur_page > 3 ? '<a href="' .sprintf($link.$start.')', '1').'">1</a>'.($cur_page < 5 ? ', ' : ' ... ') : null;
		$last_page = $cur_page < $page_count-2 ? ($cur_page > $page_count-4 ? ', ' : ' ... ').'<a href"'.sprintf($link.$end.')', $page_count).'">'.$page_count.'</a>' : null;
		
		//Previous & next page
		$previous_page = $cur_page > 1 ? '<a href="'.sprintf(($link.($cur_page-1).')'), ($cur_page-1)).'">Previous</a> | ' : null;
		$next_page = $cur_page < $page_count ? ' | <a href="'.sprintf($link.($cur_page-1).')', ($cur_page+1)).'">Next</a>' : null;
		
		//Display pages that are in range
		for($x=$current_range[0]; $x <= $current_range[1]; ++$x)
			$pages[] = '<a href"'.sprintf($link.$x.')', $x).'">'.($x == $cur_page ? '<strong>'. $x . '</strong>' : $x).'</a>';
		
		if($page_count > 1)
			return '<p class="pagination"><strong>Pages:</strong> '.$previous_page.$first_page.implode(',',$pages).$last_page.$next_page.'</p>';
	}
}*/
echo '<a href="indexbrowse.php">Back to Browse</a> &nbsp; <a href="../search/index.php">Back to Full Text Search</a> &nbsp; <a href="../index.php">Ohio History Journal Home</a>';
echo "</ul>";
if($startpage != $endpage){
	echo "<ul class=\"pagination\">";
	#echo "<li class=\"arrow unavailable\"><a href=\"javascript:prevpage(".$x.")\">&laquo;</a></li> &nbsp";
	for($x=1; $x<=$end; $x++){
		$page = "../HTML/".$vol.$newstartpage.".html";
		echo "<div class=\"page\" id= \"page".$x."\">";
		echo "<p>";
		include($page);
		echo "</p>";
		echo"</div>";
		echo "<li class=\"current\"><a href=\"javascript:divdisplay(page".$x.")\">".$x."</a></li> &nbsp";
		$newstartpage++;
	}
	echo "</ul>";	
}

echo "<ul class=\"pagination\">";

?>
<script>
	function divdisplay(htmlpage){
		document.getElementById("pagedisplay").innerHTML = htmlpage.innerHTML;
	}
	function prevpage(x){
		var number = x-1;
		var page = "page" + number;
		divdisplay(page);
	}
</script>
<br/>
<div id="pagedisplay">
<?php
	$page = "../HTML/".$vol.$startpage.".html";
	include($page);
?>
</div>
</body>
</html>