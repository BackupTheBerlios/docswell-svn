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
# Insert author 
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

require("./include/prepend.php3");

page_open(array("sess" => "DocsWell_Session",
                "auth" => "DocsWell_Auth",
                "perm" => "DocsWell_Perm"));

require("./include/header.inc");

$bx = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if ($perm->have_perm("user_pending")) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
  $auth->logout();
} else {

  $bx->box_begin();
  $bx->box_title($t->translate("Insert new author"));
  $bx->box_body_begin();

// Ein neuer Typ soll in die DB geschrieben werden
if ($status == 'insert_new') {
	// Eingaben ueberpruefen
	if (! $nachname) {
		$error_ar["nachname"] = $t->translate("Please enter a last name")." (".__LINE__.")";
	}
	if (! $error_ar) {
		$db->query ("SELECT * FROM AUTOR WHERE VORNAME='$vorname' AND NACHNAME='$nachname' AND EMAIL='$email'");
                if ( $db->next_record() ) {
			$neuerautor = $t->translate("This author already exists").". (".__LINE__.")";
		}
		else {
			$query = "INSERT INTO AUTOR (VORNAME,NACHNAME,EMAIL) VALUES ('$vorname','$nachname','$email')";
			$db->query ($query);
			$neuerautor = $t->translate("Done successfully");
		}
	}
}


// ##########################################
// # Entweder ganz frisch auf dieser Seite oder Fehler bei der Angabe
// ##########################################
        if ((! $status) || ($error_ar)) { ?>
	<form action="<?php $sess->purl("insert_autor.php") ?>" method="post">
		<input type="hidden" name="status" value="insert_new">
		<TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD align="right"><B><?php echo $t->translate("Last name"); ?>:</B></TD>
                        <TD>
                          <input type="text" name="nachname" size="30" value="<?php echo $nachname ?>">
                          <?php if ($error_ar["nachname"]): echo "<BR><font color=\"#AA0000\"> ".$t->translate("Error").": ".$error_ar["nachname"]."
                                                               </font>"; endif; ?>
                        </TD>
                      </TR>
                    <TR>
                        <TD align="right"><B><?php echo $t->translate("First name"); ?>:</B></TD>
                        <TD>
                          <input type="text" name="vorname" size="30" value="<?php echo $vorname ?>">
                        </TD>
                      </TR>
                    <TR>
                        <TD align="right"><B><?php echo $t->translate("E-Mail"); ?>:</B></TD>
                        <TD>
                          <input type="text" name="email" size="30" value="<?php echo $email ?>">
                        </TD>
                      </TR>
                      <TR>
                        <TD vAlign=top>&nbsp;</TD>
                        <TD>
                          <input type="submit" name="Button" value="<?php echo $t->translate("Send"); ?>">
                        </TD>
                      </TR>
		    </TBODY>
		</TABLE>
	</form>
<?php }
  // #################### Zweite Seite (Eintrag wurde in die DB geschrieben) ############################################ 
      elseif ($neuerautor) { ?>
                <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD valign="top"><B><?php echo $neuerautor ?></B></TD>
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
require("./include/footer.inc");
@page_close();
?>
