<?
// Disabling cache
header("Cache-Control: no-cache, must-revalidate");     // HTTP/1.1
header("Pragma: no-cache");                             // HTTP/1.0

require "config.inc";
require "lib.inc";

$db = new DB_DocsWell;

if($dokuid) {
     $db->query("UPDATE DOKUMENT SET BEWERTUNG=BEWERTUNG+$bewerten, BEWVONANZP=BEWVONANZP+1 WHERE ID=$dokuid");      
}

$docurl = "$url?id=$dokuid";
?>
<html>
<head>
<?php
echo "<meta http-equiv=\"refresh\" content=\"0; URL=$docurl\">\n";
?>
</head>
<body>
   <a href="<?php echo $docurl ?>">Back</a>
</body>
</html>
