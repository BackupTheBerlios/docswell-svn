<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.fhg.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS SourceWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# This is the text backend of the system
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
###################################################################### 

require("./include/prepend.php3");

page_open(array("sess" => "DocsWell_Session"));
if (isset($auth) && !empty($auth->auth["perm"])) {
  page_close();
  page_open(array("sess" => "DocsWell_Session",
                  "auth" => "DocsWell_Auth",
                  "perm" => "DocsWell_Perm"));
}
header("Content-Type: text/plain");

// Disabling cache
header("Cache-Control: no-cache, must-revalidate");     // HTTP/1.1
header("Pragma: no-cache");                             // HTTP/1.0

require("./include/config.inc");
require("./include/lib.inc");

$db = new DB_DocsWell;
$db->query("SELECT * FROM DOKUMENT WHERE STATUS='A' ORDER BY AENDERUNGSDATUM DESC limit 10");
$i=0;
while($db->next_record()) {
  echo $db->f("TITEL")."\n";
  $timestamp = mktimestampdw($db->f("AENDERUNGSDATUM"));
  echo timestr($timestamp)."\n";
  echo $sys_url."docbyid.php?id=".$db->f("ID")."\n";
  $i++;
} 

@page_close();
?>
