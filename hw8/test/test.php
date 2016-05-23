<html>
<head>
<title>Real Estate Search</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">

<!-- Optional theme -->
<!--<link rel="stylesheet" href="bootstrap/dist/css/bootstrap-theme.min.css">-->

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="bootstrap/dist/js/bootstrap.min.js"></script> -->

<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<style type="text/css">
body {
	background-image: url("V0779-d9.jpg");
	color: rgb(218,121,46);
}
#input {
	margin-top: 25px;
}
</style>
</head>

<body>
	<script>
      window.fbAsyncInit = function() {
        FB.init({
			appId      : '{your-app-id}',
		    status     : true,
		    xfbml      : true,
		    version    : 'v2.0'
		});
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="icon_link">
		<button>Share on facebook</button>
	</div>



	<div class="container">
		<h3>Search Your Property Here</h3>
		<div id="input">
			<form id="inputForm" class="form-inline" role="form" method="post">
				<div class="form-group">
					Street Address*: 
					<input type="text" name="street" class="form-control">&nbsp;&nbsp;
				</div>

				<div class="form-group">
					City: <input type="text" name="city" class="form-control">&nbsp;&nbsp;
				</div>

				<div class="form-group">
					State:
					<select name="state" class="form-control">
						<option></option>
							<option value="AL">AL</option>
							<option value="AK">AK</option>
							<option value="AZ">AZ</option>
							<option value="AR">AR</option>
							<option value="CA">CA</option>
							<option value="CO">CO</option>
							<option value="CT">CT</option>
							<option value="DE">DE</option>
							<option value="DC">DC</option>
							<option value="FL">FL</option>
							<option value="GA">GA</option>
							<option value="HI">HI</option>
							<option value="ID">ID</option>
							<option value="IL">IL</option>
							<option value="IN">IN</option>
							<option value="IA">IA</option>
							<option value="KS">KS</option>
							<option value="KY">KY</option>
							<option value="LA">LA</option>
							<option value="ME">ME</option>
							<option value="MD">MD</option>
							<option value="MA">MA</option>
							<option value="MI">MI</option>
							<option value="MN">MN</option>
							<option value="MS">MS</option>
							<option value="MO">MO</option>
							<option value="MT">MT</option>
							<option value="NE">NE</option>
							<option value="NV">NV</option>
							<option value="NH">NH</option>
							<option value="NJ">NJ</option>
							<option value="NM">NM</option>
							<option value="NY">NY</option>
							<option value="NC">NC</option>
							<option value="ND">ND</option>
							<option value="OH">OH</option>
							<option value="OK">OK</option>
							<option value="OR">OR</option>
							<option value="PA">PA</option>
							<option value="RI">RI</option>
							<option value="SC">SC</option>
							<option value="SD">SD</option>
							<option value="TN">TN</option>
							<option value="TX">TX</option>
							<option value="UT">UT</option>
							<option value="VT">VT</option>
							<option value="VA">VA</option>
							<option value="WA">WA</option>
							<option value="WV">WV</option>
							<option value="WI">WI</option>
							<option value="WY">WY</option>
					</select>&nbsp;&nbsp;
				</div>
				<!-- Do NOT use name="submit" or id="submit" for the Submit button -->
                <button type="submit" class="btn btn-warning">Submit</button>
				<!--<button type="submit" name="submit" class="btn btn-warning">Submit</button>
-->
				<div class="text-right"><img src="http://www.zillow.com/widgets/GetVersionedResource.htm?path=/static/logos/Zillowlogo_150x40.gif" width="150" height="40" alt="Zillow Real Estate Search" /></div>
			</form>
		</div>





<?php
date_default_timezone_set('America/Los_Angeles');

if(isset($_POST["submit"])){
	$street = $_POST['street'];
	$citystatezip = $_POST['city']." ".$_POST['state'];
	$street = urlencode($street);
	$citystatezip = urlencode($citystatezip);
	/*
	if(empty($street) || empty($city) || empty($state)){
		$str = "Please enter required value";
		echo "<SCRIPT TYPE='text/javascript'>alert($str);</SCRIPT>";
	}*/

	$url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&address=$street&citystatezip=$citystatezip&rentzestimate=true";

	if($xml = simplexml_load_file($url)){
		#echo $xml->message->text;
		$errorcode = $xml->message->code;
		if($errorcode == "0"){
			echo "test json";
			#echo json_encode($xml);

			//$states[]= array('state' => (string)$state->name); 
			//$e->result = $xml->response->results->result;
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
			//$e->result->restimateValueChangeSign = "+|-";	///
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


			echo "<h3>Search Results</h3>";
			echo "<div id='tbl'>";

			$zllwurl = $xml->response->results->result[0]->links->homedetails;
			#echo $zllwurl;
			echo "<div id='info'>See more details for <a href=$zllwurl>";
			$street = $xml->response->results->result[0]->address->street;
			$city = $xml->response->results->result[0]->address->city;
			$state = $xml->response->results->result[0]->address->state;
			$zip = $xml->response->results->result[0]->address->zipcode;
			echo "$street, $city, $state-$zip";
			echo "</a> on Zillow</div>";
			echo "<button>Share on facebook</button>";

			echo "<table class='table'>";

			echo "<tr><td class=ln>Property Type:</td>";
			echo "<td class=lc>".$xml->response->results->result[0]->useCode."</td>";
			echo "<td class=rn>Last Sold Price:</td>";
			$lastSoldPrice = $xml->response->results->result[0]->lastSoldPrice;
			if($lastSoldPrice=="")
				echo "<td class=rc></td></tr>";
			else
				echo "<td class=rc>$" . number_format("$lastSoldPrice",2)."</td></tr>";	//format numbers
			

			echo "<tr><td class=ln>Year Built:</td>";
			echo "<td class=lc>".$xml->response->results->result[0]->yearBuilt."</td>";
			echo "<td class=rn>Last Sold Date:</td>";
			$lastSoldDate = $xml->response->results->result[0]->lastSoldDate;
			if($lastSoldDate=="")
				echo "<td class=rc></td></tr>";
			else
				echo "<td class=rc>". date("d-M-Y",strtotime($lastSoldDate)) . "</td></tr>";	//format date


			echo "<tr><td class=ln>Lot Size:</td>";
			$lotSize = $xml->response->results->result[0]->lotSizeSqFt;
			if($lotSize!="")
				echo "<td class=lc>".number_format("$lotSize",2)." sq. ft."."</td>";
			else
				echo "<td class=lc></td>";

			$lstUpdated = $xml->response->results->result[0]->zestimate->{'last-updated'};
			echo "<td class=rn>Zestimate<sup>&reg;</sup> Property Estimate as of ". date("d-M-Y",strtotime($lstUpdated)) ."</td>";
			$zamount = $xml->response->results->result[0]->zestimate->amount;
			if($zamount!="")
				echo "<td class=rc>$". number_format("$zamount",2) ."</td></tr>";
			else
				echo "<td class=rc></td></tr>";			

					
			echo "<tr><td class=ln>Finished Area:</td>";
			$finishedSqFt = $xml->response->results->result[0]->finishedSqFt;
			if($finishedSqFt!="")
				echo "<td class=lc>".number_format("$finishedSqFt",2)." sq. ft."."</td>";
			else
				echo "<td class=lc></td>";
			
			$zchange = $xml->response->results->result[0]->zestimate->valueChange;
			$zchange = intval($zchange);
			if($zchange!=""){
				if($zchange < 0){
					echo "<td class=rn>30 Days Overall Change <img src='http://cs-server.usc.edu:45678/hw/hw6/down_r.gif'/>:</td>";
					$zchange = abs($zchange);
					echo "<td class=rc>$" . number_format("$zchange",2) ."</td></tr>";
				}else{
					echo "<td class=rn>30 Days Overall Change <img src='http://cs-server.usc.edu:45678/hw/hw6/up_g.gif'/>:</td>";
					echo "<td class=rc>$". number_format("$zchange",2) ."</td></tr>";		
				}
			}else{
				echo "<td class=rn>30 Days Overall Change:</td>";
				echo "<td class=rc></td>";
			}

			
			echo "<tr><td class=ln>Bathrooms:</td>";
			echo "<td class=lc>".$xml->response->results->result[0]->bathrooms."</td>";
			echo "<td class=rn>All Time Property Range:</td>";
			$prlow = $xml->response->results->result[0]->zestimate->valuationRange->low;
			$prhigh = $xml->response->results->result[0]->zestimate->valuationRange->high;
			if($prlow=="" && $prhigh=="")
				echo "<td class=rc></td>";
			else
				echo "<td class=rc>$" . number_format("$prlow",2) . " - $" . number_format("$prhigh",2) ."</td></tr>";
			

			echo "<tr><td class=ln>Bedrooms:</td>";
			echo "<td class=lc>".$xml->response->results->result[0]->bedrooms."</td>";
			$rlstUpdated = $xml->response->results->result[0]->rentzestimate->{'last-updated'};
			$rentamount = $xml->response->results->result[0]->rentzestimate->amount;
			echo "<td class=rn><label>Rent Zestimate<sup>&reg;</sup> </label>Rent Valuation as of " . date("d-M-Y",strtotime($rlstUpdated)) . ":</td>";
			if($rentamount!="")
				echo "<td class=rc>$". number_format("$rentamount",2)."</td></tr>";
			else
				echo "<td class=rc></td></tr>";
			

			echo "<tr><td class=ln>Tax Assessment Year:</td>";
			echo "<td class=lc>".$xml->response->results->result[0]->taxAssessmentYear."</td>";	

			$rvalchange = $xml->response->results->result[0]->rentzestimate->valueChange;
			if($rvalchange!=""){
				$rvalchange = intval($rvalchange);
				if($rvalchange < 0){
					echo "<td class=rn>30 Days Rent Change <img src='http://cs-server.usc.edu:45678/hw/hw6/down_r.gif'/>:</td>";
					$rvalchange = abs($rvalchange);
					echo "<td class=rc>$" . number_format("$rvalchange",2) ."</td></tr>";
				}else{
					echo "<td class=rn>30 Days Rent Change <img src='http://cs-server.usc.edu:45678/hw/hw6/up_g.gif'/>:</td>";
					echo "<td class=rc>$". number_format("$rvalchange",2) ."</td></tr>";		
				}
			}else{
				echo "<td class=rn>30 Days Rent Change:</td>";
				echo "<td class=rc></td></tr>";	
			}
			
			
			echo "<tr><td class=ln>Tax Assessment:</td>";
			$taxAssessment = $xml->response->results[0]->result->taxAssessment;
			if($taxAssessment=="")
				echo "<td class=lc></td>";
			else
				echo "<td class=lc>$". number_format("$taxAssessment",2) ."</td>";
			
			echo "<td class=rn>All Time Rent Range:</td>";
			$rlow = $xml->response->results->result[0]->rentzestimate->valuationRange->low;
			$rhigh = $xml->response->results->result[0]->rentzestimate->valuationRange->high;
			if($rlow==""&&$rhigh=="")
				echo "<td class=rc></td></tr></table></div>";
			else
				echo "<td class=rc>$" . number_format("$rlow",2) . " - $". number_format("$rhigh",2) . "</td></tr></table></div>";





			echo "<div id='footer'>&copy Zillow, Inc., 2006-2014. Use is subject to <a href='http://www.zillow.com/corp/Terms.htm'>Terms of Use</a><br><a href='http://www.zillow.com'> What's a Zestimate?</a></div>";

		}else if($errorcode == "508"){
			#echo $errorcode;
			echo "<h3>No exact match found--Verify that the given address is correct.</h3>";
			echo "<div id='footer'>&copy Zillow, Inc., 2006-2014. Use is subject to <a href='http://www.zillow.com/corp/Terms.htm'>Terms of Use</a><br><a href='http://www.zillow.com'> What's a Zestimate?</a></div>";
		}else{
			$dtxt = $xml->message->text;
			echo "<h3>$dtxt</h3>";
			echo "<div id='footer'>&copy Zillow, Inc., 2006-2014. Use is subject to <a href='http://www.zillow.com/corp/Terms.htm'>Terms of Use</a><br><a href='http://www.zillow.com'> What's a Zestimate?</a></div>";
		}
	}else{
		exit('failed to open the file');
	}
}
?>


	</div>


<NOSCRIPT>

<script src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/dist/js/bootstrap.min.js"></script>

<!-- BootstrapValidator JS -->
<script type="text/javascript" src="bootstrap/dist/js/bootstrapValidator.min.js"></script>

<script>
$(document).ready(function() {
    $('#inputForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            street: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>