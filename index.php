<?php

	$response = file_get_contents('http://foodtruckfiesta.com/apps/map_json.php?num_days=365&minimal=0&alert_nc=y&alert_hc=0&alert_pm=0&rand='.rand(0,9999999999));

	$responseObj = json_decode($response);

	$truckArray = $responseObj->markers;

	$myLat = 38.9227020;
	$myLong = -77.2329280;
	$noTrucks = true;

	for($i = 0; $i < count($truckArray); $i++) {
		$truck = $truckArray[$i];

		$latDist = abs($myLat - $truck->coord_lat);
		$longDist = abs($myLong - $truck->coord_long);

		if ($latDist<0.01 && $longDist<0.01) {
			echo $truck->print_name;
			$noTrucks = false;
			echo "\n";
		}		
	}

	if ($noTrucks == true){
		echo "not today buddy";
	}
	 
?>