<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ====================================================================
#
# Copyright (c) 2001,2002 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#                Christian Schmidt (schmidt@mallux.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Category administration
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
if (($config_perm_admcat != "all") && (!isset($perm) || !$perm->have_perm($config_perm_admcat))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {

  $bx->box_begin();
  $bx->box_title($t->translate("Category Administration"));
  $bx->box_body_begin();

			          // Insert a new Category

  $bs->box_strip($t->translate("Insert Category"));
  echo "<form action=\"".$sess->url("inscat.php")."\" method=\"POST\">\n";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  ?>
                   <TR>
        	                <TD align="right" valign="top"><B><?php echo $t->translate("Category") ?>:</B></TD>
          	              	<TD>
  				<a href="categories.php?mode=6"><?php echo $t->translate("Select category") ?></a><br>
   				<?php //############################# Kategorien holen ##################################
  				      if ($category && $mode==1 && $category!=1) {
  					$db->query("SELECT * FROM KATEGORIE WHERE ID=".$category);
  					$db->next_record();
  					$parent = $db->f("PARENT_ID");
  					$pfad = array();
					while ($parent != 1) {
						array_unshift ($pfad,$t->translate($db->f("NAME")));
						$db->query("SELECT * FROM KATEGORIE WHERE ID=$parent");
						$db->next_record();
						$parent = $db->f("PARENT_ID");
					}
  					array_unshift ($pfad,$t->translate($db->f("NAME")));
  					foreach ($pfad as $onestep) {
  						$cat_path .= " :: ".$onestep;
  					}
					$cat_path = substr ($cat_path,3);  
					echo $cat_path;
  				      } elseif (($category == 1) && ($mode==1)) {
  				      	echo $t->translate("Root");
  				      }
  				      if ($mode==1) echo "<input type=\"hidden\" name=\"ref_cat\" value=\"".$category."\">";
  				      if (($cnt > 0) && ($mode ==1)) {
  				      	echo "<br><font color=\"#990000\"><b>".$t->translate("Attention").": </b></font><br>";
  				      	echo $cnt." ".$t->translate("documents can not be accessed after inserting a new category here.")."<br>";
  				      }
  				?>	
  				</TD>
          	            </TR>
<?php 
  echo "<tr><td align=right width=30%>".$t->translate("New Category")." (100):</td><td width=70%><input category=\"TEXT\" name=\"category\" size=40 maxlength=100>\n";
  //echo "<tr><td align=right>".$t->translate("Description")." (255):</td><td><input type=\"TEXT\" name=\"description\" size=40 maxlength=255>\n";
  //echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Insert")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";


				          // Rename Category

  $bs->box_strip($t->translate("Rename Category"));
  echo "<form action=\"".$sess->url("inscat.php")."\" method=\"POST\">\n";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  ?>
  	                    <TR>
          	                <TD align="right" valign="top" width="20%"><B><?php echo $t->translate("Category") ?>:</B></TD>
          	              	<TD width="70%">
  				<a href="categories.php?mode=7"><?php echo $t->translate("Select category") ?></a><br>
   				<?php //############################# Kategorien holen ##################################
  				      if ($category && $mode==2 && $category!=1) {
  					$db->query("SELECT * FROM KATEGORIE WHERE ID=".$category);
  					$db->next_record();
  					$parent = $db->f("PARENT_ID");
  					$pfad = array();
					while ($parent != 1) {
						if (! $act_cat) $act_cat = $t->translate($db->f("NAME"));
						array_unshift ($pfad,$t->translate($db->f("NAME")));
						$db->query("SELECT * FROM KATEGORIE WHERE ID=$parent");
						$db->next_record();
						$parent = $db->f("PARENT_ID");
					}
  					array_unshift ($pfad,$t->translate($db->f("NAME")));
					if (! $act_cat) $act_cat = $t->translate($db->f("NAME"));
  					foreach ($pfad as $onestep)
  						$cat_path .= " :: ".$onestep;
					$cat_path = substr ($cat_path,3);  
					echo $cat_path;
					echo "<br>";
  				      } elseif (($category == 1) && ($mode==2)) {
  				      	echo $t->translate("Root");
  				      }
  				      if (($category > 1) && ($mode==2)) {
  				      	echo "<input type=\"hidden\" name=\"category\" value=\"".$category."\">";
   				        //if ($mode==2) echo "<input type=\"hidden\" name=\"ref_cat\" value=\"".$category."\">";
				      } elseif ($mode == 2) {  				      	
				      	echo "<br><font color=\"#990000\">".$t->translate("Can not rename root")."</font>";
				      }
  				?>	
  				<?php if ($error_ar["category"]): echo "<BR><font color=\"#AA0000\">".
          	                        $error_ar["category"]."</font>"; endif; ?>		
  				</TD>
          	            </TR>
<?php 
  echo "<tr><td align=right width=\"30%\">".$t->translate("New Category Name")." (100):</td><td><input type=\"TEXT\" name=\"new_category\" size=40 maxlength=100 value=\"";	
  if (($mode == 2) && ($category > 1)) 
	echo $act_cat;
  echo "\">\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Rename")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";

				          // Change Category description
   /*
  $bs->box_strip($t->translate("Change Category Description"));
  echo "<form action=\"".$sess->url("inscat.php")."\" method=\"POST\">\n";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30%>".$t->translate("Category").":</td><td width=70%>\n";
  echo "<select name=\"category\">\n";
  category("");     // We select the first one to avoid having a blank line
  echo "</select></td></tr>\n";
  echo "<tr><td align=right>".$t->translate("New Category Description")." (255):</td><td><input type=\"TEXT\" name=\"new_description\" size=40 maxlength=255>\n";
  echo "</td></tr>\n";
  echo "<tr><td>&nbsp;</td>\n";
  echo "<td><input type=\"submit\" value=\"".$t->translate("Change")."\">";
  echo "</td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  echo "<BR>\n";
  */
					  // Delete Category

  $bs->box_strip($t->translate("Delete Category"));
  echo "<form action=\"".$sess->url("inscat.php")."\" method=\"POST\">\n";
  echo "<table border=0 cellspacing=0 cellpadding=3 width=100%>\n";
  echo "<tr><td align=right width=30% valign=top><b>".$t->translate("Category").":</b></td>\n"; ?>
          	              	<TD width="70%">
  				<a href="categories.php?mode=8"><?php echo $t->translate("Select category") ?></a><br>
   				<?php //############################# Kategorien holen ##################################
  				      if ($category>1 && $mode==3) {
  					$db->query("SELECT * FROM KATEGORIE WHERE ID=".$category);
  					$db->next_record();
  					$parent = $db->f("PARENT_ID");
  					$pfad = array();
					while ($parent != 1) {
						array_unshift ($pfad,$t->translate($db->f("NAME")));
						$db->query("SELECT * FROM KATEGORIE WHERE ID=$parent");
						$db->next_record();
						$parent = $db->f("PARENT_ID");
					}
  					array_unshift ($pfad,$t->translate($db->f("NAME")));
  					foreach ($pfad as $onestep) 
  						$cat_path .= " :: ".$onestep;
				        $cat_path = substr ($cat_path,3);  
					echo $cat_path;					
  				      } elseif (($category == 1) && ($mode==3)) {
  				      	echo $t->translate("Root");
  				      }
				      echo "<br>";
				      if (($mode == 3) && ($category==1)) {  				      	
  				      	echo "<br><font color=\"#990000\"><b>".$t->translate("Attention").": </b></font><br>";
  				      	echo $t->translate("Can not delete root")."<br>";

				      }

  				      if ($mode==3) echo "<input type=\"hidden\" name=\"category\" value=\"".$category."\">";
  				      if ($cnt > 0 && $mode ==3) {
  				      	echo "<br><font color=\"#990000\"><b>".$t->translate("Attention").": </b></font><br>";
  				      	echo $cnt." ".$t->translate("documents can not be accessed after deleting this category.")."<br>";
				      } 
 				      if ($mode == 3) {
					$db->query("SELECT COUNT(*) as anz FROM KATEGORIE WHERE PARENT_ID=$category");
					$db->next_record();
					$childs = $db->f("anz");
					if ($childs > 0) {
	  				      	echo "<br><font color=\"#990000\"><b>".$t->translate("Attention").": </b></font><br>";
	  				      	echo $childs." ".$t->translate("categories can not be accessed after deleting this category.")."<br>";				
					}
  				      }
  				?>	
  				</TD>
   <?php
  /*
  echo "<td width=70%><select name=\"category\">\n";
  category("");     // We select the first one to avoid having a blank line
  echo "</select></td></tr>\n";
  echo "</td></tr>\n";
  */
  echo "<tr><td>&nbsp;</td>\n";
  echo "<input type=\"hidden\" name=\"del_category\" value=\"warning\">\n";
  echo "<td>";
  if ($mode==3 && $category > 1) 
  echo "<input type=\"submit\" value=\"".$t->translate("Delete")."\">";
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