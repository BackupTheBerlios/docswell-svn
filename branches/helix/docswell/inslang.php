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
# Insert language
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
if (($config_perm_admlang != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admlang))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {

  if (isset($language) && !empty($language)) {
			      // Look if Language is already in table
    $db->query("SELECT * FROM SPRACHEDEF WHERE SPRACHE='$language'"); 

    if ($db->num_rows() > 0) {
      if (isset($new_language)) {
			       // If language in database and a new name is given, then rename
        if (!empty($new_language)) {

          $db->query("UPDATE SPRACHEDEF SET SPRACHE='$new_language' WHERE SPRACHE='$language'");
          if ($db->affected_rows() == 1) {
 	      $bx->box_full($t->translate("Administration"),$t->translate("Language")." $language ".$t->translate("has been renamed to")." $new_language");
          }
        } else {
				// Language is a blank line
          $be->box_full($t->translate("Error"), $t->translate("Language name not specified"));
        }
      }

      if (isset($del_language)) {
			// Language in database and we want to delete it
	if (!strcmp($del_language,"warning")) {
			// You've got another chance before it's deleted
			// We inform the administrator how many
			// docs will be affected by this deletion

          $db->query("SELECT ID FROM SPRACHEDEF WHERE SPRACHE='$language'");
          $db->next_record();
          $langid = $db->f("ID");

          $db->query("SELECT COUNT(*) FROM DOKUMENT WHERE SPRACHE='$langid'");
          $db->next_record();
          $number_of_docs = $db->f("COUNT(*)");

 	  $be->box_full($t->translate("Warning!"), $t->translate("If you press another time the Delete-button you will alter")." $number_of_docs ".$t->translate("documents that have actually language")." $language");

 	  $bx->box_begin();
	  $bx->box_title($t->translate("Delete Language"));
	  $bx->box_body_begin();
          echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
	  echo "<table border=0 cellspacing=0 cellpadding=3>\n";
          echo "<tr><td align=right>".$t->translate("Language").":</td><td>\n";
          echo $language;
	  echo "</td></tr>\n";
	  echo "<tr><td>&nbsp;</td>\n";
	  echo "<input type=\"hidden\" name=\"language\" value=\"$language\">\n";
          echo "<input type=\"hidden\" name=\"del_language\" value=\"too_late\">\n";
	  echo "<td><input type=\"submit\" value=\"".$t->translate("Delete")."\">";
	  echo "</td></tr>\n";
	  echo "</form>\n";
	  echo "</table>\n";
	  $bx->box_body_end();
	  $bx->box_end();

        } else {

          $db->query("DELETE FROM SPRACHEDEF WHERE SPRACHE='$language'");
  	  $bx->box_full($t->translate("Administration"), $t->translate("Deletion succesfully completed."));
        }
      } else {
        if (empty($new_language) && empty($del_language)) {
		          	// It's already in our database
				// but no rename and no deletion... ->error
          $be->box_full($t->translate("Error"), $t->translate("That language already exists!"));
        }
      }
    } else {
	        	// If license is not in table, insert it
      $db->query("INSERT INTO SPRACHEDEF SET SPRACHE='$language'");
      $bx->box_full($t->translate("Administration"),$t->translate("Language")." $language ".$t->translate("has been added succesfully"));
    }
  } else {
				// License is a blank line or isn't set
    $be->box_full($t->translate("Error"), $t->translate("Language not specified"));
  }
}

?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>
