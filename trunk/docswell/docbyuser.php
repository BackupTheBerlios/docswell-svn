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
# Shows docs inserted by user
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

$bx = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
?>

<!-- content -->
<?php

if (!isset($usr) || empty($usr)) {
  if (isset($auth)) {
    $usr = $auth->auth["uname"];
  } else {
    $usr = "";
  }
}

// $iter is a variable for printing the Top Statistics in steps of 10 apps
if (!isset($iter)) $iter=0;
$iter*=10;

$columns = "COUNT(*)";
$from = "DOKUMENT,auth_user, KATEGORIE k";
$where = "DOKUMENT.ANGELEGTVON=auth_user.username AND DOKUMENT.ANGELEGTVON=\"$usr\" AND DOKUMENT.KATEGORIE=k.ID";
if (!isset($auth) || empty($auth->auth["perm"]) || !$perm->have_perm("editor")) {
  $where .= " AND DOKUMENT.STATUS != 'D'";
}

// We need to know the total number of docs inserted by the user
$db->query("SELECT $columns FROM $from WHERE $where");
// echo "SELECT $columns FROM $from WHERE $where <br><br>";
$db->next_record();
$cnt = $db->f("COUNT(*)");
$numiter = ($cnt/10);

$columns = " DISTINCT a.ID as id, a.TITEL AS titel, a.BESCHREIBUNG as beschreibung, a.COUNTER AS downloads, a.SPRACHE as sprache, a.KATEGORIE AS KatID, a.AENDERUNGSDATUM as aendatum, a.TYP as DocType, a.ANGELEGTVON, c.NAME as KategorieName, d.NAME as TypName, a.BILD as BILD, a.BILD_REFERENZ as BILD_REFERENZ, a.STATUS ";
$tables = "DOKUMENT a, FORMAT b, KATEGORIE c, TYPDEF d, auth_user";
$where2 = "a.ANGELEGTVON=auth_user.username AND a.ANGELEGTVON=\"$usr\"";
$where = "a.ID = b.DOKUID and a.KATEGORIE = c.ID and a.TYP = d.ID AND ".$where2;
//echo $usr;

if (!isset($auth) || empty($auth->auth["perm"]) || !$perm->have_perm("editor")) {
  $where .= " AND a.STATUS != 'D'";
}
#$where .= " GROUP BY a.COUNTER";

switch ($by) {
  case "Author":
    $order = "AutorName ASC, a.AENDERUNGSDATUM DESC, a.ID DESC";
    break;       
  case "Name":
    $order = "a.TITEL ASC, a.AENDERUNGSDATUM DESC, a.ID DESC";
    break;   
  case "Category":
    $order = "KategorieName ASC, a.AENDERUNGSDATUM DESC, ID DESC";
    break;         
  case "Typ":
    $order = "TypName ASC, a.AENDERUNGSDATUM DESC, ID DESC";
    break; 
  case "Date":
  default:
    $by = "Date";
    $order = "a.AENDERUNGSDATUM DESC, a.ID DESC";
    break;
}

$limit = "$iter,10";

$sort = "($cnt) ".$t->translate("sorted by").": "
."<a href=\"".$sess->self_url().$sess->add_query(array("usr" => $usr, "by" => "Date"))."\">".$t->translate("Date")."</a>"
// ." | <a href=\"".$sess->self_url().$sess->add_query(array("usr" => $usr, "by" => "Author"))."\">".$t->translate("Author")."</a>"
." | <a href=\"".$sess->self_url().$sess->add_query(array("usr" => $usr, "by" => "Category"))."\">".$t->translate("Category")."</a>\n"
." | <a href=\"".$sess->self_url().$sess->add_query(array("usr" => $usr, "by" => "Typ"))."\">".$t->translate("Type")."</a>\n"
." | <a href=\"".$sess->self_url().$sess->add_query(array("usr" => $usr, "by" => "Name"))."\">".$t->translate("Title")."</a>\n";

$bs->box_strip($sort);

$query = "SELECT $columns FROM $tables WHERE $where ORDER BY $order LIMIT $limit";
//echo $query." <br><br>";
docupdate($query);

$db->query($query);
if ($db->num_rows() < 1) {
  $msg = $t->translate("No Docs of User exist").".";
  $bx->box_full($t->translate("Docs of User"), $msg);
}

if ($numiter > 1) {
  $url = "docbyuser.php";
  $urlquery = array("usr" => $usr, "by" => $by);
  show_more ($iter,$numiter,$url,$urlquery);
}
?>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
