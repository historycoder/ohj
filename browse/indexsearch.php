<?php require "ohcsite/webbodyheader.php" ?>
<div class="container">
<div class="c2" id="content-primary">
	<div id="heading" class="c2">
		<h1>Ohio History Journal</h1>
	</div><br>
	<div id="maincontent" class="c2">
	<div class="maincontent">
	<B><FONT SIZE=3> Ohio History Index Search</B> </FONT> <br>
	<br><br>
	<P> To search <i>Ohio History</i>&#146;s index, enter a single word or a phrase: 
	<p>

	<form id="idexform" name="indexform" method=GET action="indexsearchresults.php" onsubmit="return validateForm()" style="width: 500px;margin: 0 auto" ><b>Find: </b>
	<input type="text" name="searchtext" size="40">
	<p>Browse by: <input type="radio" name="criteria" value="Author"><b>Author</b>&nbsp;&nbsp;
	<input type="radio" name="criteria" value="Subject"><b>Subject</b>&nbsp;&nbsp;
	<input type="radio" name="criteria" value="Title"><b>Title</b>
	<br>
	<br>
	<input type="submit" value="Search">
	</form>
	</div>
	</div>
	<div id="endmaincontent" class="c2"></div>
</div>
<?php require "ohcsite/sidenav.php" ?>
<?php require "ohcsite/webfooterendbody.php" ?>