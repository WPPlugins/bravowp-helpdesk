<?php

	//Returns an array of dates between two dates
	function bwhd_utility_returndatearray( $strDateFrom, $strDateTo )
	{

	    $aryRange=array();

	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2), substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2), substr($strDateTo,8,2),substr($strDateTo,0,4));

	    if ($iDateTo>=$iDateFrom)
	    {
	        $aryRange[ date('Y-m-d',$iDateFrom) ] = array( "opened"=>0, "closed"=>0, "date"=>date('m/d',$iDateFrom) );
	        while ($iDateFrom<$iDateTo)
	        {
	            $iDateFrom+=86400; // add 24 hours
	            $aryRange[ date('Y-m-d',$iDateFrom) ] = array( "opened"=>0, "closed"=>0, "date"=>date('m/d',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}


	function bwhd_utility_checkdateinrange( $start_date, $end_date, $my_date)
	{

	  // Convert to timestamp
	  $start_ts = strtotime($start_date);
	  $end_ts = strtotime($end_date);
	  $user_ts = strtotime($my_date);

	  // Check that user date is between start & end
	  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	  
	}


	//Used to truncate a long text and add "..."
	function bwhd_utility_truncatetext( $text, $lenght )
	{
		
		return strlen($text) > $lenght ? substr($text,0,$lenght)."..." : $text;
		
	}




?>