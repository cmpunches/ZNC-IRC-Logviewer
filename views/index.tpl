<!DOCTYPE html>
<html>
<head>
<script src="inc/jquery-2.2.3.min.js"></script>
<link rel="stylesheet" type="text/css" type="text/css" href="css/browse.css" />
<link rel="stylesheet" href="css/dropit.css" />
<link rel="stylesheet" href="css/dmenu.css" />
<title></title>
</head>

<body>

<ul class="menu">
    <li>
        <a href="#">Dropdown</a>
        <ul>
            <li><a href="#">Some Action 1</a></li>
            <li><a href="#">Some Action 2</a></li>
            <li><a href="#">Some Action 3</a></li>
            <li><a href="#">Some Action 4</a></li>
        </ul>
    </li>
</ul>






<script>

$(document).ready(function() {
    $('.menu').dropit();
});


//function loadUsers() 
//{
	//var xhttp;
	
	//if (window.XMLHttpRequest) {
		//xhttp = new XMLHttpRequest();
	//} else {
		//// code for IE6, IE5
		//xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	//}
	
	//xhttp.onreadystatechange = function() 
	//{
		//if (xhttp.readyState == 4 && xhttp.status == 200) 
		//{
			//document.getElementById(".menu").innerHTML += '<li><a href="#">' + xhttp.responseText + '</a></li>';
		//}
	//};
	//xhttp.open("GET", "builder.php?payload=users", true);
	//xhttp.send();
}

//function togglePulldown(self) {
    //this.toggle("show");
//}

//// Close the dropdown menu if the user clicks outside of it
//window.onclick = function(event)
//{
	//if (!event.target.matches('.dropbtn'))
	//{
		//var dropdowns = document.getElementsByClassName("dropdown-content");
		//var i;
		//for (i = 0; i < dropdowns.length; i++) 
		//{
			//var openDropdown = dropdowns[i];
			//if (openDropdown.classList.contains('show')) 
			//{
				//openDropdown.classList.remove('show');
			//}
		//}
	//}
//}

//loadUsers();
</script>


</body>
</html>
