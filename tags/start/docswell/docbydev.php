<?php

######################################################################
# DocsWell: Document Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001,2002 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#		 Christian Schmidt (schmidt@mallux.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Shows docs created or mantained by a given author
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

$bx = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->

<?php


// $iter is a variable for printing the Top Statistics in steps of 10 docs
if (!isset($iter)) $iter=0;
$iter*=10;

// We need to know the total number of docs inserted for this author

$db->query("SELECT COUNT(*) FROM AUTOR_DOKUMENT ad, DOKUMENT d, KATEGORIE k WHERE ad.AUTOR_ID='$developer' AND ad.DOKUMENT_ID=d.id AND d.status!='D' AND d.KATEGORIE=k.ID");
$db->next_record();
$cnt = $db->f("COUNT(*)");
$numiter = ($cnt/10);


$columns = " distinct a.TITEL AS titel, a.BESCHREIBUNG as beschreibung, a.COUNTER AS downloads, a.SPRACHE, f.SPRACHE as sprache, a.ERSTELLUNGSDATUM as erdatum, a.AENDERUNGSDATUM as aendatum, a.TYP, a.ID as id, d.NAME as TypName, a.BEWERTUNG AS bewertung, a.BEWVONANZP as bewvonanzpand, c.NAME as KategorieName, a.KATEGORIE as KATID, e.VORNAME as AutorVorname, e.NACHNAME as AutorName ";
$tables = "DOKUMENT a, FORMAT b, KATEGORIE c, TYPDEF d, AUTOR e, SPRACHEDEF f, AUTOR_DOKUMENT g";
$where = " a.STATUS!='D' AND a.ID = b.DOKUID and a.TYP = d.ID and g.AUTOR_ID=$developer AND g.AUTOR_ID = e.ID AND g.DOKUMENT_ID=a.ID AND a.TYP=d.ID and a.KATEGORIE = c.ID AND a.SPRACHE=f.ID";

  switch ($by) {      
    case "Category":
      $order = "KategorieName ASC, a.AENDERUNGSDATUM DESC, ID DESC";
      break;        
    case "Author":
      $order = "AutorName ASC, a.AENDERUNGSDATUM DESC, ID DESC";
      break;        
    case "Date":
      $order = "a.AENDERUNGSDATUM DESC, ID DESC";
      break;    
    case "Name":
      $order = "a.TITEL ASC, a.AENDERUNGSDATUM DESC, a.ID DESC";
      break;         
    case "Typ":
      $order = "TypName ASC, a.AENDERUNGSDATUM DESC, ID DESC";
      break;    
    default:
      $order = "a.AENDERUNGSDATUM DESC, ID DESC";
      break;
  }

$limit = "$iter,10";

$sort = "($cnt) ".$t->translate("sorted by").": "
."<a href=\"".$sess->url("docbydev.php").$sess->add_query(array("developer" => $developer, "by" => "Date"))."\">".$t->translate("Date")."</a>"
//." | <a href=\"".$sess->url("docbydev.php").$sess->add_query(array("developer" => $developer, "by" => "Author"))."\">".$t->translate("Author")."</a>"
." | <a href=\"".$sess->url("docbydev.php").$sess->add_query(array("developer" => $developer, "by" => "Category"))."\">".$t->translate("Category")."</a>"
." | <a href=\"".$sess->self_url().$sess->add_query(array("developer" => $developer, "by" => "Typ"))."\">".$t->translate("Type")."</a>\n"
." | <a href=\"".$sess->self_url().$sess->add_query(array("developer" => $developer, "by" => "Name"))."\">".$t->translate("Title")."</a>\n";
$bs->box_strip($sort);

if (!empty($developer)) {

   $query = "SELECT $columns FROM $tables WHERE $where ORDER BY $order LIMIT $limit";
   //echo $query;
   doccat($query,$t->translate("Author").": ",$iter+1, "Author");

   if ($numiter > 1) {
     $url = "docbydev.php";
     $urlquery = array("developer" => $developer, "email" => $email, "by" => $by);
     show_more ($iter,$numiter,$url,$urlquery);
   }
}
?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>




