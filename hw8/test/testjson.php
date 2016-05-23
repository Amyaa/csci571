<html>
<head>
<title>JSON Test</title>
</head>

<body>
<?php
date_default_timezone_set('America/Los_Angeles');

			echo "test json";
			#echo json_encode($xml);

			class Emp {
				public $name = "";
				public $hobbies = "";
				public $birthday = "";
			}
			$e = new Emp();
			$e->name = "robert";
			$e->hobbies = "sports";
			$e->birthday = date('m/d/Y h:i:s a',"8/5/1974 12:20:03 p");
			echo json_encode($e);

?>
<NOSCRIPT>
</body>
</html>