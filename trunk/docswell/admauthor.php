<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ====================================================================
#
# Copyright (c) 2002 by
#			Christian Schmidt (schmidt@mallux.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Author administration
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

$bx = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
?>

<!-- content -->
<?php
if (($config_perm_admtype != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admtype))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {


  //######################################### Einfügren eines neuen Autors
  if ($mode == 1) {
	// Eingaben ueberpruefen
	if (! $nachname) {
		$error .= " - ".$t->translate("Please enter a last name")." (".__LINE__.")<br>";
	}
	if (! $error) {
		$db->query ("SELECT * FROM AUTOR WHERE VORNAME='$vorname' AND NACHNAME='$nachname' AND EMAIL='$email'");
                if ( $db->next_record() ) {
			$error .= " - ".$t->translate("This author already exists").". (".__LINE__.")<br>";
		}
		else {
			$query = "INSERT INTO AUTOR (VORNAME,NACHNAME,EMAIL) VALUES ('$vorname','$nachname','$email')";
			$db->query ($query);
			$error = " - ".$t->translate("Done successfully")."<br>";
		}
	}
  }


  //######################################### Umbenennen eines Autors
  if ($mode == 2) {
	// Eingaben ueberpruefen
	if (! $nachname) {
		$error .= " - ".$t->translate("Please enter a last name")." (".__LINE__.")<br>";
	}
	if (! $error) {
		$db->query ("SELECT * FROM AUTOR WHERE VORNAME='$vorname' AND NACHNAME='$nachname'");
                if ( $db->next_record() ) {
			$error .= " - ".$t->translate("This author already exists").". (".__LINE__.")<br>";
		}
		else {
			$query = "UPDATE AUTOR SET VORNAME='$vorname', NACHNAME='$nachname' WHERE ID=$author_id";
			$db->query ($query);
			$error = " - ".$t->translate("Done successfully")."<br>";
		}
	}
  }

  //######################################### E-Mail eines Autors ändern
  if ($mode == 3) {
	$db->query ("SELECT * FROM AUTOR WHERE EMAIL='$email'");
        if (($db->next_record()) && ($email) ) {
		$error .= " - ".$t->translate("This email already exists").". (".__LINE__.")<br>";
	}
	else {
		$query = "UPDATE AUTOR SET EMAIL='$email' WHERE ID=$author_id";
		$db->query ($query);
		$error = " - ".$t->translate("Done successfully")."<br>";
		unset ($email);
	}
  }

  //######################################### Autor löschen
  if ($mode == 4) {
	$db->query ("SELECT DOKUMENT.ID FROM DOKUMENT, AUTOR_DOKUMENT WHERE AUTOR_DOKUMENT.AUTOR_ID=$author_id AND AUTOR_DOKUMENT.DOKUMENT_ID=DOKUMENT.ID AND DOKUMENT.STATUS<>'D'");
        if ($db->next_record()) {
		$error .= " - ".$t->translate("Can not delete author because there are still active documents from this author");
		$error .= " (".$db->num_rows().")<br>";
	}
	else {
		$query = "DELETE FROM AUTOR WHERE ID=$author_id";
		$db->query ($query);
		$error = " - ".$t->translate("Done successfully")."<br>";
	}
  }


  $bx->box_begin();
  $bx->box_title($t->translate("Author Administration"));
  $bx->box_body_begin();

  if ($error) {
	$be->box_full($t->translate("Error"), $error);
  }

			          // Insert a new Author

  $bs->box_strip($t->translate("Insert Author"));
  echo "<form action=\"".$sess->url($PHP_SELF)."\" method=\"POST\">\n";
  echo "<input type=\"hidden\" name=\"mode\" value=\"1\">";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Last name")." (100):</td><td width=70%><input type=\"TEXT\" name=\"nachname\" size=40 maxlength=100 value=\"$nachname\"></td></tr>\n";
  echo "<tr><td align=right width=30%>".$t->translate("First name")." (100):</td><td width=70%><input type=\"TEXT\" name=\"vorname\" size=40 maxlength=100 value=\"$vorname\"></td></tr>\n";
  echo "<tr><td align=right width=30%>".$t->translate("E-Mail")." (100):</td><td width=70%><input type=\"TEXT\" name=\"email\" size=40 maxlength=100 value=\"$email\"></td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Insert")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";


				          // Change Author

  $bs->box_strip($t->translate("Change author"));
  echo "<form action=\"".$sess->url($PHP_SELF)."\" method=\"POST\">\n";
  echo "<input type=\"hidden\" name=\"mode\" value=\"2\">";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Author").":</td><td width=70%>\n";
  echo "<select name=\"author_id\" size=\"5\">\n";
  authors("");     // We select the first one to avoid having a blank line
  echo "</select></td></tr>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Last name")." (100):</td><td width=70%><input type=\"TEXT\" name=\"nachname\" size=40 maxlength=100 value=\"$nachname\"></td></tr>\n";
  echo "<tr><td align=right width=30%>".$t->translate("First name")." (100):</td><td width=70%><input type=\"TEXT\" name=\"vorname\" size=40 maxlength=100 value=\"$vorname\"></td></tr>\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Rename")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";

				          // Change authors email

  $bs->box_strip($t->translate("Change author e-mail"));
  echo "<form action=\"".$sess->url($PHP_SELF)."\" method=\"POST\">\n";
  echo "<input type=\"hidden\" name=\"mode\" value=\"3\">";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Author").":</td><td width=70%>\n";
  echo "<select name=\"author_id\" size=\"5\">\n";
  authors("");     // We select the first one to avoid having a blank line
  echo "</select></td></tr>\n";
  echo "<tr><td align=right>".$t->translate("New e-mail")." (100):</td><td><input type=\"TEXT\" name=\"email\" size=40 maxlength=100>\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Change")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";

					  // Delete author

  $bs->box_strip($t->translate("Delete author"));
  echo "<form action=\"".$sess->url("$PHP_SELF")."\" method=\"POST\" name=\"del\">\n";
  echo "<input type=\"hidden\" name=\"mode\" value=\"4\">";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Author").":</td><td width=70%>\n";
  echo "<select name=\"author_id\" size=\"5\">\n";
  authors("");     // We select the first one to avoid having a blank line
  echo "</select></td></tr>\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"button\" value=\"".$t->translate("Delete")."\" onclick=\"test = confirm('".$t->translate("Delete entry?")."'); if (test==true) document.del.submit();\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  $bx->box_body_end();
  $bx->box_end();
}
?>

<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>


