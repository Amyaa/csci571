<html>
<head><title>json</title></head>
<body>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

date_default_timezone_set('America/Los_Angeles');

	$street = $_GET['street'];
	$citystatezip = $_GET['city']." ".$_GET['state'];
	$street = urlencode($street);
	$citystatezip = urlencode($citystatezip);	

	$url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&address=$street&citystatezip=$citystatezip&rentzestimate=true";

	if($xml = simplexml_load_file($url)){
		$errorcode = $xml->message->code;
		if($errorcode == "0"){
			//echo "test json";
			#echo json_encode($xml
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
			$e->result->lastSoldPrice = (string)$xml->response->results->result[0]->lastSoldPrice;
			$e->result->lotSizeSqFt = (string)$xml->response->results->result[0]->links->lotSizeSqFt;
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
			
			// $e->images->photoGallery = (string)$xml->response->results->result[0]->links->homedetails;
			// $e->images->image1 = (string)$xml->response->results->result[0]->links->homedetails;
			
			
			$e->chart = new stdClass();

			$zpid = $xml->response->results->result[0]->zpid;
			$charturl = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=300&height=150";
			$e->chart->{'1year'} = (string)$xml->response->results->result[0]->links->homedetails;

			$charturl = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=300&height=150&chartDuration=5years";			
			$e->chart->{'5years'} = (string)$xml->response->results->result[0]->links->homedetails;

			$charturl = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=300&height=150&chartDuration=10years";
			$e->chart->{'10years'} = (string)$xml->response->results->result[0]->links->homedetails;

			echo json_encode($e);
			echo "<hr>";

		}else if($errorcode == "508"){
			#echo $errorcode;//No exact match found--Verify that the given address is correct.</h3>
		}
	}else{
		exit('failed to open the file');
	}
?>

</body>
</html>