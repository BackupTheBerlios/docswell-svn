<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Christian Schmidt (chriscs@cs.tu-berlin.de)
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

page_open(array("sess" => "DocsWell_Session",
                "auth" => "DocsWell_Auth",
                "perm" => "DocsWell_Perm"));

require("header.inc");

$bx = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if (!$perm->have_perm("editor") && (!$perm->have_perm("admin"))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {

  $bx->box_begin();
  $bx->box_title($t->translate("Insert new language"));
  $bx->box_body_begin();

// Eine neue Sprache soll in die DB geschrieben werden
if ($status == 'insert_new') {
	// Eingaben ueberpruefen
	if (! $sprache) {
		$error_ar = $t->translate("Please enter a new language").". (".__LINE__.")";
	} else {
		$db->query ("SELECT * FROM SPRACHEDEF WHERE SPRACHE='$sprache'");
		if ( $db->next_record()) {
			$error_ar = $t->translate("This language already exists").". (".__LINE__.")";
		} else {
			$query = "INSERT INTO SPRACHEDEF (SPRACHE) VALUES ('$sprache')";
			$db->query ($query);
			$neuesprache = $t->translate("Done successfully");
		}
	}
}

// ##########################################
// # Entweder ganz frisch auf dieser Seite oder Fehler bei der Angabe
// ##########################################
        if ((! $status) || ($error_ar)) { ?>
	<form action="<?php $sess->purl("insert_sprache.php") ?>" method="post">
		<input type="hidden" name="status" value="insert_new">
		<TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD align="right"><B><?php echo $t->translate("Language"); ?>:</B></TD>
                        <TD colspan="2">
                          <input type="text" name="sprache" size="30" value="<?php echo $sprache ?>">
			  <?php if ($error_ar): echo "<BR><font color=\"#AA0000\"> ".$t->translate("Error").": ".$error_ar."</font>"; endif; ?>
                        </TD>
                      </TR>
                      <TR>
                        <TD vAlign=top align=right>&nbsp;</TD>
                        <TD>
                          <input type="submit" name="Button" value="<?php echo $t->translate("Send"); ?>">
                        </TD>
                      </TR>
		    </TBODY>
		</TABLE>
	</form>
<?php }
  // #################### Zweite Seite (Eintrag wurde in die DB geschrieben) ############################################ 
      elseif ($neuesprache) { ?>
                <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD>
				<?php echo $neuesprache; ?>
                        </TD>
                   </TR>
                   </TBODY>
                </TABLE>
<?php
  }
  $bx->box_body_end();
  $bx->box_end();
}
?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>
