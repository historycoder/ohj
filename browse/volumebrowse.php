<?php

// Save in file dbcon.ini:
// [news_connection]
// thishost = "host_name"
// journal_db_title = "database_name"
// journal_db_table = "table_name"
// user = "user"
// pass = "pass"
$dbcon = parse_ini_file('../conf/dbcon.ini');

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
		<p><h2><em><b>Volume Browse</b></em></h2><br></p>
<p>
Please choose the volume you wish to browse.</p>
<div id=volumes>	
<p>
<?php
$statement = "SELECT MAX(Volume) AS volumes FROM " . $dbcon['journal_db_table'];
try{
	$db = new PDO('mysql:host='.$dbcon['thishost'].';dbname='.$dbcon['journal_db_title'].';charset=utf8', $dbcon['user'], $dbcon['pass']);	
	$results = $db->query($statement);
	$db = null;
}
catch(PDOException $e) {  
		print($e->getMessage());
		die();
}
$volmax = $results->fetch(PDO::FETCH_ASSOC);
for($x=1; $x<$volmax['volumes']; $x++){
	echo "<a href=\"volumeresult.php?vol=" . $x . "\">" . $x . "</a> &nbsp";
};
?>
</p>
</div>
<p> <a href="../HTML/issues.html">Appendix A: Issue Dates and Pagination</a><br>
  <a href="../HTML/staff.html">Appendix B: Staff Roster</a><br>
  <a href="../HTML/reviews.html">Appendix C: Book Reviews, Book Notes, 
  Authors, and Reviewers</a> </p>
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
