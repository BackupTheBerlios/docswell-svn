<?php

######################################################################
# DocsWell: Documents Annoucement & RetrievalSystem
# ====================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Insert type
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

require("./include/prepend.php3");

page_open(array("sess" => "DocsWell_Session"));
if (isset($auth) && !empty($auth->auth["perm"])) {
  @page_close();
  page_open(array("sess" => "DocsWell_Session",
                  "auth" => "DocsWell_Auth",
                  "perm" => "DocsWell_Perm"));
}

require("./include/header.inc");

$bx = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if (($config_perm_admtype != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admtype))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {

  if (isset($type) && !empty($type)) {
			      // Look if Type is already in table
    $db->query("SELECT * FROM TYPDEF WHERE NAME='$type'"); 

    if ($db->num_rows() > 0) {
      if (isset($new_type)) {
			       // If type in database and a new name is given, then rename
        if (!empty($new_type)) {

          $db->query("UPDATE TYPDEF SET NAME='$new_type' WHERE NAME='$type'");
          if ($db->affected_rows() == 1) {
 	      $bx->box_full($t->translate("Administration"),$t->translate("Type")." $type ".$t->translate("has been renamed to")." $new_type");
          }
        } else {
				// Type is a blank line
          $be->box_full($t->translate("Error"), $t->translate("Type name not specified"));
        }
      }

      if  (isset($new_description)) {
	             // If type in database and a new description is given, then go for it
        if (!empty($new_description)) {
          $db->query("UPDATE TYPDEF SET KOMMENTAR='$new_description' WHERE NAME='$type'");
	  $bx->box_full($t->translate("Administration"),$t->translate("Type")." $type ".$t->translate("has a new Description:")." $new_description");
        } else {
				// Description is a blank line
          $be->box_full($t->translate("Error"), $t->translate("New Description not specified"));
        }
      }
      if (isset($del_type)) {
			// Formaqt in database and we want to delete it
	if (!strcmp($del_type,"warning")) {
			// You've got another chance before it's deleted
			// We inform the administrator how many
			// docs will be affected by this deletion

          $db->query("SELECT ID FROM TYPDEF WHERE NAME='$type'");
          $db->next_record();
          $typeid = $db->f("ID");

          $db->query("SELECT COUNT(*) FROM DOKUMENT WHERE TYP='$typeid'");
          $db->next_record();
          $number_of_docs = $db->f("COUNT(*)");

 	  $be->box_full($t->translate("Warning!"), $t->translate("If you press another time the Delete-button you will alter")." $number_of_docs ".$t->translate("documants that have actually type")." $type");

 	  $bx->box_begin();
	  $bx->box_title($t->translate("Delete Type"));
	  $bx->box_body_begin();
          echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
	  echo "<table border=0 cellspacing=0 cellpadding=3>\n";
          echo "<tr><td align=right>".$t->translate("Type").":</td><td>\n";
          echo $type;
	  echo "</td></tr>\n";
	  echo "<tr><td>&nbsp;</td>\n";
	  echo "<input type=\"hidden\" name=\"type\" value=\"$type\">\n";
          echo "<input type=\"hidden\" name=\"del_type\" value=\"too_late\">\n";
	  echo "<td><input type=\"submit\" value=\"".$t->translate("Delete")."\">";
	  echo "</td></tr>\n";
	  echo "</form>\n";
	  echo "</table>\n";
	  $bx->box_body_end();
	  $bx->box_end();

        } else {

          $db->query("DELETE FROM TYPDEF WHERE NAME='$type'");
  	  $bx->box_full($t->translate("Administration"), $t->translate("Deletion succesfully completed."));
        }
      } else {
        if (empty($new_type) && empty($new_description) && empty($del_type)) { 
		          	// It's already in our database
				// but no rename and no deletion and no new description... ->error
          $be->box_full($t->translate("Error"), $t->translate("This document type already exists"));
        }
      }
    } else {
	        	// If type is not in table, insert it
      if (!empty($description)) {
        $db->query("INSERT INTO TYPDEF SET NAME='$type',KOMMENTAR='$description'");
        $bx->box_full($t->translate("Administration"),$t->translate("Type")." $type ".$t->translate("with Description")." $description ".$t->translate("has been added succesfully"));
      } else {
				// Description is a blank line
        $be->box_full($t->translate("Error"), $t->translate("Type description not specified"));
      }
    }
  } else {
				// Type is a blank line or isn't set
    $be->box_full($t->translate("Error"), $t->translate("Type not specified"));
  }
}

?>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
