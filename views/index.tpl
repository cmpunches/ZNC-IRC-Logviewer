<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

<div id="demo"></div>

<button type="button" onclick="loadDoc()">Get Users</button>

<script>

function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "builder.php?payload=users", true);
  xhttp.send();
} 
</script>


</body>
</html>
