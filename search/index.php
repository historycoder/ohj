<!doctype html public 
  "-//w3c//dtd html 4.01 transitional//en"
  "http://www.w3.org/tr/1999/rec-html401-19991224/loose.dtd">
<html> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  

<title>Ohio History Journal</title>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.2.12/jquery.jgrowl.min.css" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.2.12/jquery.jgrowl.min.js"></script>

<script type="text/javascript" src="../formly/formly.js"></script>
<link rel="stylesheet" href="../formly/formly.css" type="text/css" />

<script type="text/javascript">
	
	$(document).ready(function() {		
		$('#searchform').formly(); 
	});
	
	function validateForm() {
		/*	
		var yearExists = /^\d\d\d\d$/.test(document.forms["newssearch"]["year"].value);
		var titleExists = /[A-Na-n]/.test(document.forms["newssearch"]["title"].value);
		var searchtermExists = /[A-Na-n]/.test(document.forms["searchform"]["searchterm"].value);
		
		if (!yearExists && !titleExists && !authorExists && !subjectExists && !searchTerm) {
			//new Messi('Need something to search', {title: 'Search Error', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});
			$.jGrowl("Need something to search", { theme: 'validation', header: 'Search Error', live: 10000 });
			return false;
		}
		if (!searchtermExists) {
			$('#newsform').formly(); 
		}
		
		*/
		return true;
	}
</script>

<style type="text/css">

body {
	font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	font-size: 12px;
}
.heading {
	text-align:center;
	font-size:120%;padding:20px;
}
.backto {
	text-align:center;
	padding:10px;
}
a.navlinks {
	text-decoration: none;
}
a.navlinks:hover {
	color: red;
	text-decoration: underline;
}
div.jGrowl div.validation {
	background-color: #808080;
	width: 200px;
	min-height: 0px;
	border: 1px solid #000;
}

</style>
</head> 
<body>
		
	<div class="backto"><a class="navlinks" href="http://www.ohiohistory.org/collections--archives/archives-library">Library/Archives Home</a></div>
	<div class="heading"><b><i>Ohio History Journal</i> Search</b></div>
	
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
	
</body>
</html>