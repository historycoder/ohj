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
	<div style="width:100%">
	
	<div style="width:38%;margin: 0 auto;">
	
	<form id="searchform" name="searchform" action="results.php" method="POST" onsubmit="return validateForm()"  style="width: 500px;margin: 0 auto">
	
		<br/>Full Text Search: <input type="text" name="searchterm" size="25" maxsize="50">
		<!--<br/>Title:  <input type="text" name="title" size="25" maxsize="50">
		<br/>Author:  <input type="text" name="author" size="25" maxsize="50">
		<br/>Subject:  <input type="text" name="subject" size="25" maxsize="50">
		<br/>Year: <input type="text" name="year" size="4" maxsize="4"> -->
		<br/><input type="submit" value="Search" />
		
	</form>
	<br/>
	<p><b>The <i>Ohio History Journal</i> Search provides a means to search the full text of the Ohio History Journal from 1887 through 2004</b>.</p>
	
	</div>
	</div>
	</div>
	</div>
	<div id="endmaincontent" class="c2"></div>
</div>
<?php 
$index='../';
$search='';
$browse='../browse/';

require "../ohcsite/sidenav.php" ?>
<?php require "../ohcsite/webfooterendbody.php" ?>
