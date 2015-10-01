<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" media="only screen and (max-width: 1160px)" type="text/css" href="tablet.css" />
<link rel="stylesheet" media="only screen and (max-width: 520px)" type="text/css" href="mobile.css" />

<title>Sportsektionen DISK</title>

</head>
<body>

<div id="logo"></div>

<fieldset id="main">
	<legend>Sportsektionen</legend>

	<p class="description">
		 Sportsektionen is a section of the student union <a class="textlink" href="http://disk.su.se">DISK</a> at Stockholm University. We arrange sport activities for our members such as floorball, badminton and basketball. Please refer to DISK's calendar below for latest updates on date and times for events.
	</p>

	<p class="links">
		<a href="mailto:sporten@dsv.su.se">sporten@dsv.su.se</a><br/>
		<a href="http://disk.su.se/kalender">DISK calendar</a><br/>
		<a href="http://facebook.com/sportsektionen">Sportsektionen on Facebook</a><br/>
		<a href="https://www.facebook.com/groups/246028798885289/">Our Facebook group</a><br/>
	</p>

	<p>
		<?php include 'eventParser.php'; ?>
	</p>
</fieldset>



</body></html>

<?php

function getDateFor($data)
{
	preg_match("/\d{8}\T\d{6}/", $data, $match);
	return $match[0];
}

?>
