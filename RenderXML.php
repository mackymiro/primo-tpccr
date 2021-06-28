<?php
  $dir = 'uploadfiles';
$filename=$_GET["Filename"];

$XMLFile = file_get_contents($dir."/".$filename); 

$XMLFile = str_replace("<ActNumber>", "<H3><font color='blue'><u>Act Number:", $XMLFile);
$XMLFile = str_replace("</ActNumber>", "</u></font></H3>", $XMLFile);

$XMLFile = str_replace("<Caption>", "<H3>Caption:<u>", $XMLFile);
$XMLFile = str_replace("</Caption>", "</u></H3>", $XMLFile);


$XMLFile = str_replace("<EffectiveDate>", "<H3>Effective Date:<u>", $XMLFile);
$XMLFile = str_replace("</EffectiveDate>", "</u></H3>", $XMLFile);

$XMLFile = str_replace("<ShortName>", "<H3>Short Name:<u>", $XMLFile);
$XMLFile = str_replace("</ShortName>", "</u></H3>", $XMLFile);

$XMLFile = str_replace("<RevisionHistory>", "<H3>RevisionHistory:<u>", $XMLFile);
$XMLFile = str_replace("</RevisionHistory>", "</u></H3>", $XMLFile);

$XMLFile = str_replace("<SourceNoteLink>", "<H3>SourceNoteLink:<u>", $XMLFile);
$XMLFile = str_replace("</SourceNoteLink>", "</u></H3>", $XMLFile);

$XMLFile = str_replace("<Update>", "<H3>Update:<u>", $XMLFile);
$XMLFile = str_replace("</Update>", "</u></H3>", $XMLFile);

$XMLFile ="<html>".$XMLFile."</html>";

echo $XMLFile;
?>