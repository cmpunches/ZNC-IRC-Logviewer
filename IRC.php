<?php
/*
	ZNC-LogViewer Version 1.0 - 15/03/2011
	A simple script to display ZNC logs online, with basic HTML parsing.
	For changelog, please see my git repo, at http://git.antoligy.com
	Copyright (c) 2011 Alex "Antoligy" Wilson <antoligy@antoligy.com>
	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/
## Firstly, configuration.
 # this would appear to be basic security, you don't need to touch this.
	$chdir = array('..', '/', '~', '#', '\',);
 # channels where logs will not be publicly viewable, should be obvious what
 #   what this is useful for.
	$denied = array('gbatemp.eof', 'bearcave', 'ndscheats-staff', '*');
 # the error returned when someone tries accessing one of the above channels
 #   feel free to add assorted slurs here
	$denymsg = array('Access Denied');
 # the path to the log directory itself
	$logpath = ('/');
 # the colour scheme
	$scheme = array('background' => '#FFFFFF', 'foreground' => '#000000', 'link' => '#0000FF');
 # the default channel
  $chan = 'gbatemp.net';
## Config is over, now onto the script itself.
 # is the channel set?
	if(isset($_GET['chan'])) {
		foreach($denied as $denied) {
			if($_GET['chan'] == $denied) {
				die('Access Denied');
			}
			else {
				$chan = str_replace($chdir, '', $_GET['chan']);
			}
		}
	}
	$remove = array('.log', $logpath . '#' . $chan . '_');
# date handling, this pretty much determines whether a log is being displayed or whether channel logs are being listed.
	if(isset($_GET['date'])) {
		$logfile = ($logpath . '#' . $chan . '_' . str_replace($chdir, '', $_GET['date']) . '.log');
		$fh = @fopen($logfile, 'r');
		$logdata = @fread($fh, filesize($logfile));
		@fclose($fh);
		if(isset($_GET['raw'])) {
			header('Content-type: text/plain');
			die($logdata);
		}
		else {
			$search_http = "/(http[s]*:\/\/[\S]+)/";
			$replace_http = "<a href='\${1}'>\${1}</a>";
			$html_lines = array("\r", "\n");
			$logdata = htmlspecialchars($logdata);
			$logdata = preg_replace($search_http, $replace_http, $logdata);
			$logdata = str_replace($html_lines, '<br />' . "\r\n", $logdata);
			$begindoc = '<html> <head> <title>#' . $chan . ' logs for ' . date("F d Y", filemtime($logfile)) . '</title> </head> <body link="' . $scheme['link'] . '"alink="' . $scheme['link'] . '" vlink="' . $scheme['link'] . '" bgcolor="' . $scheme['background'] . '" text="' . $scheme['foreground'] . '"> <p> <a href="?date=' . str_replace($remove, '', $logfile) . '&chan=' . $chan . '&raw"> Raw text file </a></p><p>';
			$enddoc = '</p> </body> </html>';
			die($begindoc . $logdata . $enddoc);
		}
	}
	else {
		$logs = glob('' . $logpath . '#' . $chan . '_*.log');
		sort($logs);
 # BEHOLD, THE MOST BLAND HTML SKILLS OF ALL TIME
		print('<html>
		<head>
		<title>#' . $chan . ' Logs</title>
		</head>
		<body link="' . $scheme['link'] . '"alink="' . $scheme['link'] . '" vlink="' . $scheme['link'] . '" bgcolor="' . $scheme['background'] . '" text="' . $scheme['foreground'] . '">
		<p><h1><center><u>#' . $chan . ' logs:</u></center></h1></p>');
 # this is the massive search bar, I can't remember if it's linked to an adsense account or not, but feel free to replace it.
			print('<style type="text/css"> @import url(http://www.google.com/cse/api/branding.css); </style> <div class="cse-branding-bottom" style="background-color:#' . $scheme['background'] . ';color:' . $scheme['foreground'] . ';>
			 <div class="cse-branding-form">
    			 <form action="http://www.google.co.uk/cse" id="cse-search-box">
      			 <div >
      			 <input type="hidden" name="cx" value="partner-pub-5675989731160327:eeu1h0-f703" />
      			 <input type="hidden" name="ie" value="ISO-8859-1" />
      			 <input type="text" name="q" size="31" style="width: 90%;" />
      			 <input type="submit" name="sa" value="Search" style="width: 5%;" />
      			 </div>
      			 </form>
      			 </div>
      			 </div>');
 # LETS PRINT SOME LOGS =D
		foreach ($logs as $filename) {
	  	print('<li><a href="?date=' . str_replace($remove, '', $filename) . '&chan=' . $chan . '">' . date("F d Y", filemtime($filename)) . '</a></li>');
		}
## I'm not entirely sure what use this would be to anyone other than myself, since after all I'm pretty much one of the few using this module.
## uncomment (and modify) if you find some use for it.
##		print('<a href="http://phobos.stormbit.net:8033/' . $chan . '/top/total/lines/"><tt>#' . $chan . ' Stats</tt></a><br /> </body> </html>');
	}
?>
