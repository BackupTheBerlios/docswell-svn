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
# Shows document with corresponding comment
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

page_open(array("sess" => "DocsWell_Session",
                "auth" => "DocsWell_Auth",
                "perm" => "DocsWell_Perm"));

require "header.inc";
require "cmtlib.inc";

$bx = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if ($perm->have_perm("user_pending")) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
  $auth->logout();
} else {
  if (isset($id)) {

         // Insert new comment
    $tables = "KOMMENTAR";
    $set = "DOKUMENTID=$id,KOMMENTAR='$text',SUBJECT='$subject',AUTOR='".$auth->auth["uname"]."'";
    $db->query("INSERT $tables SET $set");

      // Select and show new/updated application with comments
     $columns = "*";
     $tables = "DOKUMENT";
     $where = "ID='$id' AND STATUS!='D'";
     $query = "SELECT $columns FROM $tables WHERE $where";
     
     docfull($query);
            // we show the comments if available

    $query = "SELECT * FROM KOMMENTAR,auth_user WHERE DOKUMENTID='$id' AND auth_user.username=KOMMENTAR.AUTOR ORDER BY DATUM DESC";

    cmtshow($query);
  } else {
    $be->box_full($t->translate("Error"), $t->translate("No Application ID specified"));
  }
}
?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>
