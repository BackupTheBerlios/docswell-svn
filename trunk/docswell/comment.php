<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# This file contains the comment form
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
require("./include/cmtlib.inc");

$bx = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if (($config_perm_admcomment != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admcomment))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {

  if (isset($delete)) {
    if ($delete == 1) {
      $query = "SELECT * FROM KOMMENTAR WHERE DATUM='$modification' AND DOKUMENTID='$id'";
      cmtshow($query);

      $db->query($query);
      $db->next_record();
      $bx->box_begin();
      $bx->box_title($t->translate("Delete this comment? (please, think there's no way for undoing comment deletion)"));
      $bx->box_body_begin();	
      echo "<table><tr><td>\n";
      echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
      echo "<input type=\"hidden\" name=\"modification\" value=\"".$db->f("DATUM")."\">\n";
      echo "<input type=\"hidden\" name=\"id\" value=\"".$db->f("ID")."\">\n";
      echo "<input type=\"hidden\" name=\"delete\" value=\"2\">\n";
      echo "<input type=\"hidden\" name=\"modify\" value=\"0\">\n";
      echo "<input type=\"submit\" value=\"".$t->translate("Yes, Delete")."\">\n";

      echo "</form></td><td>\n";
      echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
      echo "<input type=\"hidden\" name=\"modification\" value=\"".$db->f("DATUM")."\">\n";
      echo "<input type=\"hidden\" name=\"id\" value=\"".$db->f("DOKUMENTID")."\">\n";
      echo "<input type=\"hidden\" name=\"modify\" value=\"1\">\n";
      echo "<input type=\"hidden\" name=\"delete\" value=\"0\">\n";
      echo "<input type=\"submit\" value=\"".$t->translate("No, Just Modify")."\">\n";
      echo "</form></td></td></table>\n";

      $bx->box_body_end();
      $bx->box_end();
    }
    if ($delete == 2) {
					// We remove it from our DB
      $db->query("DELETE FROM KOMMENTAR WHERE DATUM='$modification' AND ID='$id'");
      if ($db->affected_rows() < 1) {
        $be->box_full($t->translate("Error"), $t->translate("Database error"));
      }

      $bx->box_begin();
      $bx->box_title($t->translate("Comment deleted"));
      $bx->box_body_begin();
      echo $t->translate("Selected Comment was deleted");
      $bx->box_body_end();
      $bx->box_end();
    }
  }
  if (isset($modify)) {
    if ($modify == 1) {
      $query = "SELECT * FROM KOMMENTAR,DOKUMENT WHERE KOMMENTAR.DOKUMENTID='$id' AND DOKUMENT.ID = KOMMENTAR.DOKUMENTID AND DATUM='$modification'";
      cmtmod($query);
    }
    if ($modify == 2) {
				// We insert it into the DB
      $db->query("UPDATE KOMMENTAR SET SUBJECT='$subject',KOMMENTAR='$text',DATUM='$modification' WHERE DATUM='$modification' AND DOKUMENTID='$id'");
      if ($db->affected_rows() < 1) {
        $be->box_full($t->translate("Error"), $t->translate("Database error"));
      }
				// We show what we've inserted

      $query = "SELECT * FROM KOMMENTAR WHERE DATUM='$modification' AND DOKUMENTID='$id'";
      cmtshow($query);
    }
  }
}
?>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
