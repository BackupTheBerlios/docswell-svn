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
# Type administration
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

$bx = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
?>

<!-- content -->
<?php
if (($config_perm_admtype != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admtype))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {

  $bx->box_begin();
  $bx->box_title($t->translate("Document Type Administration"));
  $bx->box_body_begin();

			          // Insert a new Type

  $bs->box_strip($t->translate("Insert Type"));
  echo "<form action=\"".$sess->url("instyp.php")."\" method=\"POST\">\n";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("New Type")." (100):</td><td width=70%><input type=\"TEXT\" name=\"type\" size=40 maxlength=100>\n";
  echo "<tr><td align=right>".$t->translate("Description")." (255):</td><td><input type=\"TEXT\" name=\"description\" size=40 maxlength=255>\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Insert")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";


				          // Rename Type

  $bs->box_strip($t->translate("Rename Type"));
  echo "<form action=\"".$sess->url("instyp.php")."\" method=\"POST\">\n";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Type").":</td><td width=70%>\n";
  echo "<select name=\"type\">\n";
  type("");     // We select the first one to avoid having a blank line
  echo "</select></td></tr>\n";
  echo "<tr><td align=right>".$t->translate("New Type Name")." (100):</td><td><input type=\"TEXT\" name=\"new_type\" size=40 maxlength=100>\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Rename")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";

				          // Change Type description

  $bs->box_strip($t->translate("Change Type Description"));
  echo "<form action=\"".$sess->url("instyp.php")."\" method=\"POST\">\n";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Type").":</td><td width=70%>\n";
  echo "<select name=\"type\">\n";
  type("");     // We select the first one to avoid having a blank line
  echo "</select></td></tr>\n";
  echo "<tr><td align=right>".$t->translate("New Type Description")." (255):</td><td><input type=\"TEXT\" name=\"new_description\" size=40 maxlength=255>\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Change")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";

					  // Delete Type

  $bs->box_strip($t->translate("Delete Type"));
  echo "<form action=\"".$sess->url("instyp.php")."\" method=\"POST\">\n";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Type").":</td><td width=70%>\n";
  echo "<select name=\"type\">\n";
  type("");     // We select the first one to avoid having a blank line
  echo "</select></td></tr>\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<input type=\"hidden\" name=\"del_type\" value=\"warning\">\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Delete")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
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
