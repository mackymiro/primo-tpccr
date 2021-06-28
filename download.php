<?php
//$trackname=$_GET['file'];
 
// Process your POST data into a CSV file
// here. Make sure to print NOTHING! If you
// do print something, the next part will fail.

// I'm assuming that at this point, you have
// your data in a CSV file named "mydata.csv"
$file = $_GET['file'];

// First, you need to set the headers, so that
// the browser knows to expect a CSV file download.
header("Content-Disposition: attachment; filename=" . basename($file));
header("Content-Type: text/xml");
header("Content-Length: " . filesize($file));

// You can also set Cache headers, to minimize the
// risk of the browser using old versions of the data.
header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: must-revalidate");

// And then you just print out the file data for
// the browser to open or save.
readfile($file);

// And, even though it's kind of redundant in
// this case, it's always a good idea to explicitly
// exit the script at this point, to reduce the
// chance of something corrupting the file data.
exit;
?> 