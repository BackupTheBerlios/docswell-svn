<?php

######################################################################
# DocsWell: Documents Announcement & RetrievalSystem
# ====================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Insert catagory
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
if (($config_perm_admcat != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admcat))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {

  if (isset($category) && !empty($category)) {
    // Look if Category is already in table
    $Sql = "SELECT * FROM KATEGORIE WHERE (NAME='$category' OR ID='$category') ";
    if ($ref_cat) $Sql .= " AND PARENT_ID='$ref_cat' "; 
    $db->query($Sql);

    //echo $Sql;

    if ($db->num_rows() > 0) {
      if (isset($new_category)) {
        // If category in database and a new name is given, then rename
        if (!empty($new_category)) {
          $db->query("UPDATE KATEGORIE SET NAME='$new_category' WHERE id='$category'");
          if ($db->affected_rows() == 1) {
 	      $bx->box_full($t->translate("Administration"),$t->translate("Category")." $category ".$t->translate("has been renamed to")." $new_category");
          }
        } else {
   	  // Category is a blank line
          $be->box_full($t->translate("Error"), $t->translate("Category name not specified"));
        }
      }

      if  (isset($new_description)) {
	// If category in database and a new description is given, then go for it
        $db->query("UPDATE KATEGORIE SET KOMMENTAR='$new_description' WHERE NAME='$category'");
	$bx->box_full($t->translate("Administration"),$t->translate("Category")." $category ".$t->translate("has a new Description:")." $new_description");
      }
      if (isset($del_category)) {
	// Formaqt in database and we want to delete it
	if (!strcmp($del_category,"warning")) {
	  // You've got another chance before it's deleted
	  // We inform the administrator how many
	  // docs will be affected by this deletion
          $db->query("SELECT NAME,ID FROM KATEGORIE WHERE id='$category'");
          $db->next_record();
	  $name=$db->f("NAME");
          $catid = $db->f("ID");
          $db->query("SELECT COUNT(*) FROM DOKUMENT WHERE KATEGORIE='$catid'");
          $db->next_record();
          $number_of_docs = $db->f("COUNT(*)");
 	  $be->box_full($t->translate("Warning!"), $t->translate("If you press another time the Delete-button you will alter")." $number_of_docs ".$t->translate("documents that have actually this category"));
 	  $bx->box_begin();
	  $bx->box_title($t->translate("Delete Category"));
	  $bx->box_body_begin();
          echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
	  echo "<table border=0 cellspacing=0 cellpadding=3>\n";
          echo "<tr><td align=right>".$t->translate("Category").":</td><td>\n";
          echo $t->translate($name);
	  echo "</td></tr>\n";
	  echo "<tr><td>&nbsp;</td>\n";
	  echo "<input type=\"hidden\" name=\"category\" value=\"$category\">\n";
          echo "<input type=\"hidden\" name=\"del_category\" value=\"too_late\">\n";
	  echo "<td><input type=\"submit\" value=\"".$t->translate("Delete")."\">";
	  echo "</td></tr>\n";
	  echo "</form>\n";
	  echo "</table>\n";
	  $bx->box_body_end();
	  $bx->box_end();
        } else {
          $db->query("DELETE FROM KATEGORIE WHERE id='$category'");
  	  $bx->box_full($t->translate("Administration"), $t->translate("Deletion succesfully completed."));
        }
      } else {
        if (empty($new_category) && empty($new_description) && empty($del_category)) { 
          // It's already in our database
	  // but no rename and no deletion and no new description... ->error
          $be->box_full($t->translate("Error"), $t->translate("This category already exists"));
        }
      }
    } else {
      // If category is not in table, insert it
      if ($ref_cat > 0) {
        $db->query("INSERT INTO KATEGORIE SET NAME='$category',KOMMENTAR='$description', PARENT_ID='$ref_cat'");
        $bx->box_full($t->translate("Administration"),$t->translate("Category")." $category ".$t->translate("has been added succesfully"));
      } else {
        $be->box_full($t->translate("Error"), $t->translate("Root category not specified"));    
      }
    }
  } else {
    // Category is a blank line or isn't set
    $be->box_full($t->translate("Error"), $t->translate("Category not specified"));
  }
}

?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>

