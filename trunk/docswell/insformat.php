<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ====================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Manage document formats
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

$bx = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if (($config_perm_admformat != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admformat))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {

  if (isset($format) && !empty($format)) {
			      // Look if Format is already in table
    $db->query("SELECT * FROM FORMATDEF WHERE NAME='$format'"); 

    if ($db->num_rows() > 0) {
      if (isset($new_format)) {
			       // If format in database and a new name is given, then rename
        if (!empty($new_format)) {

          $db->query("UPDATE FORMATDEF SET NAME='$new_format' WHERE NAME='$format'");
          if ($db->affected_rows() == 1) {
 	      $bx->box_full($t->translate("Administration"),$t->translate("Format")." $format ".$t->translate("has been renamed to")." $new_format");
          }
        } else {
				// Format is a blank line
          $be->box_full($t->translate("Error"), $t->translate("Format name not specified"));
        }
      }

      if  (isset($new_description)) {
	             // If format in database and a new description is given, then go for it
        if (!empty($new_description)) {
          $db->query("UPDATE FORMATDEF SET KOMMENTAR='$new_description' WHERE NAME='$format'");
	  $bx->box_full($t->translate("Administration"),$t->translate("Format")." $format ".$t->translate("has a new Description:")." $new_description");
        } else {
				// Description is a blank line
          $be->box_full($t->translate("Error"), $t->translate("New Description not specified"));
        }
      }
      if (isset($del_format)) {
			// Formaqt in database and we want to delete it
	if (!strcmp($del_format,"warning")) {
			// You've got another chance before it's deleted
			// We inform the administrator how many
			// docs will be affected by this deletion

          $db->query("SELECT ID FROM FORMATDEF WHERE NAME='$format'");
          $db->next_record();
          $formatid = $db->f("ID");

          $db->query("SELECT COUNT(*) FROM FORMAT WHERE FORMATID='$formatid'");
          $db->next_record();
          $number_of_docs = $db->f("COUNT(*)");

 	  $be->box_full($t->translate("Warning!"), $t->translate("If you press another time the Delete-button you will alter")." $number_of_docs ".$t->translate("documants that have actually format")." $format");

 	  $bx->box_begin();
	  $bx->box_title($t->translate("Delete Format"));
	  $bx->box_body_begin();
          echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
	  echo "<table border=0 cellspacing=0 cellpadding=3>\n";
          echo "<tr><td align=right>".$t->translate("Format").":</td><td>\n";
          echo $format;
	  echo "</td></tr>\n";
	  echo "<tr><td>&nbsp;</td>\n";
	  echo "<input type=\"hidden\" name=\"format\" value=\"$format\">\n";
          echo "<input type=\"hidden\" name=\"del_format\" value=\"too_late\">\n";
	  echo "<td><input type=\"submit\" value=\"".$t->translate("Delete")."\">";
	  echo "</td></tr>\n";
	  echo "</form>\n";
	  echo "</table>\n";
	  $bx->box_body_end();
	  $bx->box_end();

        } else {

          $db->query("DELETE FROM FORMATDEF WHERE NAME='$format'");
  	  $bx->box_full($t->translate("Administration"), $t->translate("Deletion succesfully completed."));
        }
      } else {
        if (empty($new_format) && empty($new_description) && empty($del_format)) { 
		          	// It's already in our database
				// but no rename and no deletion and no new description... ->error
          $be->box_full($t->translate("Error"), $t->translate("That format already exists!"));
        }
      }
    } else {
	        	// If format is not in table, insert it
      if (!empty($description)) {
        $db->query("INSERT INTO FORMATDEF SET NAME='$format',KOMMENTAR='$description'");
        $bx->box_full($t->translate("Administration"),$t->translate("Format")." $format ".$t->translate("with Description")." $description ".$t->translate("has been added succesfully"));
      } else {
				// Description is a blank line
        $be->box_full($t->translate("Error"), $t->translate("Format description not specified"));
      }
    }
  } else {
				// Format is a blank line or isn't set
    $be->box_full($t->translate("Error"), $t->translate("Format not specified"));
  }
}

?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>
