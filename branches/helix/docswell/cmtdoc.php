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
# Give comment to a document
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

page_open(array("sess" => "DocsWell_Session",
                "auth" => "DocsWell_Auth",
                "perm" => "DocsWell_Perm"));

require("header.inc");
require("cmtlib.inc");

$bx = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if ($perm->have_perm("user_pending")) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {
  if (isset($id)) {
    $query = "SELECT * FROM DOKUMENT WHERE ID='$id'";
    $db->query($query);
    $db->next_record();
         // If application in table ask for comment

    if ($db->num_rows() > 0) {
      cmtform($query);
         // If application is not in table or pending
    } else {
      $be->box_full($t->translate("Error"), $t->translate("Document")." <b>".$db->f("TITEL")."</b> ".$t->translate("has not yet been reviewed by a $sys_name Editor.<BR> Please, be patient. It will be surely done in the next time."));
      
    }
  } else {
    $be->box_full($t->translate("Error"), $t->translate("No Document ID specified"));
  }
}
?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>
