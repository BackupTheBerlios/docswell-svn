<?php
######################################################################
# DocsWell: Document Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# This file shows an app (given by the id parameter)
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

require "./include/prepend.php3";

page_open(array("sess" => "DocsWell_Session"));
if (isset($auth) && !empty($auth->auth["perm"])) {
  @page_close();
  page_open(array("sess" => "DocsWell_Session",
                  "auth" => "DocsWell_Auth",
                  "perm" => "DocsWell_Perm"));
}

require "./include/header.inc";
require "./include/cmtlib.inc";

$bx = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php

$columns = "*";
$tables = "DOKUMENT";
$where = "ID='$id' AND STATUS !='D' ";
$query = "SELECT $columns FROM $tables WHERE $where";
$db->query($query);

if ($db->next_record()) {

  $db_status = $db->f("STATUS");
  if ($db_status == 'A') {
    docfull($query);
   
    $columns = "*";
    $tables = "KOMMENTAR";
    $where = "DOKUMENTID=$id";

    $query = "SELECT $columns FROM $tables WHERE $where";
    
    cmtshow($query);
    
  } else {
  switch($db_status) {
      case "M":            
   $be->box_full($t->translate("Error"), $t->translate("Document")." <b>".$db->f("TITEL")."</b> ".$t->translate("is modified").".");
   break;
      case "D":
   $be->box_full($t->translate("Error"), $t->translate("Document")." <b>".$db->f("TITEL")."</b> ".$t->translate("is deleted").".");
   break;
      default:
        $be->box_full($t->translate("Error"), $t->translate("Document")." (ID: $id) ".$t->translate("does not exist").".");
   break;
    }
  }
}
?>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
