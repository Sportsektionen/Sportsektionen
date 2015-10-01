<?php
	function timeSinceLastModified($file)
	{
		if(file_exists($file))
		{
			return time() - filemtime($file);
		}
		else
		{
			return -1;
		}
	}


	require 'Event.php';
	date_default_timezone_set("Europe/Stockholm");
	$currentMonth = date("Y-m");
	$nextMonth = strval(date("Y"));
	$nextMonth .= "-";
	$month = strval(date("m")+1);

	if(strlen($month) == 1)
	{
			$month = strval(0).$month;
	}
	$nextMonth .= $month;

	if(!file_exists("calendarData.ics") || timeSinceLastModified("calendarData.ics") > 900)
	{
		file_put_contents("calendarData.ics", fopen("http://disk.su.se/kalender/$currentMonth/?ical=1&tribe_display=month", 'r'));
		file_put_contents("calendarDataNextMonth.ics", fopen("http://disk.su.se/kalender/$nextMonth/?ical=1&tribe_display=month", 'r'));
	}
	$currentMonthFile = file_get_contents("calendarData.ics");
	$nextMonthFile = file_get_contents("calendarDataNextMonth.ics");
	$eventDataCurrentMonth = explode("BEGIN:VEVENT", $currentMonthFile);
	$eventDataNextMonth = explode("BEGIN:VEVENT", $nextMonthFile);
	$eventData = array_merge($eventDataCurrentMonth, $eventDataNextMonth);
	$currentDate = date("Ymd\THis");

	$eventData = array_unique($eventData);

	foreach($eventData as &$data)
	{
			if(strpos($data, "END:VEVENT") !== false && strpos($data, "Sportsektionen") !== false)
			{
					$eventEndTime = getDateFor($data);
					if($eventEndTime > $currentDate)
					{
						$event = new Event($data);
						if(!isset($eventArray) || !in_array($event, $eventArray))
							$eventArray[] = $event;
					}
			}
	}

	if(sizeof($eventArray) > 0)
	{
			usort($eventArray, array("Event", "comparator"));
			echo "<span class='upcomingEvents'>Upcoming events for Sportsektionen:</span><br/>";
			foreach($eventArray as &$event)
			{
					echo "<a href='".$event->getURL()."' class='event' title='".$event->getDescription()."'>".$event->getTitle()." ".$event->getDayOfMonth()."/".$event->getMonth()."</a><br/>";
			}
	}
	else
	{
			echo "<span>There are currently no future events for Sportsektionen.</span><br/>";
	}

?>
