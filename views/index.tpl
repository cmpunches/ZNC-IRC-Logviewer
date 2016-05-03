<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

<div id="demo"></div>

<script>

function loadDoc() 
{
	var xhttp;
	
	if (window.XMLHttpRequest) {
		xhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xhttp.onreadystatechange = function() 
	{
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
			document.getElementById("demo").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "builder.php?payload=users", true);
	xhttp.send();
} 
loadDoc();
</script>


</body>
</html>
