<!DOCTYPE html>
<html>
<head>

<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="inc/jquery-2.2.3.min.js"></script>
<script src="inc/dmenu.js"></script>

<link rel="stylesheet" href="css/dmenu.css" />

<title></title>

</head>

<body>

<div id='cssmenu'>
<ul>
   <li class='active'><a href='http://blog.surroindustries.com'><span>SURRO</span></a></li>
   
   <li class='has-sub'><a href='#'><span>Users</span></a>
      <ul id="Users"></ul>
   </li>
   
   <li class='has-sub'><a href='#'><span>Networks</span></a>
      <ul>
         <li><a href='#'><span>Company</span></a></li>
         <li class='last'><a href='#'><span>Contact</span></a></li>
      </ul>
   </li>
   
   <li class='last'><a href='#'><span>Contact</span></a></li>

</ul>
</div>

<script>


function loadUsers() 
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
			document.getElementById("Users").innerHTML += '<li class="last"><a href="#" onclick="getNetworks(' + xhttp.responseText + ')">' + xhttp.responseText + '</a></li>';
		}
	};
	xhttp.open("GET", "builder.php?payload=users", true);
	xhttp.send();
}

function getNetworks( user )
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
			document.getElementById("Networks").innerHTML += '<li class="last"><a href="#" onclick=>' + xhttp.responseText + '</a></li>';
		}
	};
	xhttp.open("GET", "builder.php?payload=networks?user=" + user, true);
	xhttp.send();
}

loadUsers();
</script>


</body>
</html>
