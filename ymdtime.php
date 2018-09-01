
	
	//This function converts a unix time integer into a readable date
	// and time string, and returns it.  
	// Remember, it's better to use javascript to display date/time in a 
	// browser (it automatically sets itself to user's local machine time).  
	// But, for doing time calculations in the server, you'll need a function like that below.
	// (function contains essential reference code you should use from time to time.)
	function ymdtime($timeint=null, $diff=7) {
		// What's your time zone?  Set value of $majorCity to:
		//     "Los_Angeles" for pacific time, "Denver" mountain,
		//     "Chicago" central,"New_York" for eastern.
		$majorCity = "Denver" ;
		//This line is needed to use php's date() function properly.
		date_default_timezone_set("America/" . $majorCity);
		//echo date("Y / m / d -- H : i : s",  7200). " ". "<br/>";
		// Javascript Date() function returns client time and tells user
		// the number of hours difference from GMT:
		// echo "<script>document.write(Date());</script><br/>"; 
		//( Have the above line be sent back to server via ajax.  Then use explode() to 
		//  extract the numbers.)
		// Put that number in $diff and write:
		if ($timeint === null)   $timeint = (time() - (3600 * $diff));
		// The time() function returns gmt (greenwich mean time)
		// in form of integer.
			
		// Now you want to convert the integer into a readable date,
		// so write:
		$years = floor(($timeint / 86400) / 365.25); 
		// Only needed for debugging:
		// echo $years . "<br/>";
		if ($years<4 && $years>=2) $leapYears = 1;
		else $leapYears = round($years/4);
		//If the current year is a leap year, then it's been counted as 
		// one of the leap years inside of $leapYears, which will cause a bug
		// if one day isn't removed. $leapYears is only supposed to store the
		// number of leap years up to the current year (not including it). 
		//It gives the computer an extra day it doesn't know what to do with. 
		// So if it's a leap year, remove one day:
		if (($years+1970) % 4 === 0)
		$leapDays=($leapYears * 366) - 1;
		else $leapDays=($leapYears * 366);
		$nonLeapDs=(($years-$leapYears)*365);
		$totalYrDs=$leapDays+$nonLeapDs; 
		$dsleftover = floor(($timeint - ($totalYrDs * 86400))/86400);
		$dsleftover = ((int)$dsleftover);
		$totalYrDsecs=($totalYrDs*86400);
		$secsleftover=($timeint - ($dsleftover * 86400) - $totalYrDsecs);
		if ($secsleftover > 0)  $dsleftover += 1;//This line keeps the day of the 
								// month from ever displaying as 0.
		/* Keep this block just in case it might stop a bug later,
		  though probably won't need it now:
		if ($dsleftover > 365) {
			$dsleftover = 0; $years += 1;$overflow=true;
		}
		if ($dsleftover === 0) $dsleftover = 1;
		*/
		
		$hrsleftover=floor($secsleftover/3600);
		$secsleftover=$secsleftover-($hrsleftover*3600);
		$minsleftover=floor($secsleftover/60);	
		$secsleftover=$secsleftover-($minsleftover*60);

		if ((($years+1970) % 4) === 0)
			$feb=29; 
		else $feb=28; 
		$mnts=array(1=>31,$feb,31,30,31,30,31,31,30,31,30,31);//keep it like this!
		$n=1;  
		if ($dsleftover > 31) {
			while ($dsleftover > $mnts[$n] && $n < 13) {
				$dsleftover -= $mnts[$n];
				//This line only needed for debugging:
				//echo $n . " - " . $dsleftover . "<br/>";
				$n += 1;
				if ($n > 12){
					$n = $n-12;   $years+=1;   
				}    
			}// end while
			$mnth = $n;
		}
		// Else, if $dsleftover is not greater than 31...
		else { //...set the month to January.
			$mnth = 1;
		}
	    
		$yr= $years + 1970;
		$nums=array(($hrsleftover += 100),($minsleftover += 100),($secsleftover += 100));
		for ($i=0;$i<3;++$i) {
			if (strlen($nums[$i]) > 2)
				$nums[$i] = substr($nums[$i], 1);
		}
		return $yr . " - ". $mnth . " - " . $dsleftover . " -- " . 
			$nums[0] . " : " . $nums[1] . " : " . $nums[2];
	} // end of function ymdtime().