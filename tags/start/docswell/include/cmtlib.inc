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
# Library with the functions for comments and faq
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

function cmtform($query) {
  global $bx, $t, $db, $sess;

  $db->query($query);
  $db->next_record();
  $bx->box_begin();
  $bx->box_title($t->translate("Your Comment about")." \"".$db->f("TITEL")."\"");
  $bx->box_body_begin();
  echo "<form action=\"cmtins.php\" method=\"POST\">\n";
  echo "<table border=0 align=center cellspacing=0 cellpadding=3>\n";
  echo "<tr><td align=right>".$t->translate("Subject")." (128):</td><td><input type=\"TEXT\" name=\"subject\" size=40 maxlength=128></td></tr>\n";
  echo "<tr><td align=right>".$t->translate("Comment")." (*):</td><td><textarea cols=40 rows=7 name=\"text\" wrap=\"virtual\" maxlength=255></textarea></td></tr>\n";
  echo "<tr><td align=right>&nbsp;</td><td><input type=\"Submit\" value=\"".$t->translate("Send")."\"></td>\n";
  echo "<input type=\"hidden\" name=\"id\" value=\"".$db->f("ID")."\">\n";
  echo "</form>\n";
  echo "</tr></table>\n";
  $bx->box_body_end();
  $bx->box_end();
}


function cmtshow($query) {
  global $t, $bx, $db;

  # $dbTest = new DB_DocsWell;
  $db->query($query);
  while($db->next_record()) {
    $bx->box_begin();
    $bx->box_title($t->translate("Comment").": ".$db->f("SUBJECT"));
    $bx->box_body_begin();
    $timestamp = mktimestamp($db->f("DATUM"));
    echo "<b><a href=\"mailto:".$db->f("email_usr")."\">".$db->f("AUTOR")."</a> - ".timestr($timestamp)."</b>\n";
    echo "<p>".$db->f("KOMMENTAR")."\n";
    $bx->box_body_end();
    $bx->box_end();
  }
}

function cmtmod($query) {
  global $t, $bx, $db, $sess;

  $db->query($query);
  $db->next_record();
  $bx->box_begin();
  $bx->box_title($t->translate("Comment about")." \"".$db->f("TITEL")."\"");
  $bx->box_body_begin();
  echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
  echo "<table border=0 align=center cellspacing=0 cellpadding=3>\n";
  echo "<tr><td align=right>".$t->translate("Subject")." (128):</td><td><input type=\"TEXT\" name=\"subject\" size=40 maxlength=128 value=\"".$db->f("SUBJECT")."\"></td></tr>\n";
  echo "<tr><td align=right>".$t->translate("Comment")." (*):</td><td>
<textarea cols=40 rows=7 name=\"text\" wrap=\"virtual\" maxlength=255>".$db->f("KOMMENTAR")."</textarea></td></tr>\n";
  echo "<input type=\"hidden\" name=\"id\" value=\"".$db->f("ID")."\">\n";
  echo "<input type=\"hidden\" name=\"modification\" value=\"".$db->f("DATUM")."\">\n";
  echo "<input type=\"hidden\" name=\"modify\" value=\"2\">\n";
  echo "<tr><td align=right>&nbsp;</td><td><input type=\"Submit\" value=\"".$t->translate("Modify")."\"></td>\n";
  echo "</form>\n";
  echo "</tr></table>\n";
  $bx->box_body_end();
  $bx->box_end();
}

function faqform() {
  global $sess, $bx, $t;

  $bx->box_begin();
  $bx->box_title($t->translate("New Frequently Asked Question"));
  $bx->box_body_begin();
  echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
  echo "<table border=0 align=center cellspacing=0 cellpadding=3>\n";
  echo "<tr><td align=right>".$t->translate("Question")." (*):</td><td><textarea cols=40 rows=4 name=\"question\" wrap=\"virtual\" maxlength=1024></textarea></td></tr>\n";
  echo "<tr><td align=right>".$t->translate("Answer")." (*):</td><td><textarea cols=40 rows=7 name=\"answer\" wrap=\"virtual\" maxlength=4096></textarea></td></tr>\n";
  echo "<tr><td align=right>&nbsp;</td><td><input type=\"Submit\" value=\"".$t->translate("Create")."\"></td>\n";
  echo "<input type=\"hidden\" name=\"create\" value=\"2\">\n";
  echo "</tr></form>\n";
  echo "</table>\n";
  $bx->box_end();
}


function faqshow($db) {
  global $t, $bx;

  $bx->box_begin();
  $bx->box_title("<B>".$t->translate("Question")."</B>: ".$db->f("question"));
  $bx->box_body_begin();
  echo "<B>".$t->translate("Answer")."</B>: ".$db->f("answer")."\n";
  $bx->box_body_end();
  $bx->box_end();
}


function faqmod($db) {
  global $sess, $t, $bx;

  $bx->box_begin();
  $bx->box_title($t->translate("Modify a Frequently Asked Question"));
  $bx->box_body_begin();
  echo "<form action=\"".$sess->self_url()."\" method=\"POST\">\n";
  echo "<table border=0 align=center cellspacing=0 cellpadding=3>\n";
  echo "<tr><td align=right>".$t->translate("Question")." (*):</td><td><textarea cols=60 rows=4 name=\"question\" wrap=\"virtual\" maxlength=1024>".$db->f("question")."</textarea></td></tr>\n";
  echo "<tr><td align=right>".$t->translate("Answer")." (*):</td><td><textarea cols=60 rows=7 name=\"answer\" wrap=\"virtual\" maxlength=4096>".$db->f("answer")."</textarea></td></tr>\n";
  echo "<input type=\"hidden\" name=\"faqid\" value=\"".$db->f("faqid")."\">\n";
  echo "<input type=\"hidden\" name=\"modify\" value=\"2\">\n";
  echo "<tr><td align=right>&nbsp;</td><td><input type=\"Submit\" value=\"".$t->translate("Modify")."\"></td>\n";
  echo "</tr></form>\n";
  echo "</table>\n";
  $bx->box_body_end();
  $bx->box_end();
}

?>
