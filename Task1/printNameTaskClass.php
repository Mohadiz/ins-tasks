<?php

class printNameTask
{

	function __construct(string $arg)
	{
		$this->arg = $arg;
	}
	
	/**
    * Print out given name based on REQUEST argument
    *
    * @return String
    */
	public function printName()
	{
		$theName = $this->trimArg($this->arg);
		
		if ( empty($theName) )
			return 'Name argument is empty.';
		
		$stringArray = str_split($theName);
		
		$result = "";
		
		foreach ( $stringArray as $char )
		{
			$result .= $char;
		}
		
		return $result;
	}
	
	
	
	/**
    * Print out REQUEST arguments without special characters 
    *
    * @return String
    */	
	private function trimArg( string $arg )
	{
		$clearStr = preg_replace('/[^a-zA-Z0-9\s]/', '', $_REQUEST[$arg]);
		return trim($clearStr);
	}
	
}

	


?>