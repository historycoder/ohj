<!--
	OHS Journal index search
!-->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
<title>Index Search</title>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.2.12/jquery.jgrowl.min.css" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.2.12/jquery.jgrowl.min.js"></script>

<script type="text/javascript" src="formly/formly.js"></script>
<link rel="stylesheet" href="formly/formly.css" type="text/css" />

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
<style>
div.jGrowl div.validation {
	background-color: #808080;
	width: 200px;
	min-height: 0px;
	border: 1px solid #000;
}
</style>
</head>
<body>
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
</body>
</html>