<?php

	if ( empty($_GET['name']) )
	{
		echo 'Pass the name with GET argument';
	}
	else
	{
		
	
		$stringArray = str_split($_GET['name']);
			
		$result = "";
		
		for ( $char = 0; $char < count($stringArray) ; $char++ )
		{
			$result .= $stringArray[$char];
		}
		
		echo $result;
	}
?>