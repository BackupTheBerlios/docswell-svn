<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Christian Schmidt (chriscs@cs.tu-berlin.de)
#                Florian Dorrer (kingsize@cs.tu-berlin.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Form for deleting docs
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
?>

<!-- content -->
<?php
if (($perm->have_perm("editor")) || ($perm->have_perm("admin"))) {

  $bx->box_begin();
  $bx->box_title($t->translate("Delete an entry"));
  $bx->box_body_begin();
	
		##  Dokument soll gelöscht werden, hier die Datenüberprüfung
		if ($status == 'do_new') {
		    if ($Del) {
			$db->query("UPDATE DOKUMENT SET STATUS='D' WHERE ID=$ID");
			$newentry = $t->translate("Entry status set to deleted");
		}
 	}
 	
	## doc soll gelöscht werden
	if (($status == 'edit_new') or ($error_ar)) {  
	        $db->query("SELECT * FROM DOKUMENT WHERE ID=$ID");
		$db->next_record();
		$eintrag[ANGELEGTVON] 		= $db->f("ANGELEGTVON");
		$eintrag[SPRACHE]     		= $db->f("SPRACHE");
		$eintrag[TYP]			= $db->f("TYP");
		$eintrag[KATEGORIE]		= $db->f("KATEGORIE");
		$eintrag[TITEL]			= $db->f("TITEL");
		$eintrag[BESCHREIBUNG]		= $db->f("BESCHREIBUNG");
		$eintrag[ERSTELLUNGSDATUM]	= $db->f("ERSTELLUNGSDATUM");
		$eintrag[AENDERUNGSDATUM]	= $db->f("AENDERUNGSDATUM");
?>
		<form action="<?php $sess->purl("delete_entry.php") ?>" method="post">
			<input type="hidden" name="status" value="do_new">
			<?php if ($ID) { echo "<input type=\"hidden\" name=\"ID\" value=\"$ID\">"; } ?>
			<TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
	                    <TBODY>
	                    <TR>
	                        <TD align=right><B><?php echo $t->translate("From user") ?>:</B></TD>
	                        <TD>
		                    <?php echo $eintrag[ANGELEGTVON] ?>
				</TD>                    
	                    <TR>
	                        <TD align=right><B><?php echo $t->translate("Language") ?>:</B></TD>
	                        <TD>
	                          <select name="Sprache">
	                    <?php //############################# Sprachen holen ##################################
	                    	        if ($Sprache) { $eintrag[SPRACHE] = $Sprache; }
	                    		$db->query ("SELECT * FROM SPRACHEDEF ORDER BY SPRACHE ASC");
				  
					  while ($db->next_record()) {		      				  
	                            	  	echo "<option value=\"".$db->f("ID")."\"";
	                            	  	
						if (($eintrag[SPRACHE]) && ($eintrag[SPRACHE] == $db->f("ID"))): echo " selected "; endif;
						echo ">".$t->translate($db->f("SPRACHE"))."</option>\n";                            	  
	                            	  }
	                     ?>
	                          </select>
				</TD>
				<TD>
	                       		&nbsp;
	                        </TD>
	                      </TR>
	                      <TR>
	                        <TD align=right><B><?php echo $t->translate("Type") ?>:</B></TD>
	                      	<TD>
	                          <select name="typ">
	                    <?php //############################# Dokumenttypen holen ##################################
	                                if ($typ) { $eintrag[TYP] = $typ; }
	                    		$db->query("SELECT * FROM TYPDEF ORDER BY NAME ASC");                    
					  
					  while ($db->next_record()) {
			      				  
	                            	  	echo "<option value=\"".$db->f("ID")."\"";
						if (($eintrag[TYP]) && ($eintrag[TYP] == $db->f("ID"))): echo " selected "; endif;
						echo ">".$t->translate($db->f("NAME"))."</option>\n";
	                            	  
	                            	  }
	                     ?>
	                          </select>
				</TD>
				<TD>
	                           &nbsp;
				</TD>
	                      </TR>
	                    <TR>
        	                <TD align="right" valign="top"><B><?php echo $t->translate("Category") ?>:</B></TD>
        	              	<TD>
 				<?php //############################# Kategorien holen ##################################
				      if ($eintrag[KATEGORIE]) {
		      	            	$dbKat = new DB_DocsWell;
				    	$cat_path = "";
					    $dbt = new DB_DocsWell;
					    $dbt->query("SELECT * FROM KATEGORIE WHERE ID=".$eintrag[KATEGORIE]);
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
  					      $cat_path .= " :: ".$t->translate($onestep)." ";
					    }
					    $cat_path = substr ($cat_path,3);  
					    echo $cat_path;

					}
				?>	
				<?php if ($error_ar["category"]): echo "<BR><font color=\"#AA0000\">".
        	                        $error_ar["category"]."</font>"; endif; ?>		
				</TD>
				<TD></TD>
        	            </TR>	                      
	                      <TR>
	                        <TD align="right" valign="top" ><B><?php echo $t->translate("Format") ?>:</B><BR><font class="small">(<?php echo $t->translate("multiselection possible") ?>)</font></TD>
	                        <TD>
	                          <select name="format[]" size="5" multiple>
	                    <?php //############################# Dokumentformate holen ##################################
	                    		$db->query("SELECT * FROM FORMATDEF ORDER BY NAME ASC");
					  $db2 = new DB_DocsWell;
					  while ($db->next_record()) {
	                            	  	echo "<option value=\"".$db->f("ID")."\" "; 
	                            	  	if (! $format ) {
		                         		$db2->query("SELECT * FROM FORMAT WHERE DOKUID=$ID");   	  	
							while ($db2->next_record()) if ($db2->f("FORMATID") == $db->f("ID")): echo " selected "; endif;
						} else {
							for ($i=0;$i<count($format);$i++) if ($format[$i] == $db->f("ID")): echo " selected "; endif;
						} 
						echo ">".$db->f("NAME")."</option>\n";
	                            	  }
	                     ?>
	                          </select>
	                          <?php if ($error_ar["format"]): echo "<br><font color=\"#AA0000\">".$t->translate("Error").": ".
	                                $error_ar["format"]."</font>"; endif; ?>
				</TD>
				<TD>
	                           &nbsp;
				</TD>
	                      </TR>
	                    <TR>
	                        <TD align=right><B><?php echo $t->translate("Category") ?>:</B></TD>
	                      	<TD>
	                          <select name="kategorie">
	                    <?php //############################# Kategorien holen ##################################
	                    	        if ($kategorie) { $eintrag[KATEGORIE] = $kategorie; }
	                                $db->query("SELECT * FROM KATEGORIE ORDER BY NAME ASC");
	
	                                  while ($db->next_record()) {
	
	                                        echo "<option value=\"".$db->f("ID")."\"";
	                                        if (($eintrag[KATEGORIE]) && ($eintrag[KATEGORIE] == $db->f("ID"))): echo " selected "; endif;
	                                        echo ">".$t->translate($db->f("NAME"))."</option>\n";
	
	                                  }
	                     ?>
	                          </select>
				</TD>
				<TD>
	                           &nbsp;
				</TD>
	                    </TR>
	                    <TR>
	                        <TD align=right><B><?php echo $t->translate("Author") ?>:</B><BR><font class="small">(<?php echo $t->translate("multiselection possible") ?>)</font></TD>
	                      	<TD>
	                          <select name="mautoren[]" size="5" multiple>
	                    <?php //############################# Autoren holen ##################################
	                    		$db->query("SELECT * FROM AUTOR ORDER BY NACHNAME ASC");
					  $db2 = new DB_DocsWell;
					  while ($db->next_record()) {
	                            	  	echo "<option value=\"".$db->f("ID")."\" "; 
	                            	  	if (! $mautoren ) {
		                         		$db2->query("SELECT * FROM AUTOR_DOKUMENT WHERE DOKUMENT_ID=$ID");   	  	
							while ($db2->next_record()) if ($db2->f("AUTOR_ID") == $db->f("ID")): echo " selected "; endif;
						} else {
							for ($i=0;$i<count($mautoren);$i++) if ($mautoren[$i] == $db->f("ID")): echo " selected "; endif;
						} 
						echo ">".$db->f("NACHNAME").", ".$db->f("VORNAME")."</option>\n";
	                            	  }
	                     ?>
	                          </select>
				</TD>
				<TD>
	                           &nbsp;
				</TD>
	                      </TR>
	                    <TR>
	                        <TD align="right" valign="top"><B><?php echo $t->translate("Title") ?>:</B></TD>
	                        <TD colspan="2">
	                          <?php echo $eintrag[TITEL] ?>
	                        </TD>
	                      </TR>
	                    <TR>
	                        <TD align="right" width="25%" valign="top"><B><?php echo $t->translate("Description") ?>:</B></TD>
	                        <TD width="75%" colspan="2">
	                          <?php echo $eintrag[BESCHREIBUNG] ?>
	                        </TD>
	                      </TR>
	                    <TR>
	                        <TD align="right" valign="top"><B><?php echo $t->translate("Created") ?>:</TD>
                        <?php 
			      $ejahr = substr($eintrag[ERSTELLUNGSDATUM],0,4);
			      $emonat = substr($eintrag[ERSTELLUNGSDATUM],5,2);
			      $etag = substr($eintrag[ERSTELLUNGSDATUM],8,2);
			      $estunde = substr($eintrag[ERSTELLUNGSDATUM],11,2);
			      $eminute = substr($eintrag[ERSTELLUNGSDATUM],14,2);
			      $esekunde = substr($eintrag[ERSTELLUNGSDATUM],17,2);
                              $edatum = "$etag.$emonat.$ejahr"; 
			      $ezeit = "$estunde:$eminute:$esekunde";
                              if ($erstellungsdatum) : $edatum = $erstellungsdatum; endif; 
                              if ($erstellungszeit) : $ezeit = $erstellungszeit; endif; ?>
	                        <TD valign="top" colspan="2"><?php echo ($edatum)." ".$t->translate("at")." ".$ezeit." ".$t->translate("o'clock"); ?> 				
	                        </TD>
	                      </TR>
	                    <TR>
	                        <TD align=right><B><?php echo $t->translate("Last updated"); ?>:</TD>
                        	<?php 
			      $ajahr = substr($eintrag[AENDERUNGSDATUM],0,4);
			      $amonat = substr($eintrag[AENDERUNGSDATUM],5,2);
			      $atag = substr($eintrag[AENDERUNGSDATUM],8,2);
			      $astunde = substr($eintrag[AENDERUNGSDATUM],11,2);
			      $aminute = substr($eintrag[AENDERUNGSDATUM],14,2);
			      $asekunde = substr($eintrag[AENDERUNGSDATUM],17,2);
                              $adatum = "$atag.$amonat.$ajahr";
			      $azeit = "$astunde:$aminute:$asekunde"; 
                       	      if ($aenderungsdatum) : $adatum = $aenderungsdatum; endif;
			      if ($aenderungszeit) : $azeit = $aenderungszeit; endif;
				?>	
	                        <TD valign="top" colspan="2"><?php echo $adatum." ".$t->translate("at")." ".$azeit." ".$t->translate("o'clock"); ?>
	                        </TD>
	                      </TR>
	                      <TR>
	                        <TD vAlign=top align=right>&nbsp;</TD>
	                        <TD><br>
	                          <input type="submit" name="Del" value="<?php echo $t->translate("Delete") ?>">
	                        </TD>
	                      </TR></TBODY>
			</TABLE>
		</form>
<?php
 	}
 	
// ##########################################
// # Anzeige der ersten Eingabemaske
// ##########################################
        if (! $status) { ?>
	<form action="<?php $sess->purl("delete_entry.php") ?>" method="post">
		<input type="hidden" name="status" value="edit_new">
		<TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Delete entry") ?>:</B></TD>
                        <TD>
                          <select name="ID" size="20">
                    <?php //############################# Alle neuen Dokumenteneinträge holen ##################################
                    		$db->query("SELECT *, DATE_FORMAT(AENDERUNGSDATUM,'%d.%m.%Y') AS fdate FROM DOKUMENT WHERE STATUS !='D' ORDER BY TITEL ASC");
			  
				  while ($db->next_record()) {	
                            	  	echo "<option value=\"".$db->f("ID")."\"";
					echo ">".$db->f("fdate")." - ".$db->f("TITEL") ."</option>\n";                            	  
                            	  }
                     ?>
                          </select>
			</TD>
                      </TR>
                      <TR>
                        <TD vAlign=top align=right>&nbsp;</TD>
                        <TD>
                          <input type="submit" name="Button" value="<?php echo $t->translate("View entry") ?>">
                        </TD>
                      </TR>
		</TABLE>
	</form>
<?php }
  // #################### Dritte Seite (Eintrag wurde in die DB geschrieben) ############################################ 
      elseif ($newentry) { ?>
                <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $newentry ?></B></TD>
                        <TD colspan="2">&nbsp;</TD>
                   </TR>
                </TABLE>
<?php } ?>

<?php
  $bx->box_body_end();
  $bx->box_end();
} else {
  $bx->box_full($t->translate("Error"), $t->translate("Access denied"));
  $auth->logout();
}
?>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
