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
# Insert format
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
  $bx->box_title($t->translate("Insert new format"));
  $bx->box_body_begin();

// Ein neuer Typ soll in die DB geschrieben werden
if ($status == 'insert_new') {
	// Eingaben ueberpruefen
	if (! $format) {
		$error_ar["format"] = $t->translate("Please insert a new format")." (".__LINE__.")";
	}
	if (! $beschreibung) {
		$error_ar["beschreibung"] = $t->translate("Please enter a description")." (".__LINE__.")";
	}
	if (! $error_ar) {
		$db->query("SELECT NAME FROM FORMATDEF WHERE NAME='$format'");
                if ( $db->next_record() ) {
			$error_ar["format"] = $t->translate("This format already exists").". (".__LINE__.")";
		} else {
			$query = "INSERT INTO FORMATDEF (NAME, KOMMENTAR) VALUES ('$format','$beschreibung')";
			$db->query ($query);
			$neuesformat =$t->translate("Done successfully");
		}
	}
}


// ##########################################
// # Entweder ganz frisch auf dieser Seite oder Fehler bei der Angabe
// ##########################################
        if ((! $status) || ($error_ar)) { ?>
	<form action="<?php $sess->purl("insert_format.php") ?>" method="post">
		<input type="hidden" name="status" value="insert_new">
		<TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD align="right"><B><?php echo $t->translate("Format"); ?>:</B></TD>
                        <TD>
                          <input type="text" name="format" size="30" value="<?php echo $format ?>">
                          <?php if ($error_ar["format"]): echo "<BR><font color=\"#AA0000\"> ".$t->translate("Error").": ".$error_ar["format"]."
                                                               </font>"; endif; ?>
                        </TD>
                      </TR>
                    <TR>
                        <TD align=right width="25%"><B><?php echo $t->translate("Description"); ?>:</B></TD>
                        <TD width="75%">
                          <textarea name="beschreibung" wrap="PHYSICAL" cols="50" rows="5"><?php echo $beschreibung ?></textarea>
                          <?php if ($error_ar["beschreibung"]): echo "<BR><font color=\"#AA0000\"> ".$t->translate("Error").": ".
                                $error_ar["beschreibung"]."</font>"; endif; ?>
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
      elseif ($neuesformat) { ?>
                <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD valign="top"><B><?php echo $neuesformat ?></B></TD>
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
