<?php

######################################################################
# DocsWell: Software Announcement & Retrieval System
# ================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://sourcewell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# This file contains the form for searching
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

$bx = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php

  $bx->box_begin();
  $bx->box_title($t->translate("Advanced Search"));
  $bx->box_body_begin();
?>
  <form action="<?php $sess->purl("docsearch.php") ?>" method="POST">
  <table border=0 align=center cellspacing=0 cellpadding=3>
   <tr>
      <TD align="right"><B><?php echo $t->translate("Search for"); ?>:</B></TD>
      <TD colspan="2"><input type="text" name="search" size="30" value="<?php echo $search ?>"></TD>
   </TR>
   <TR>
      <TD align=right><B><?php echo $t->translate("Language"); ?>:</B></TD>
      <TD><select name="Sprache">
         <option value="-1"><?php echo $t->translate("all"); ?></option>
         <?php //############################# Sprachen holen ##################################
            $query = "SELECT * FROM SPRACHEDEF ORDER BY SPRACHE ASC";
            $db->query($query);
            while($db->next_record()) {
               $Sid = $db->f("ID");
               echo "<option value=\"".$Sid."\"";
               if (($Sprache) && ($Sprache == $Sid)): echo " selected "; endif;
               echo ">".$t->translate($db->f("SPRACHE"))."</option>\n";                                 
            }
         ?>
         </select>
      </TD>
      <TD></TD>
   </TR>
   <TR>
      <TD align=right><B><?php echo $t->translate("Type"); ?>:</B></TD>
      <TD><select name="typ">
         <option value="-1"><?php echo $t->translate("all"); ?></option>
         <?php //############################# Dokumenttypen holen ##################################
            $query = "SELECT * FROM TYPDEF ORDER BY NAME ASC";
            $db->query($query);
            while($db->next_record()) {
               $Tid = $db->f("ID");
               echo "<option value=\"".$Tid."\"";
               if (($typ) && ($typ == $Tid)): echo " selected "; endif;
               echo ">".$t->translate($db->f("NAME"))."</option>\n";                                 
            }
         ?>
         </select>
      </TD>
   </TR>
   <TR>
      <TD align="right"><B><?php echo $t->translate("Format"); ?>:</B><BR></TD>
      <TD><select name="format">
         <option value="-1"><?php echo $t->translate("all"); ?></option>
         <?php //############################# Dokumentformate holen ##################################
            $query = "SELECT * FROM FORMATDEF ORDER BY NAME ASC";
            $db->query($query);
            while($db->next_record()) {
               echo "<option value=\"".$db->f("ID")."\"";
               if (($format) && ($format == $db->f("ID"))): echo " selected "; endif;
               echo ">".$db->f("NAME")."</option>\n";                                 
            }
         ?>
         </select>
      </TD>
      <TD></TD>
   </TR>
   <!--
   <TR>
      <TD align=right><B><?php echo $t->translate("Category");  ?>:</B></TD>
      <TD><select name="kategorie">
         <option value="-1" selected><?php echo $t->translate("all"); ?></option>
         <?php //############################# Kategorien holen ##################################
            $query = "SELECT * FROM KATEGORIE ORDER BY NAME ASC";
            $db->query($query);
            while($db->next_record()) {
               echo "<option value=\"".$db->f("ID")."\"";
               echo ">".$t->translate($db->f("NAME"))."</option>\n";
            }
         ?>
         </select>
      </TD>
      <TD></TD>
   </TR>
   //-->
   <TR>
      <TD align=right valign="top"><B><?php echo $t->translate("Category");  ?>:</B></TD>
      <TD><input type="submit" name="select_cat" value="<?php echo $t->translate("Select category");  ?>">
	<?php      
	    if ($category) {
      	            $dbKat = new DB_DocsWell;
		    $cat_path = "";
		    $dbt = new DB_DocsWell;
		    $dbt->query("SELECT * FROM KATEGORIE WHERE ID=".$category);
		    //echo "------>".$db->f("KATID");
		    $dbt->next_record();
		    $parent = $dbt->f("PARENT_ID");
		    $pfad = array();
		    while ($parent != 1) {
			array_unshift ($pfad,$dbt->f("NAME"));
			$dbt->query("SELECT * FROM KATEGORIE WHERE ID=$parent");
			$dbt->next_record();
			$parent = $dbt->f("PARENT_ID");
		    }
		    array_unshift ($pfad,$dbt->f("NAME"));
		    $counter =0;
		    $anz = count ($pfad);
		    foreach ($pfad as $onestep) {
		      $counter++;
		      if ($counter == $anz) {
			$dbKat->query("SELECT * FROM KATEGORIE WHERE NAME='$onestep'");
			$dbKat->next_record();
			$cat_path .= " :: <a href=\"".$sess->url("docbycat.php").$sess->add_query(array("category" => $dbKat->f("ID")))."\">".$t->translate($onestep)."</a>";
		      } else 
			$cat_path .= " :: ".$t->translate($onestep)." ";
		    }
		    $cat_path = substr ($cat_path,3);  
		    echo "<BR>".$cat_path;
		    echo "<input type=\"hidden\" name=\"kategorie\" value=\"$category\">";
	    }
	?>      
      </TD>
      <TD></TD>
   </TR>
   <TR>
      <TD align=right><B><?php echo $t->translate("Author"); ?>:</B></TD>
      <TD><select name="Autor">
         <option value="-1" selected><?php echo $t->translate("all"); ?></option>
         <?php //############################# Autoren holen ##################################
            $query = "SELECT * FROM AUTOR ORDER BY NACHNAME ASC";
            $db->query($query);
            while($db->next_record()) {
               echo "<option value=\"".$db->f("ID")."\"";
               if (($Autor) && ($Autor == $db->f("ID"))): echo " selected "; endif;
               echo ">".$db->f("NACHNAME");
               if ($db->f("VORNAME") != "") echo ", ".$db->f("VORNAME");
               if ($db->f("EMAIL") != "") echo " &lt;".$db->f("EMAIL")."&gt;";
               echo "</option>\n";
            }   
         ?>
      </select>
      </TD>
      <TD></TD>
   </TR>
   <TR>
      <TD align=right>&nbsp;</TD>
      <TD><input type="submit" name="Button" value="<?php  echo $t->translate("Send"); ?>"></TD>
   </TR>
</TABLE>
</form>
<?php
  $bx->box_body_end();
  $bx->box_end();?>
  
<!-- end content -->

<?php
require("footer.inc");
@page_close();
?>
