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
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# This file lists the developers of the apps in alphabetical order
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

require "header.inc";

$bx = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
?>

<!-- content -->
<?php

if (!isset($by) || empty($by)) {
  $by = "A%";
}

$alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L",
      "M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$msg = "[ ";

  while (list(, $ltr) = each($alphabet)) {
    $msg .= "<a href=\"".$sess->url("developers.php").$sess->add_query(array("by" => $ltr."%"))."\">$ltr</a>&nbsp;| ";
  }

  $msg .= "<a href=\"".$sess->url("developers.php").$sess->add_query(array("by" => "%"))."\">".$t->translate("All")."</a>&nbsp;| ";
  $msg .= "<a href=\"".$sess->url("developers.php").$sess->add_query(array("by" => ""))."\">".$t->translate("Unknown")."</a>&nbsp;]";

$bs->box_strip($msg);
$columns = "ID, VORNAME, NACHNAME, EMAIL";
$tables = "AUTOR";
$where = "NACHNAME LIKE '$by'";
$order = "NACHNAME ASC";
$db->query("SELECT DISTINCT $columns FROM $tables WHERE $where ORDER BY $order");

  $bx->box_begin();
  $title = $t->translate("Authors");
  if (($by) AND ($by != "%")) $title .= ": ".substr($by,0,1);  
  if ($by == "%") $title .= ": ".$t->translate("All");
  $bx->box_title($title);
  $bx->box_body_begin();      
?>
<table border=0 align=center cellspacing=1 cellpadding=1 width=100%>
<?php
  echo "<tr><td><b>".$t->translate("No").".</b></td><td><b>#&nbsp;".$t->translate("Docs")."</b></td><td><b>".$t->translate("Names")."</b></td><td><b>".$t->translate("E-Mail")."</b></td></tr>\n";
  $i = 1;
  while($db->next_record()) {
    $db2 = new DB_DocsWell;
    $columns = "COUNT(*)";
    $tables = "DOKUMENT d, AUTOR_DOKUMENT ad, KATEGORIE k";
    $where = "ad.AUTOR_ID=".$db->f("ID")." 
	      AND ad.DOKUMENT_ID=d.id
              AND d.STATUS!='D'
	      AND d.KATEGORIE=k.ID";
    $num = "";
    $db2->query("SELECT $columns FROM $tables WHERE $where");
  
    $db2->next_record();
    $cnt = $db2->f("COUNT(*)");
    if ($cnt > 0) {
        $num = "[".sprintf("%03d",$cnt)."]";
        
      echo "<tr><td>".sprintf("%d",$i)."</td>\n";
      $nachname = $db->f("NACHNAME");
      if ( empty($nachname)) {
        echo "<td><a href=\"".$sess->url("docbydev.php").$sess->add_query(array("developer" => $db->f("ID")))."\">$num</a></td>\n";
        echo "<td>".$t->translate("Unknown")."</td>\n";
        echo "<td>&nbsp;</td>\n";
      } else {
        echo "<td><a href=\"".$sess->url("docbydev.php").$sess->add_query(array("developer" => $db->f("ID")))."\">$num</a></td>\n";
        echo "<td>".$db->f("NACHNAME");
	if ($db->f("VORNAME")) echo ", ".$db->f("VORNAME");
	echo "</td>\n";
        $email = $db->f("EMAIL");
        if (!empty($email)) {
           echo "<td>&lt;<a href=\"mailto:".$db->f("EMAIL")."\">".ereg_replace("@"," at ",htmlentities($db->f("EMAIL")))."</a>&gt;</td>\n";
        } else {
           echo "<td>&nbsp;</td>\n";
        }
        echo "</tr>\n";
      }
      $i++;
    }
  }
  echo "</table>\n";
  $bx->box_body_end();
  $bx->box_end();
?>
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>


