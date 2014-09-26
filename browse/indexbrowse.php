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
</style>
  
<title>Index</title>
</head>
<body>
Please choose which index you wish to browse.<br>

<p>
<?php
 $alphaList = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$arrlength=count($alphaList);

for($x=0; $x<$arrlength; $x++){
	echo "<a href=\"indexresults.php?letter=" . $alphaList[$x] . "\">" . $alphaList[$x] . "</a>&nbsp";
	};
?>
</p>
<p> <a href="issues.html">Appendix A: Issue Dates and Pagination</a><br>
  <a href="staff.html">Appendix B: Staff Roster</a><br>
  <a href="reviews.html">Appendix C: Book Reviews, Book Notes, 
  Authors, and Reviewers</a> </p>
<hr>
</body>
</html>