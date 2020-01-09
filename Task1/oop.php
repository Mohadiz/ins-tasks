<?php

	include_once dirname(__FILE__) . '/printNameTaskClass.php';
	
	/**
	Test the class
	*/

	$printName = new printNameTask('name');
	echo $printName->printName();
?>