<html>
<head>
<title>Test</title>
</head>

<?php
$url = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws- id=X1-ZWz1b2huoxvz7v_93aho&address=" + $_POST[street] + "&citystatezip=" + $_POST[city] + "+" + $_POST[state] + "&rentzest imate=true";
if(file_exists($url)){
	$xml = simplexml_load_file($url);
	print_r($xml);
}else{
	exit('failed to open the file');
}
alert($url);
?>
</body>
</html>