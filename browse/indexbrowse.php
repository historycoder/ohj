
<?php 
$path= '../';
require "../ohcsite/webbodyheader.php" ?>
<div class="container">
	<div class="c2" id="content-primary">
	<div id="heading" class="c2">
		<h1>Ohio History Journal</h1>
	</div>
	<div id="maincontent" class="c2">
	<div class="maincontent">
		<h2><em><b>Index Browse</b></em></h2>
		<p>
			Please choose which index you wish to browse.<br>
		</p>

		<p>
		<?php
		 $alphaList = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		$arrlength=count($alphaList);

		for($x=0; $x<$arrlength; $x++){
			echo "<a href=\"indexresults.php?letter=" . $alphaList[$x] . "\">" . $alphaList[$x] . "</a>&nbsp";
			};
		?>
		</p>
		<p> 
			<a href="../HTML/issues.html">Appendix A: Issue Dates and Pagination</a><br>
			<a href="../HTML/staff.html">Appendix B: Staff Roster</a><br>
			<a href="../HTML/reviews.html">Appendix C: Book Reviews, Book Notes, 
		  Authors, and Reviewers</a>
		</p>
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