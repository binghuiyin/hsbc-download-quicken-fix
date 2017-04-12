<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>correct hsbc download for quicken</title>
</head>

<body>
<?php


$filepath = "./TransHist.qfx";

$fp = fopen($filepath, "r") or die("Couldn't open $filename");
$buf ='';
$counter = 0;
while (!feof($fp)) {
   $line = fgets($fp, 1024);
   
   	if (strpos($line, '<DTPOSTED>') !== false){
		$dtposted = substr(trim($line), 10);
	}
   
   if (trim($line) == '<FITID>' ){
	   $line = '<FITID>'.$dtposted;
	   $line .= "\r\n";
	}   
   
   if (trim($line) == '</QFX>'){
	   $line = '</OFX>';
	   $line .= "\r\n";
	}

	if (strpos($line, '<DTPOSTED>') !== false){
		$line = substr($line, strrpos($line, '<DTPOSTED>'), 18);
		 $line .= "\r\n";
	}
	
	if (strpos($line, '<DTUSER>') !== false){
		$line = substr($line, strrpos($line, '<DTUSER>'), 16);
		 $line .= "\r\n";
	}

	if (strpos($line, '<DTSTART>') !== false){
		$line = substr($line, strrpos($line, '<DTSTART>'), 17);
		 $line .= "\r\n";
	}
	
	if (strpos($line, '<DTEND>') !== false){
		$line = substr($line, strrpos($line, '<DTEND>'), 15);
		 $line .= "\r\n";
	}
	
	
   
$buf = $buf . $line;   
}

$newfile = "./import.qfx";
$fcsv = fopen("$newfile", "w");
fwrite($fcsv, $buf);
fclose ($fcsv);

?>

</body>
</html>