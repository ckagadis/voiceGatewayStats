<?php
error_reporting(E_ALL);
ini_set('display_errors', True);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" http-equiv="refresh" content="20">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>CUCM PRI Active Calls</title>

	<?php
	$context = stream_context_create(array('ssl' => array('verify_peer' => false, 'allow_self_signed' => true)));

	$soapClient = new SoapClient("https://cucmServerIPAddress:8443/perfmonservice/services/PerfmonPort?wsdl", array('stream_context' => $context, 'trace'=>true, 'login' => "applicationUserName",'password'=> "applicationUserNamePassword"));
	$devices = $soapClient->PerfmonCollectCounterData("cucmServerIPAddress","Cisco MGCP PRI Device");

	//This array will hold the values (PRI channels active).  We'll use array_sum to add them together so that they can be inserted into a table.
	$deviceValueArray = array();

	//Check cucmServerIPAddress
	foreach($devices as $device)
	{

		if(
		(strpos($device->Name,'gateway1') !== false) && (strpos($device->Name,'CallsActive') !== false) ||
		(strpos($device->Name,'gateway2') !== false) && (strpos($device->Name,'CallsActive') !== false) ||
		(strpos($device->Name,'gateway3') !== false) && (strpos($device->Name,'CallsActive') !== false) ||
		(strpos($device->Name,'gateway4') !== false) && (strpos($device->Name,'CallsActive') !== false)
		)
		{
			$deviceValue = $device->Value;
			echo $device->Name . " : " . $device->Value . "<br />";
			array_push($deviceValueArray, $deviceValue);
		}

	}

	echo array_sum($deviceValueArray) . " total PRI channels in use.<br />";
	$total = array_sum($deviceValueArray) / 230 * 100;
	$total = round($total,0);
	echo $total . "% of PRI channels in use.";

	?>
