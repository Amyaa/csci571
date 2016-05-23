<?php
date_default_timezone_set('America/Los_Angeles');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
//echo json_encode($_GET);

	$street = $_GET['street'];	
	$citystatezip = $_GET['city']." ".$_GET['state'];
	$street = urlencode($street);
	$citystatezip = urlencode($citystatezip);
	//echo $street."<br>".$citystatezip."<br>";
	$url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&address=$street&citystatezip=$citystatezip&rentzestimate=true";
	//echo $url."<br>";
	//echo json_encode($_GET);

	if($xml = simplexml_load_file($url)){
		$errorcode = $xml->message->code;
		if($errorcode == "0"){
			$e = new stdClass();
			$e->result = new stdClass();
			$e->result->homedetails = (string)$xml->response->results->result[0]->links->homedetails;
			$e->result->street = (string)$xml->response->results->result[0]->address->street;
			$e->result->city = (string)$xml->response->results->result[0]->address->city;
			$e->result->state = (string)$xml->response->results->result[0]->address->state;
			$e->result->zipcode = (string)$xml->response->results->result[0]->address->zipcode;
			$e->result->latitude = (string)$xml->response->results->result[0]->address->latitude;
			$e->result->longitude = (string)$xml->response->results->result[0]->address->longitude;
			$e->result->useCode = (string)$xml->response->results->result[0]->useCode;

			$lastSoldPrice = $xml->response->results->result[0]->lastSoldPrice;
			if($lastSoldPrice=="")
				$e->result->lastSoldPrice = "N/A";
			else
				$e->result->lastSoldPrice = (string)number_format("$lastSoldPrice",2);//(string)$lastSoldPrice;
			
			//$e->result->lastSoldPrice = (string)$lastSoldPrice;
			$e->result->yearBuilt = (string)$xml->response->results->result[0]->yearBuilt;
			$e->result->lastSoldDate = (string)$xml->response->results->result[0]->lastSoldDate;
			$e->result->lotSizeSqFt = (string)$xml->response->results->result[0]->lotSizeSqFt;
			$e->result->estimateLastUpdate = (string)$xml->response->results->result[0]->zestimate->{'last-updated'};
			$e->result->estimateAmount = (string)$xml->response->results->result[0]->zestimate->amount;
			$e->result->finishedSqFt = (string)$xml->response->results->result[0]->finishedSqFt;
			if(intval($xml->response->results->result[0]->zestimate->valueChange) < 0)
				$e->result->estimateValueChangeSign = "-";
			else
				$e->result->estimateValueChangeSign = "+";
			$e->result->imgn = "http:\/\/www- scf.usc.edu\/~csci571\/2014Spring\/hw6\/down_r.gif";
			$e->result->imgp = "http:\/\/www- scf.usc.edu\/~csci571\/2014Spring\/hw6\/up_g.gif";
			$e->result->estimateValueChange = (string)$xml->response->results->result[0]->valueChange;
			$e->result->bathrooms = (string)$xml->response->results->result[0]->bathrooms;
			$e->result->estimateValuationRangeLow = (string)$xml->response->results->result[0]->zestimate->valuationRange->low;
			$e->result->estimateValuationRangeHigh = (string)$xml->response->results->result[0]->zestimate->valuationRange->high;
			$e->result->bedrooms = (string)$xml->response->results->result[0]->bedrooms;
			$e->result->restimateLastUpdate = (string)$xml->response->results->result[0]->rentzestimate->{'last-updated'};
			$e->result->restimateAmount = (string)$xml->response->results->result[0]->rentzestimate->amount;
			$e->result->taxAssessmentYear = (string)$xml->response->results->result[0]->taxAssessmentYear;
			if(intval($xml->response->results->result[0]->rentzestimate->valueChange) < 0){
				$e->result->restimateValueChangeSign = "-";
			}			
			else
				$e->result->restimateValueChangeSign = "+";
			$e->result->restimateValueChange = (string)$xml->response->results->result[0]->rentzestimate->valueChange;
			$e->result->taxAssessment = (string)$xml->response->results->result[0]->taxAssessment;
			$e->result->restimateValuationRangeLow = (string)$xml->response->results->result[0]->rentzestimate->valuationRange->low;
			$e->result->restimateValuationRangeHigh = (string)$xml->response->results->result[0]->rentzestimate->valuationRange->high;
			
			$e->chart = new stdClass();

			$zpid = $xml->response->results->result[0]->zpid;
			$chart1url = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=300&height=150";
			$chart1xml = simplexml_load_file($chart1url);
			//$e->chart->{'1year'} = (string)$chart1xml->response->url;
			$e->chart->oyear = (string)$chart1xml->response->url;

			$chart5url = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=300&height=150&chartDuration=5years";
			$chart5xml = simplexml_load_file($chart5url);		
			//$e->chart->{'5years'} = (string)$chart5xml->response->url;
			$e->chart->fyears = (string)$chart5xml->response->url;

			$chart10url = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=300&height=150&chartDuration=10years";
			$chart10xml = simplexml_load_file($chart10url);	
			//$e->chart->{'10years'} = (string)$chart10xml->response->url;
			$e->chart->tyears = (string)$chart10xml->response->url;

			//echo "<hr>".$chart1url."<hr>".$chart5url."<hr>".$chart10url."<hr>";

			echo json_encode($e);

		}else if($errorcode == "508"){
			#echo $errorcode;//No exact match found--Verify that the given address is correct.</h3>
		}
	}else{
		exit('failed to open the file');
	}
?>