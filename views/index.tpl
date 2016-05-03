<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="browse.css">
<title></title>
</head>

<body>

 <div class="dropdown">
  <button onclick="togglePulldown(this)" class="dropbtn">Dropdown</button>

  <div id="userDropdown" class="dropdown-content"></div>
  <div id="myDropdown" class="dropdown-content"></div>

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
			document.getElementById("userDropdown").innerHTML += '<a href="#">' + xhttp.responseText + '</a>';
		}
	};
	xhttp.open("GET", "builder.php?payload=users", true);
	xhttp.send();
}

function togglePulldown() {
    this.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event)
{
	if (!event.target.matches('.dropbtn'))
	{
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) 
		{
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) 
			{
				openDropdown.classList.remove('show');
			}
		}
	}
}

loadUsers();
</script>


</body>
</html>
