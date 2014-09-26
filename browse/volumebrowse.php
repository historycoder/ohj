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
<!--
	OHS Journal index
!-->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
a{
	text-decoration: none;
}
p{
	wordwrap: break-word;
}
#volumes{
	width: 300 px;
}
</style>

<title>Volume</title>
</head>
<body>
Please choose the volume you wish to browse.<br>
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
<hr>
</body>
</html>