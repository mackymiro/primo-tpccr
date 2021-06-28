<?php
 
$sLog="";
$sLog = $sLog."<li><a href='#' onclick='CharFill()'><i class='fa fa-gear'></i> Char Fill <sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='SmallCaps()'><i class='fa fa-gear'></i> Small Caps <sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='Strikethrough()'><i class='fa fa-gear'></i> Strikethrough<sub></sub></a></li>";

$sLog = $sLog."<li><a href='#' onclick='RemoveTag()'><i class='fa fa-gear'></i> Remove Tag<sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='ResequenceParagraph()'><i class='fa fa-gear'></i> Re-sequence Paragraph ID<sub></sub></a></li>";
$sLog = $sLog."<li><b><i class='fa fa-folder'></i> Heading<sub></sub></b></li>";
$sLog = $sLog."<li><a href='#' onclick='LHeadingFlush()'><i class='fa fa-gear'></i> Left Heading Flush and Hanging <sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='LHeadingIndented()'><i class='fa fa-gear'></i> Left heading Indented and Hanging<sub></sub></a></li>";
$sLog = $sLog."<li><b><i class='fa fa-folder'></i> Subparagraphs Attribute Values<sub></sub></b></li>";
$sLog = $sLog."<li><a href='#' onclick='FLTurnover()'><i class='fa fa-gear'></i> First-line=”1” turnover=”1” <sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FLTurnoverHanging()'><i class='fa fa-gear'></i> First-line=”1” turnover=”hanging”<sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FL2()'><i class='fa fa-gear'></i> First-line=”2” turnover=”1” <sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FLT2()'><i class='fa fa-gear'></i> First-line=”2” turnover=”2”<sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FLT3()'><i class='fa fa-gear'></i> First-line=”2” turnover=”3”<sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FL2H()'><i class='fa fa-gear'></i> First-line=”2” turnover=”hanging” <sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FL32()'><i class='fa fa-gear'></i> First-line=”3” turnover=”2” <sub></sub></a></li>";
 
 
$sLog = $sLog."<li><b><i class='fa fa-folder'></i> Footnote Subparagraphs Attribute Values<sub></sub></b></li>";


$sLog = $sLog."<li><a href='#' onclick='FFL2()'><i class='fa fa-gear'></i> First-line=”2” turnover=”2” <sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FFLT2()'><i class='fa fa-gear'></i> First-line=”3” turnover=”3”<sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FFLT3()'><i class='fa fa-gear'></i> align=center<sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FFL2H()'><i class='fa fa-gear'></i> First-line=”1” turnover=1 <sub></sub></a></li>";
$sLog = $sLog."<li><a href='#' onclick='FFL21()'><i class='fa fa-gear'></i> First-line=”2” turnover=”1” <sub></sub></a></li>";

$sLog = $sLog."<li><a href='#' onclick='FFL32()'><i class='fa fa-gear'></i> First-line=”3” turnover=”2” <sub></sub></a></li>";

echo $sLog;
?>