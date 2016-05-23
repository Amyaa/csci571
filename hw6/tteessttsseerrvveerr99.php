<html>
<head>
<title>Real Estate Search</title>
<style type="text/css">
	h2 {
		text-align: center;
		margin-top: 30px;
	}
	h3 {
		text-align: center;
		margin-top: 20px;
	}
	#main {
		width: 450px;
		display: block;
		border: 2px solid black;
		margin-left: auto;
		margin-right: auto;
		margin-top: 30px;
		padding-top: 10px;
		padding-bottom: 10px;
		padding-left: 10px;
	}
	#btn {
		margin-top: -40px;
		margin-left: -2px;
		width: 70px;
		height: 25px;
	}
	#txt {
		font-style: italic;
	}
	#tbl {
		width: 900px;
		display: block;
		margin-right: auto;
		margin-left: auto;
	}
	table {
		margin-top: 5px;
	}
	#info {
		background-color: rgb(238,230,181);
		display: block;
		border: 1px solid black;
		padding-bottom: 1px;
		padding-top: 1px;
		margin-top: -5px;
	}
	#info a {
		padding-left: 2px;
		padding-right: 2px;
		font-weight: bold;
		text-decoration: none;
	}
	.ln {
		width: 200px;
	}
	.lc {
		width: 150px;
	}
	.rn {
		width: 350px;
	}
	.rc {
		width: 200px;
	}
	#footer {
		width: 500px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 28px;
		margin-bottom: 2px;
		text-align: center;
	}
</style>

<SCRIPT TYPE="text/javascript">
	function isEmpty(input){
		if(input.replace(/^\s*|\s$/g,"") == ""){
			return true;
		}else{
			return false;
		}
	}

	function testempty(tform){
		var street = tform.street.value;
		var city = tform.city.value;
		var state = tform.state.value;
		var str = "";

		if(isEmpty(street) && isEmpty(city) &&isEmpty(state)){
			str = "Please enter value for Street, City and State";
			alert(str);
		}else if(isEmpty(street) && isEmpty(city)){
			str = "Please enter value for Street and City";
			alert(str);
		}else if(isEmpty(street) && isEmpty(state)){
			str = "Please enter value for Street and State";
			alert(str);
		}else if(isEmpty(city) && isEmpty(state)){
			str = "Please enter value for City and State";
			alert(str);
		}else if(isEmpty(street)){
			str = "Please enter value for Street";
			alert(str);
		}else if(isEmpty(city)){
			str = "Please enter value for City";
			alert(str);
		}else if(isEmpty(state)){
			str = "Please enter value for State";
			alert(str);
		}
	}
</SCRIPT>
</head>

<body>
<h2>Real Estate Search</h2>
<div id="main">
	<form method="post">
		<table>
			<tr><td>Street Address*:</td><td><input type="text" name="street"/></td></tr>
			<tr><td>City*: </td><td><input type="text" name="city"/><br/></td></tr>
			<tr>
				<td>State*: </td>
				<td>
					<select size="1" name="state">
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
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" id="btn" value="search" onclick="testempty(this.form)"/>
					<a href="http://www.zillow.com/"><img src="http://www.zillow.com/widgets/GetVersionedResource.htm?path=/static/logos/Zillowlogo_150x40.gif" width="150" height="40" alt="Zillow Real Estate Search" /></a>
				</td>
			</tr>
		</table>
	</form>
	<div id="txt">*- Mandatory fields.</div>
</div>

<?php
//date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected the timezone 'UTC' for now, but please set date.timezone to select your timezone.
#date_default_timezone_set('UTC');
date_default_timezone_set('America/Los_Angeles');

if(isset($_POST["submit"])){
	##correct url instance
	#$url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&address=2636+Menlo+Avenue&citystatezip=los+angeles%2C+CA&rentzestimate=true";
	##incorrect url instance
	#$url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&address=2636+Menlo+Avenue&citystatezip=los+aneles%2C+CA&rentzestimate=true";

	$street = $_POST['street'];
	$citystatezip = $_POST['city']." ".$_POST['state'];
	$street = urlencode($street);
	$citystatezip = urlencode($citystatezip);
	
	if(empty($street) || empty($city) || empty($state)){
		$str = "Please enter required value";
		echo "<SCRIPT TYPE='text/javascript'>alert($str);</SCRIPT>";
	}

	$url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2huoxvz7v_93aho&address=$street&citystatezip=$citystatezip&rentzestimate=true";
	#echo $url;

	if($xml = simplexml_load_file($url)){
		#echo $xml->message->text;
		$errorcode = $xml->message->code;
		if($errorcode == "0"){
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

			echo "<table>";

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
<NOSCRIPT>
</body>
</html>