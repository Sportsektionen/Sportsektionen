<?php
class Event
{
	private $startDate;
	private $endDate;
	private $month;
	private $dayOfMonth;
	private $title;
	private $description;
	private $location;
	private $url;
	private $categories;

	function __construct($data)
	{
		$dataArray = explode("\n", $data);

		$startDateData = explode(":", $dataArray[1], 2);
		$this->startDate = $startDateData[1];

		$this->month = substr($this->startDate, 4, 2);
		if($this->hasLeadingZero($this->month))
			$this->month = substr($this->month, 1);

		$this->dayOfMonth = substr($this->startDate, 6, 2);
		if($this->hasLeadingZero($this->dayOfMonth))
			$this->dayOfMonth = substr($this->dayOfMonth, 1);

		$endDateData = explode(":", $dataArray[2], 2);
		$this->endDate = $endDateData[1];

		$titleData = explode(":", $dataArray[7], 2);
		$this->title = htmlspecialchars($titleData[1], ENT_QUOTES);

		$descriptionData = explode(":", $dataArray[8], 2);
		$this->description = htmlspecialchars($descriptionData[1], ENT_QUOTES);

		$categoriesData = explode(":", $dataArray[11], 2);
		$this->categories = htmlspecialchars($categoriesData[1], ENT_QUOTES);

		$urlData = explode(":", $dataArray[9], 2);
		$this->url = htmlspecialchars($urlData[1], ENT_QUOTES);
	}

	private function hasLeadingZero($string)
	{
		return $string[0] == "0";
	}

	function getTitle()
	{
		return $this->title;
	}

	function getMonth()
	{
		return $this->month;
	}

	function getDayOfMonth()
	{
		return $this->dayOfMonth;
	}

	function getURL()
	{
		return $this->url;
	}

	function getDescription()
	{
		return $this->description;
	}

	function isCategory($category)
	{
		return strpos($categories, $category) !== false;
	}

	static function comparator($a, $b)
	{
		return $a->startDate - $b->startDate;
	}
}
?>
