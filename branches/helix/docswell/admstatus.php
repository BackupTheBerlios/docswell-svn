<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Consistency check
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################  


page_open(array("sess" => "DocsWell_Session"));
if (isset($auth) && !empty($auth->auth["perm"])) {
  @page_close();
  page_open(array("sess" => "DocsWell_Session",
                  "auth" => "DocsWell_Auth",
                  "perm" => "DocsWell_Perm"));
}

require("header.inc");

$bx = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
?>

<!-- content -->
<?php
if (($config_perm_admfaq != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admfaq))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {
  $db->query("SELECT ID,TITEL, KATEGORIE FROM DOKUMENT WHERE STATUS !='D'");
   $dbKat = new DB_DocsWell;
   $bx->box_begin();
   $bx->box_title($t->translate("Document and category check"));
   $bx->box_body_begin(); 
   $bs->box_strip($t->translate("Documents with categories that have further sub-categories (documents should only hang on leaves)"));
   echo "<table width=100% border=0><tr><td>\n";
   $counter = 0;
   while($db->next_record()) {
	$dbKat->query ("SELECT count(*) as anz FROM KATEGORIE WHERE PARENT_ID=".$db->f("KATEGORIE"));
	$dbKat->next_record();
	if ($dbKat->f("anz") > 0) {
		echo "<a href=\"update_online.php?ID=".$db->f("ID")."\">".$db->f("TITEL")."</a><br>";
		$counter++;
	}
   }
   if ($counter == 0) 
   	echo $t->translate ("No documents found");
   
   echo "</td></tr>";
   echo "<tr><td colspan=\"2\">";
   
   echo "</td></tr>";
   
   echo "</table>\n";
   $bs->box_strip($t->translate("Documents with deleted category"));
   $db->query("SELECT ID,TITEL, KATEGORIE FROM DOKUMENT WHERE STATUS != 'D'");   
   echo "<table width=100% border=0><tr><td>\n";
   $counter = 0;
   while($db->next_record()) {
	$dbKat->query ("SELECT ID FROM KATEGORIE WHERE ID=".$db->f("KATEGORIE"));
	if ($dbKat->num_rows() == 0) {
		echo "<a href=\"update_online.php?ID=".$db->f("ID")."\">".$db->f("TITEL")."</a><br>";
		$counter++;
	}
   }
   if ($counter == 0) 
   	echo $t->translate ("No documents found");
   
   echo "</td></tr>";
   echo "<tr><td colspan=\"2\">";
   
   echo "</td></tr>";
   
   echo "</table>\n";

   $bs->box_strip($t->translate("All deleted documents"));
   $db->query("SELECT ID,TITEL FROM DOKUMENT WHERE STATUS = 'D' ORDER BY TITEL");   
   echo "<table width=100% border=0><tr><td>\n";
   $counter = 0;
   while($db->next_record()) {
	echo "<a href=\"update_online.php?ID=".$db->f("ID")."\">".$db->f("TITEL")."</a><br>";
	$counter++;
   }
   if ($counter == 0) 
   	echo $t->translate ("No documents found");
   
   echo "</td></tr>";
   echo "<tr><td colspan=\"2\">";
   
   echo "</td></tr>";
   
   echo "</table>\n";

   $bx->box_body_end();
   $bx->box_end();
}
?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>

