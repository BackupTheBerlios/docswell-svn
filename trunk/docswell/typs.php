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
# This file indexes the sections and categories available in our system
# It also shows the number of apps in each one
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

$bx = new box("95%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
$columns = "ID,NAME,KOMMENTAR";
$tables = "TYPDEF";

$db->query("SELECT DISTINCT $columns FROM $tables ");
?>
<table border=0 align=center cellspacing=0 cellpadding=0 width=100%>
<tr><td width=40% valign=top>
<?php
  $bx->box_begin();
  $bx->box_title($t->translate("Types"));
  $bx->box_body_begin();
  while($db->next_record()) {
    $db2 = new DB_DocsWell;
    $columns = "COUNT(*) AS Coun";
    $tables = "DOKUMENT a, KATEGORIE b";
    $where = " a.TYP =".$db->f("ID")." and a.STATUS!='D' and a.KATEGORIE=b.ID";
    $num = "";
    $db2->query("SELECT $columns FROM $tables WHERE $where");
    $db2->next_record(); 
    #echo  $db2->f("Coun")." ".$db2->f("COUNT(*)")."<br><br>";
     
    $cnt = $db2->f("Coun"); 
    $num = "[".sprintf("%03d",$cnt)."]";

    echo "$num <a href=\"".$sess->url("docbytyp.php").$sess->add_query(array("typ" => $db->f("ID")))."\">".$t->translate($db->f("NAME"))." - ".$db->f("KOMMENTAR")."<br></a>\n";
  }
  $bx->box_body_end();
  $bx->box_end();
?>

</td>
</tr>
</table>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
