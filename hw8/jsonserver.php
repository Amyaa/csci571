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
			/*$e->result->latitude = (string)$xml->response->results->result[0]->address->latitude;
			$e->result->longitude = (string)$xml->response->results->result[0]->address->longitude;*/
			$useCode = (string)$xml->response->results->result[0]->useCode;
			if($useCode=="")
				$e->result->useCode = "N/A";
			else
				$e->result->useCode = $useCode;

			$lastSoldPrice = $xml->response->results->result[0]->lastSoldPrice;
			if($lastSoldPrice=="")
				$e->result->lastSoldPrice = "N/A";
			else
				$e->result->lastSoldPrice = "$".(string)number_format("$lastSoldPrice",2);//(string)$lastSoldPrice;
			
			$yearBuilt = (string)$xml->response->results->result[0]->yearBuilt;
			if($yearBuilt=="")
				$e->result->yearBuilt = "N/A";
			else
				$e->result->yearBuilt = $yearBuilt;


			$lastSoldDate = (string)$xml->response->results->result[0]->lastSoldDate;
			if($lastSoldDate=="")
				$e->result->lastSoldDate = "N/A";
			else
				$e->result->lastSoldDate = (string)date("d-M-Y",strtotime($lastSoldDate));//(string)$lastSoldPrice;		


			$lotSizeSqFt = (string)$xml->response->results->result[0]->lotSizeSqFt;
			if($lotSizeSqFt=="")
				$e->result->lotSizeSqFt = "N/A";
			else
				$e->result->lotSizeSqFt = (string)number_format("$lotSizeSqFt",2)." sq. ft.";


			$estimateLastUpdate = (string)$xml->response->results->result[0]->zestimate->{'last-updated'};
			if($estimateLastUpdate=="")
				$e->result->estimateLastUpdate = "N/A";
			else
				$e->result->estimateLastUpdate = (string)date("d-M-Y",strtotime($estimateLastUpdate));//(string)$lastSoldPrice;		


			$estimateAmount = (string)$xml->response->results->result[0]->zestimate->amount;
			if($estimateAmount=="")
				$e->result->estimateAmount = "N/A";
			else
				$e->result->estimateAmount = "$".(string)number_format("$estimateAmount",2);//(string)$lastSoldPrice;		


			$finishedSqFt = (string)$xml->response->results->result[0]->finishedSqFt;
			if($finishedSqFt=="")
				$e->result->finishedSqFt = "N/A";
			else
				$e->result->finishedSqFt = (string)number_format("$finishedSqFt",2)." sq. ft.";


			$zvchange = $xml->response->results->result[0]->zestimate->valueChange;
			if($zvchange=="")
				$e->result->estimateValueChangeSign = "";
			else if(intval($zvchange) < 0)
				$e->result->estimateValueChangeSign = "-";
			else
				$e->result->estimateValueChangeSign = "+";

			$e->result->imgn = "http://www-scf.usc.edu/~csci571/2014Spring/hw6/down_r.gif";
			$e->result->imgp = "http://www-scf.usc.edu/~csci571/2014Spring/hw6/up_g.gif";


			if($zvchange=="")
				$e->result->estimateValueChange = "N/A";
			else
				$e->result->estimateValueChange = "$".(string)number_format(abs($zvchange),2);


			$e->result->bathrooms = (string)$xml->response->results->result[0]->bathrooms;

			$evlow = (string)$xml->response->results->result[0]->zestimate->valuationRange->low;
			if($evlow=="")
				$e->result->estimateValuationRangeLow = "N/A";
			else
				$e->result->estimateValuationRangeLow = "$".(string)number_format("$evlow",2);


			$evhight = (string)$xml->response->results->result[0]->zestimate->valuationRange->high;
			if($evhight=="")
				$e->result->estimateValuationRangeHigh = "N/A";
			else
				$e->result->estimateValuationRangeHigh = "$".(string)number_format("$evhight",2);


			$bedrooms = (string)$xml->response->results->result[0]->bedrooms;
			if($bedrooms=="")
				$e->result->bedrooms = "N/A";
			else
				$e->result->bedrooms = (string)$bedrooms;


			$restimateLastUpdate = (string)$xml->response->results->result[0]->rentzestimate->{'last-updated'};
			if($restimateLastUpdate=="")
				$e->result->restimateLastUpdate = "N/A";
			else
				$e->result->restimateLastUpdate = (string)date("d-M-Y",strtotime($restimateLastUpdate));//(string)$lastSoldPrice;		



			$restimateAmount = (string)$xml->response->results->result[0]->rentzestimate->amount;
			if($restimateAmount=="")
				$e->result->restimateAmount = "N/A";
			else
				$e->result->restimateAmount = "$".(string)number_format("$restimateAmount",2);



			$taxAssessmentYear = (string)$xml->response->results->result[0]->taxAssessmentYear;
			if($taxAssessmentYear=="")
				$e->result->taxAssessmentYear = "N/A";
			else
				$e->result->taxAssessmentYear = (string)$taxAssessmentYear;
			
			

			$restimateValueChange = (string)$xml->response->results->result[0]->rentzestimate->valueChange;
			if($restimateValueChange=="")
				$e->result->restimateValueChangeSign = "";
			else if(intval($restimateValueChange) < 0){
				$e->result->restimateValueChangeSign = "-";
			}else
				$e->result->restimateValueChangeSign = "+";


			if($restimateValueChange=="")
				$e->result->restimateValueChange = "N/A";
			else
				$e->result->restimateValueChange = "$".(string)number_format(abs($restimateValueChange),2);



			$taxAssessment = (string)$xml->response->results->result[0]->taxAssessment;
			if($taxAssessment=="")
				$e->result->taxAssessment = "N/A";
			else
				$e->result->taxAssessment = "$".(string)number_format("$taxAssessment",2);




			$rvlow = (string)$xml->response->results->result[0]->rentzestimate->valuationRange->low;
			if($rvlow=="")
				$e->result->restimateValuationRangeLow = "N/A";
			else
				$e->result->restimateValuationRangeLow = "$".(string)number_format("$rvlow",2);

			$rvhight = (string)$xml->response->results->result[0]->rentzestimate->valuationRange->high;
			if($rvhight=="")
				$e->result->restimateValuationRangeHigh = "N/A";
			else
				$e->result->restimateValuationRangeHigh = "$".(string)number_format("$rvhight",2);



			$e->chart = new stdClass();

			$zpid = $xml->response->results->result[0]->zpid;
			$chart1url = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=600&height=300";
			$chart1xml = simplexml_load_file($chart1url);
			//$e->chart->{'1year'} = (string)$chart1xml->response->url;
			$oyear = (string)$chart1xml->response->url;
			if($oyear=="")
				$e->chart->oyear = "N/A";
			else
				$e->chart->oyear = (string)$oyear;

			$chart5url = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=600&height=300&chartDuration=5years";
			$chart5xml = simplexml_load_file($chart5url);		
			//$e->chart->{'5years'} = (string)$chart5xml->response->url;
			$fyears = (string)$chart5xml->response->url;
			if($fyears=="")
				$e->chart->fyears = "N/A";
			else
				$e->chart->fyears = (string)$fyears;

			$chart10url = "http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&unit-type=percent&zpid=$zpid&width=600&height=300&chartDuration=10years";
			$chart10xml = simplexml_load_file($chart10url);	
			//$e->chart->{'10years'} = (string)$chart10xml->response->url;
			$tyears = (string)$chart10xml->response->url;
			if($tyears=="")
				$e->chart->tyears = "N/A";
			else
				$e->chart->tyears = $tyears;

			//echo "<hr>".$chart1url."<hr>".$chart5url."<hr>".$chart10url."<hr>";

			echo json_encode($e);

		}else if($errorcode == "508"){
			#echo $errorcode;//No exact match found--Verify that the given address is correct.</h3>
			$e->msg = "error";
			echo json_encode($e);
		}
	}else{
		exit('failed to open the file');
	}
?>