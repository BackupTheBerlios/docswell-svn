<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#                Florian Dorrer (dorrer@mallux.de)
#
# BerliOS Docswell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Index file which shows the recent docs
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
$be = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
?>

<!-- content -->
<table BORDER=0 CELLSPACING=10 CELLPADDING=0 WIDTH="100%" >
<tr width=80% valign=top><td>
<?php
  if (!isset($by)) $by = "Nothing";
  if (!isset($cnt)) $cnt = 0;
  $prev_cnt = $cnt + $config_show_docsperpage;
  if ($cnt >= $config_show_docsperpage) $next_cnt = $cnt - $config_show_docsperpage;
  else $next_cnt = 0;
 
  $columns = " distinct a.TITEL AS titel, a.BESCHREIBUNG as beschreibung, a.COUNTER AS downloads, a.SPRACHE as sprache, a.KATEGORIE AS KatID, a.AENDERUNGSDATUM as aendatum, a.TYP as DocType, a.ID as id, a.ANGELEGTVON, c.NAME as KategorieName, d.NAME as TypName, a.BILD as BILD, a.BILD_REFERENZ as BILD_REFERENZ ";
  $tables = "DOKUMENT a, FORMAT b, KATEGORIE c, TYPDEF d ";

  $where = "a.ID = b.DOKUID and a.KATEGORIE = c.ID and a.TYP = d.ID AND a.STATUS ='A' ";
  switch ($by) {      
    case "Category":
      $order = "KategorieName ASC, a.AENDERUNGSDATUM DESC, a.ID DESC";
      break;        
    case "Author":
      $order = "AutorName ASC, a.AENDERUNGSDATUM DESC, a.ID DESC";
      break;        
    case "Date":
      $order = "a.AENDERUNGSDATUM DESC, a.ID DESC";
      break;    
    case "Name":
      $order = "a.TITEL ASC, a.AENDERUNGSDATUM DESC, a.ID DESC";
      break;        
    default:
      $where = "a.ID = b.DOKUID and a.KATEGORIE = c.ID and a.TYP = d.ID AND a.STATUS = 'A' ";
      $order = "a.AENDERUNGSDATUM DESC, a.ID DESC";
      break;
  }

  $limit = $cnt.",".$config_show_docsperpage;

  $sort = $t->translate("sorted by").": "
  ."<a href=\"".$sess->self_url().$sess->add_query(array("by" => "Date"))."\">".$t->translate("Date")."</a>"
  //." | <a href=\"".$sess->self_url().$sess->add_query(array("by" => "Author"))."\">".$t->translate("Author")."</a>"
  ." | <a href=\"".$sess->self_url().$sess->add_query(array("by" => "Category"))."\">".$t->translate("Category")."</a>\n"
  ." | <a href=\"".$sess->self_url().$sess->add_query(array("by" => "Name"))."\">".$t->translate("Title")."</a>\n";


  $nav = "<a href=\"".$sess->self_url().$sess->add_query(array("cnt" => $prev_cnt, "by" => $by))."\">&lt;&nbsp;".$t->translate("previous")." $config_show_docsperpage ".$t->translate("Docs")."</a>"
  ." | <a href=\"".$sess->self_url().$sess->add_query(array("by" => "Date"))."\">".$t->translate("Top")."</a>";

  if ($cnt > 0) {
    $nav .= " | <a href=\"".$sess->self_url().$sess->add_query(array("cnt" => $next_cnt, "by" => $by))."\">".$t->translate("next")." $config_show_docsperpage&nbsp;".$t->translate("Docs")."&nbsp;&gt;</a>";
  } else {
    $nav .= " | ".$t->translate("next")." $config_show_docsperpage&nbsp;".$t->translate("Docs")."&nbsp;&gt;";
  }

  $query = "SELECT $columns FROM $tables WHERE $where ORDER BY $order LIMIT $limit";

  $query_cnt = "SELECT $columns FROM $tables WHERE $where";

  $db->query ($query_cnt);
  $anz = $db->num_rows ();

  $bs->box_strip("($anz) ".$sort);

  $bs->box_strip($nav);

#echo "$query\n";
  docdat($query);
  $bs->box_strip($nav);
  $bs->box_strip($sort);
?>
</td><td width=20%>
<?php

  // Recent docs of each type
  doctyp();
?>
</td></tr>
</table>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>