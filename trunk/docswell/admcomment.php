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
# Manage comments
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

$bx = new box("95%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$bx_small = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
?>

<!-- content -->
<?
if (($config_perm_admcomment != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admcomment))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {
  if (!isset($by) || empty($by)) {
    $by = "";
  }
  $alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L",
				"M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
  $msg = "[ ";
  while (list(, $ltr) = each($alphabet)) {
    $msg .= "<a href=\"".$sess->self_url().$sess->add_query(array("by"=>$ltr))."\">$ltr</a>&nbsp;| ";
  }
  $msg .= "<a href=\"".$sess->self_url().$sess->add_query(array("by"=>$ltr))."\">".$t->translate("All")."</a>&nbsp;]";
  $bs->box_strip($msg);

  $by = $by."%";
  $db->query("SELECT DOKUMENT.ID,TITEL,AUTOR,SUBJECT,DATUM FROM KOMMENTAR,DOKUMENT WHERE DOKUMENT.ID = KOMMENTAR.DOKUMENTID AND DOKUMENT.TITEL LIKE '$by' ORDER BY KOMMENTAR.DATUM DESC");
  $bx->box_begin();
  $bx->box_title($t->translate("Comments"));
  $bx->box_body_begin();

  echo "<table border=0 align=center cellspacing=1 cellpadding=1 width=100%>\n";
  echo "<tr><td><b>".$t->translate("No").".</b></td>\n";
  echo "<td><b>".$t->translate("Document")."</b></td>\n";
  echo "<td><b>".$t->translate("Subject")."</b></td>\n";
  echo "<td><b>".$t->translate("Author")."</b></td>\n";
  echo "<td><b>".$t->translate("Posted on")."</b></td>\n";
  echo "<td>&nbsp;</td>\n";
  echo "<td>&nbsp;</td></tr>\n";

  $i = 1;
  while($db->next_record()) {
    echo "<tr><td>$i</td>\n";
    echo "<td><a href=\"".$sess->url("docbyid.php?id=".$db->f("ID")."")."\">".$db->f("TITEL")."</a></td>\n";
    echo "<td>".$db->f("SUBJECT")."</td>\n";
    echo "<td>".$db->f("AUTOR")."</td>\n";
    $timestamp = mktimestamp($db->f("DATUM"));
    echo "<td>".timestr_short($timestamp)."</td>\n";

    echo "<td><form action=\"".$sess->url("comment.php")."\" method=\"POST\">\n";
    echo "<input type=\"hidden\" name=\"modify\" value=\"1\">\n";
    echo "<input type=\"hidden\" name=\"delete\" value=\"0\">\n";
    echo "<input type=\"hidden\" name=\"modification\" value=\"".$db->f("DATUM")."\">\n";    
    echo "<input type=\"hidden\" name=\"id\" value=\"".$db->f("ID")."\">\n";
    echo "<input type=\"submit\"value=\"".$t->translate("Modify")."\">\n";
    echo "</form></td>\n";

    echo "<td><form action=\"".$sess->url("comment.php")."\" method=\"POST\">\n";
    echo "<input type=\"hidden\" name=\"delete\" value=\"1\">\n";
    echo "<input type=\"hidden\" name=\"modify\" value=\"0\">\n";
    echo "<input type=\"hidden\" name=\"modification\" value=\"".$db->f("DATUM")."\">\n";
    echo "<input type=\"hidden\" name=\"id\" value=\"".$db->f("ID")."\">\n";
    echo "<input type=\"submit\"value=\"".$t->translate("Delete")."\">\n";
    echo "</form></td>\n";
    echo "</tr>\n";
    $i++;
  }
  echo "</table>\n";
  $bx->box_body_end();
  $bx->box_end();
  echo "</table>\n";
}
?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>
