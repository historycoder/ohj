<?php

// Save in file dbcon.ini:
// [news_connection]
// thishost = "host_name"
// journal_db_title = "database_name"
// journal_db_table = "table_name"
// user = "user"
// pass = "pass"
$letter = $_GET['letter'];
$dbcon = parse_ini_file('../conf/dbcon.ini');
//variables for paginator
$search_criteria = array();
$nothing_to_search = false;
$max_per_page = 20;
$max_rows = 1000;
$start = 1;
$end = $start + ($max_per_page - 1);
$prev_start = 1;
$next_start = $start + $max_per_page;
$num_rows = array();

require '../paginator.class.php';

//need to omit data from year: 2000, month: summer-autumn only
//original query statement restricted this period because html did not exist (edition was not sent to Prime Recognition for scanning)
$statement = "SELECT * FROM " . $dbcon['journal_db_table'] . " WHERE alpha = '" . $letter . "' AND Year<>2000 ";
$pages = new Paginator;
$count_statement = preg_replace('/\*/','count(*)',$statement);

try{
	$db = new PDO('mysql:host='.$dbcon['thishost'].';dbname='.$dbcon['journal_db_title'].';charset=utf8', $dbcon['user'], $dbcon['pass']);
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$num_rows[0] = $db->query($count_statement)->fetchColumn();
	if ($num_rows[0] < 1) { $no_results = true; }
	$pages->items_total = $num_rows[0];
	$pages->mid_range = 5;
	$pages->paginate();
	$statement .= " ORDER BY Subject, Title, Volume " . $pages->limit;
	
	$db = new PDO('mysql:host='.$dbcon['thishost'].';dbname='.$dbcon['journal_db_title'].';charset=utf8', $dbcon['user'], $dbcon['pass']);	
	$results = $db->query($statement);
	$db = null;
}
catch(PDOException $e) {  
		print($e->getMessage());
		die();
}
?>

<?php
$path= '../';
 require "../ohcsite/webbodyheader.php" ?>
<div class="container">
	<div class="c2" id="content-primary">
	<div id="heading" class="c2">
		<h1>Ohio History Journal</h1>
	</div><br>
	<div id="maincontent" class="c2">
	<div class="maincontent">
		<h2><em><b>Index <?php echo $letter;?> Results</b></em></h2>

<div id="paging-section">
		<?php echo $pages->display_pages(); ?>
</div>
<br/>
<?php
	$subject = null;
	
	echo( '<div style="width:100%" class="container">' );
	echo( '<form id="indexResults" style="margin: 0 auto; width: 500px">' );
	while($row = $results->fetch(PDO::FETCH_ASSOC)) {
		if($row['Subject'] != $subject){
			$subject = $row['Subject'];
			$newstartpage="";
			$endpage="";
			$newvolume="";
			$link="";
			$notecount="";
			$notes="";
			$notestart="";
			$noteend="";
			$newtitle="";
			
			echo "<dl><dt><b>" . $subject . "</b></dt>";
			#see also records page trim
			if(strlen(trim($row['Page'])) AND strpos($row['Page'], '-') != false){
				$pagerange = $row['Page'];
				$newstartpage = substr(($pagerange), 0,strpos($pagerange, "-"));
				$newendpage = substr(($pagerange), (strcspn($pagerange, "-")+1));
				$notes = $pagerange;
				$notecount = strpos($notes, "notes");
				if ($notecount > 0){
					$newendpage = substr(($pagerange), (strcspn($pagerange, "-")+1), (strpos($pagerange, ",")-3));
					$notes = substr($notes, $notecount, strlen(trim($notes)) - ($notecount-1));
					$notestart = substr($notes, 6, (strpos($notes, "-")-6));
					$noteend = substr($notes, (strcspn($notes, "-") + 1));
				}
				else{
					$notes = "";
				}
			}
			else{
				$newstartpage = $row['Page'];
				$newendpage = $row['Page'];
			}
			$newtitle = "Volume " . $row['Volume'] . " Page " . $newstartpage;
			/*The volume number that makes up the html file is always 4 digits long, such as 0004 for volume 4 
			or 0018 for volume 18.  This next line figures out how many leading zeros to tack onto the volume 
			number in order to get the correct html filename based on a 4-digit volume.*/
			/* "insert" inserts characters (in this case, zeros) at the beginning of string #volume#. 
			RepeatString determines how many zeros to insert by taking the desired length of 4 minus the 
			current length */
			if(strlen(trim($row['Volume']))){
				$newvolume = str_pad($row['Volume'], 4, "0",STR_PAD_LEFT);
				$link = $newvolume . $newstartpage . ".html";
			}
			echo "<dd>";
			if(strlen(trim($link)) AND strlen(trim($row['Title']))){
				echo "<a href=\"displaypages.php?display[]=".$newvolume."&display[]=".$newstartpage."&display[]=".$newendpage."\">".$row['Title']."</a>";
			}
			/*else{
				#$newtitle = str_replace("See Also",$row['Title'], "<i><b>See Also</b></i>");
				#echo $newtitle;
				echo "<dd>" . str_replace("See Also",$row['Title'], "<i><b>See Also</b></i>");
			}*/
			if(strlen(trim($row['Author']))){
				echo $row['Author'];
			}
			if(strlen(trim($newstartpage)) OR (strlen(trim($row['StartPage']))) AND strlen(trim($link))){
					echo "<dd><a href=\"displaypages.php?display[]=".$newvolume."&display[]=".$newstartpage."&display[]=".$newendpage."\">";
				}
				if(strlen(trim($newstartpage))){
					echo trim($newstartpage) . "</a>";
				}
				elseif(strlen(trim($row['StartPage']))){
					echo $row['StartPage']. "</a>";
				}
				if(strlen ($newendpage) AND ($newendpage !=$newstartpage)){
					echo " - ". $newendpage. " ";
				}
				if(strlen(trim($notestart))){
				echo " notes <a href=\"displaypages.php?display[]=".$newvolume."&display[]=".$notestart."&display[]=".$noteend."\">" . $notestart . "</a>";
			}
			if (strlen ($noteend) AND ($noteend !=$notestart)){
				echo " - ".$noteend;
			}
			if(strlen(trim($row['Volume']))){
				if(strlen(trim($row['Edition_Number'])) == NULL){
					echo "  Volume ". $row['Volume'] ."/". $row['Month']. " " . $row['Year'];
				}
				else{
					echo "  Volume ". $row['Volume'] ."/". $row['Month']. " " . $row['Year']."/".$row['Edition_Number'];
				}
			}
			
			echo "</dd>";
		}
		else{
			$newstartpage="";
			$endpage="";
			$newvolume="";
			$link="";
			$notecount="";
			$notes="";
			$notestart="";
			$noteend="";
			$newtitle="";
			#see also records page trim
			if(strlen(trim($row['Page'])) AND strpos($row['Page'], '-') != false){
				$pagerange = $row['Page'];
				$newstartpage = substr(($pagerange), 0,strpos($pagerange, "-"));
				$newendpage = substr(($pagerange), (strcspn($pagerange, "-")+1));
				$notes = $pagerange;
				$notecount = strpos($notes, "notes");
				if ($notecount > 0){
					$newendpage = substr(($pagerange), (strcspn($pagerange, "-")+1), (strpos($pagerange, ",")-3));
					$notes = substr($notes, $notecount, strlen(trim($notes)) - ($notecount-1));
					$notestart = substr($notes, 6, (strpos($notes, "-")-6));
					$noteend = substr($notes, (strcspn($notes, "-") + 1));
				}
				else{
					$notes = "";
				}
			}
			else{
				$newstartpage = $row['Page'];
				$newendpage = $row['Page'];
			}
			$newtitle = "Volume " . $row['Volume'] . " Page " . $newstartpage;
			/*The volume number that makes up the html file is always 4 digits long, such as 0004 for volume 4 
			or 0018 for volume 18.  This next line figures out how many leading zeros to tack onto the volume 
			number in order to get the correct html filename based on a 4-digit volume.*/
			/* "insert" inserts characters (in this case, zeros) at the beginning of string #volume#. 
			RepeatString determines how many zeros to insert by taking the desired length of 4 minus the 
			current length */
			if(strlen(trim($row['Volume']))){
				$newvolume = str_pad($row['Volume'], 4, "0",STR_PAD_LEFT);
				$link = $newvolume . $newstartpage . ".html";
			}
			if(strlen(trim($link))){
				echo "<br><dd>";
				if(strlen(trim($row['Title']))){
				echo "<a href=\"displaypages.php?display[]=".$newvolume."&display[]=".$newstartpage."&display[]=".$newendpage."\">".$row['Title']."</a>";
				}				
			}
			else{
				$newtitle = str_replace("See Also",$row['Title'], "<i><b>See Also</b></i>");
				echo "<dd>". $newtitle;
			}
			if(strlen(trim($row['Author']))){
				echo $row['Author'];
			}
			if(strlen(trim($newstartpage)) OR (strlen(trim($row['StartPage']))) AND strlen(trim($link))){
					echo "<dd><a href=\"displaypages.php?display[]=".$newvolume."&display[]=".$newstartpage."&display[]=".$newendpage."\">";
				}
				if(strlen(trim($newstartpage))){
					echo trim($newstartpage) . "</a>";
				}
				elseif(strlen(trim($row['StartPage']))){
					echo $row['StartPage']. "</a>";
				}
				if(strlen ($newendpage) AND ($newendpage !=$newstartpage)){
				echo " - ". $newendpage. " ";
				}	
				if(strlen(trim($notestart))){
					echo " notes <a href=\"displaypages.php?display[]=".$newvolume."&display[]=".$notestart."&display[]=".$noteend."\">" . $notestart . "</a>";
				}
				if (strlen ($noteend) AND ($noteend !=$notestart)){
					echo " - ".$noteend;
				}
			if(strlen(trim($row['Volume']))){
				if(strlen(trim($row['Edition_Number'])) == NULL){
					echo "  Volume ". $row['Volume'] ."/". $row['Month']. " " . $row['Year'];
				}
				else{
					echo "  Volume ". $row['Volume'] ."/". $row['Month']. " " . $row['Year']."/".$row['Edition_Number'];
				}
			}
			
			echo "</dd>";
		}
		echo "</dd>";
	}
	echo( '</form>' );
	echo( '</div>' );
?>
<div id="paging-section">
			
		<?php echo $pages->display_pages(); ?><br/><br/>
		   
</div> 
</div>
	</div>
	<div id="endmaincontent" class="c2">
	</div>
</div>
<?php
$index='../';
$search='../search/';
$browse='';

require "../ohcsite/sidenav.php" ?>
<?php require "../ohcsite/webfooterendbody.php" ?>
