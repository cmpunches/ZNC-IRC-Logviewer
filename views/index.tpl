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
   
	<li class='has-sub'><a href='#'><span id="SelectedUser">Select User</span></a>
	<ul id="Users"></ul>
	</li>
   
	<li class='has-sub'><a href='#'><span id="SelectedNetwork">Select Network</span></a>
	<ul id = "Networks"></ul>
	</li>

	<li class='has-sub'><a href='#'><span id="SelectedChannel">Select Channel</span></a>
	<ul id = "Channels"></ul>
	</li>
	
	<li class='last has-sub'><a href='#'><span id="SelectedDate">Select Date</span></a>
	<ul id = "Dates"></ul>
	</li>
</ul>
</div>
<H1 id="DumpAreaTitle">ZNC IRC Log Viewer</H1>
<div id= "Content"></div>
<script>
var firstrun = true;

function loadUsers( firstrun ) 
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
			vals = csv2arr( xhttp.responseText );

			document.getElementById("Users").innerHTML = '';
			document.getElementById("Users").innerHTML += '<li class="last"><a href="#" onclick="getNetworks()">' + xhttp.responseText + '</a></li>';
			if ( firstrun == false)
			{
				document.getElementById("SelectedUser").innerHTML = xhttp.responseText;
				firstrun = false;
			}
		}
	};
	xhttp.open("GET", "builder.php?payload=users", true);
	xhttp.send();
}

function getNetworks()
{
	var xhttp;
	var user = document.getElementById("SelectedUser").innerHTML;
	
	if (window.XMLHttpRequest) 
	{
		xhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xhttp.onreadystatechange = function() 
	{
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
			var vals = csv2arr( xhttp.responseText );
			var len = vals.length;
			var i, s;

			document.getElementById("Networks").innerHTML = '';

			for ( i = 0; i < len; i++ )
			{
				if ( i in vals )
				{
					s = vals[i];
					if ( i == len - 1 )
					{
						document.getElementById("Networks").innerHTML += '<li class="last"><a href="#" onclick="getChannels(\'' + s + '\')">' + s + '</a></li>';
					} else {
						document.getElementById("Networks").innerHTML += '<li><a href="#" onclick="getChannels(\'' + s + '\')">' + s + '</a></li>';
					}
				}
			}
		}
	};
	xhttp.open("GET", "builder.php?payload=networks&user=" + user, true);
	xhttp.send();
}


function getChannels( network )
{
	var xhttp;
	document.getElementById("SelectedNetwork").innerHTML = network;
	var user = document.getElementById("SelectedUser").innerHTML;
	
	
	
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
			var vals = csv2arr( xhttp.responseText );
			var len = vals.length;
			var i, s;

			document.getElementById("Channels").innerHTML = '';

			for ( i = 0; i < len; i++ )
			{
				if ( i in vals )
				{
					s = vals[i];
					if ( i == len - 1 )
					{
						document.getElementById("Channels").innerHTML += '<li class="last"><a href="#" onclick="getDates(\'' + encodeURIComponent(s) + '\')">' + s + '</a></li>';
					} else {
						document.getElementById("Channels").innerHTML += '<li><a href="#" onclick="getDates(\'' + encodeURIComponent(s) + '\')">' + s + '</a></li>';
					}
				}
			}
		}
	};
	xhttp.open("GET", "builder.php?payload=channels&user=" + user + "&network=" + network, true);
	xhttp.send();
}


function getDates( channel )
{
	var xhttp;
	document.getElementById("SelectedChannel").innerHTML = decodeURIComponent(channel);
	var user = document.getElementById("SelectedUser").innerHTML;
	var network = document.getElementById("SelectedNetwork").innerHTML;
	
	if (window.XMLHttpRequest) 
	{
		xhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xhttp.onreadystatechange = function() 
	{
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
			var vals = csv2arr( xhttp.responseText );
			var len = vals.length;
			var i, s;

			document.getElementById("Dates").innerHTML = '';

			for ( i = 0; i < len; i++ )
			{
				if ( i in vals )
				{
					s = vals[i];
					if ( i == len - 1 )
					{
						document.getElementById("Dates").innerHTML += '<li class="last"><a href="#" onclick="getLog(\'' + s + '\')">' + s + '</a></li>';
					} else {
						document.getElementById("Dates").innerHTML += '<li><a href="#" onclick="getLog(\'' + s + '\')">' + s + '</a></li>';
					}
				}
			}
		}
	};
	xhttp.open("GET", "builder.php?payload=dates&user=" + user + "&network=" + network + "&channel=" + channel, true);
	xhttp.send();
}

function getLog( date_log )
{
	var xhttp;
	document.getElementById("SelectedDate").innerHTML = date_log;
	var user = document.getElementById("SelectedUser").innerHTML;
	var network = document.getElementById("SelectedNetwork").innerHTML;
	var channel = document.getElementById("SelectedChannel").innerHTML;

	document.getElementById("DumpAreaTitle").innerHTML = "Viewing records for " + date_log + " / " + channel;

	
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
			document.getElementById("Content").innerHTML = '';
			document.getElementById("Content").innerHTML += xhttp.responseText;
		}
	};

	xhttp.open("GET", "logview.php?user=" + user + "&network=" + network + "&channel=" + encodeURIComponent(channel) + "&log=" + date_log, true);
	xhttp.send();
}

function csv2arr( string )
{
	return string.split(',');
}

function nl2arr( string )
{
	return string.split('\n');
}

loadUsers();
</script>


</body>
</html>
