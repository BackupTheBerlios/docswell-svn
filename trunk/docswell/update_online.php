<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001, 2002 by
#                Christian Schmidt (schmidt@mallux.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# This is the form for inserting docs
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

if (($category) && (! $kategorie)) $kategorie = $category;

$bx = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if (($perm->have_perm("editor")) || ($perm->have_perm("admin")) || ($perm->have_perm("user"))) {

  $bx->box_begin();
  if ($BNew) 
  	$bx->box_title($t->translate("Insert new document from existing entry"));
  else 
	$bx->box_title($t->translate("Update an existing document"));
  $bx->box_body_begin();

		## Neues Dokument soll eingefügt werden, hier die Datenüberprüfung
		if ($status == 'do_new') {
		   //if ($Button == "OK") {
			// Eingaben ueberpruefen
		        if (! $titel) {
				$error_ar["titel"] = $t->translate("Error").": ".$t->translate("Please enter the titel of the document")." (".__LINE__.")";
				// echo $error_ar["titel"];
	        	}
	        	if (($titel) && (strlen($titel) < 2)) {
	                	$error_ar["titel"] = $t->translate("Error").": ".$t->translate("The titel is to short")." (".__LINE__.")";
				// echo $error_ar["titel"];
			}        
	
		        if (! $beschreibung) {
	                        $error_ar["beschreibung"] = $t->translate("Error").": ".$t->translate("Please enter a description for this document")." (".__LINE__.")";
				// echo $error_ar["beschreibung"];
	                }
	                if (($beschreibung) && (strlen($beschreibung) < 5)) {
	                        $error_ar["beschreibung"] = $t->translate("Error").": ".$t->translate("The description is to short")." (".__LINE__.")";
				// echo $error_ar["beschreibung"];
	                }
	
			if (! $erstellungsdatum) {
				$error_ar["erstellungsdatum"] = $t->translate("Error").": ".$t->translate("Please enter the date of creation")." (".__LINE__.")";
				// echo $error_ar["erstellungsdatum"];
			}
			else {
				list ($etag, $emonat, $ejahr) = split ('[/.-]', $erstellungsdatum);
				if (! (($etag > 0) && ($etag < 32))) {
					$error_ar["erstellungsdatum"] = $t->translate("Error").": ".$t->translate("Wrong day format")." (".__LINE__.")";
				}
	                        if (! (($emonat > 0) && ($emonat < 13))) {
	                                $error_ar["erstellungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong month format")." (".__LINE__.")";
	                        }			
	                        if (! (($ejahr > 1950) && ($ejahr < 3000))) {
	                                $error_ar["erstellungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong year format")." (".__LINE__.")";
	                        }
				// echo $error_ar["erstellungsdatum"]; 
			}

			if (! $erstellungszeit) 
				$error_ar["erstellungsdatum"] = $t->translate("Error").": ".$t->translate("Please enter the time of creation")." (".__LINE__.")";
			else {
				list ($estunde, $eminute, $esekunde) = split ('[/:.-]', $erstellungszeit);
				if (! (($estunde > -1) && ($estunde < 24)))
					$error_ar["erstellungsdatum"] = $t->translate("Error").": ".$t->translate("Wrong hour format")." (".__LINE__.")";
	                        if (! (($eminute > -1) && ($eminute < 60)))
        	                        $error_ar["erstellungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong minute format")." (".__LINE__.")";
	                        if (! (($esekunde > -1) && ($esekunde < 60)))
	                                $error_ar["erstellungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong second format")." (".__LINE__.")";
			}			
	
	                if (! $aenderungsdatum)
	                        $error_ar["aenderungsdatum"] = $t->translate("Error").": ".$t->translate("Please enter the date of last update")." (".__LINE__.")";
	                else {
	                        list ($atag, $amonat, $ajahr) = split ('[/.-]', $aenderungsdatum);
	                        if (! (($atag > 0) && ($atag < 32))) {
	                                $error_ar["aenderungsdatum"] = $t->translate("Error").": ".$t->translate("Wrong day format")." (".__LINE__.")";
	                        }
	                        if (! (($amonat > 0) && ($amonat < 13))) {
	                                $error_ar["aenderungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong month format")." (".__LINE__.")";
	                        }
	                        if (! (($ajahr > 1950) && ($ajahr < 3000))) {
	                                $error_ar["aenderungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong year format")." (".__LINE__.")";
	                        }
	                        // echo $error_ar["aenderungsdatum"];
	                }

			if (! $aenderungszeit)
				$error_ar["aenderungsdatum"] = $t->translate("Error").": ".$t->translate("Please enter the time of modification")." (".__LINE__.")";
			else {
				list ($estunde, $eminute, $esekunde) = split ('[/:.-]', $aenderungszeit);
				if (! (($estunde > -1) && ($estunde < 24))) 
					$error_ar["aenderungsdatum"] = $t->translate("Error").": ".$t->translate("Wrong hour format")." (".__LINE__.")";
        	                if (! (($eminute > -1) && ($eminute < 60))) 
        	                        $error_ar["aenderungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong minute format")." (".__LINE__.")";
        	                if (! (($esekunde > -1) && ($esekunde < 60))) 
					$error_ar["aenderungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong second format")." (".__LINE__.")";
			}

			if (! $format) {
				$error_ar["format"] = $t->translate("Error").": ".$t->translate("Please select at least one format")." (".__LINE__.")";
			}

			if (! $category) {
				$error_ar["category"] = $t->translate("Error").": ".$t->translate("Please select a category")." (".__LINE__.")";
			}

			if (($img_do == 1) && (! empty($new_filename))) {
				if (! ereg ("\.(.{2,4})$", $new_filename, $regs)) { //#### Dateiname überprüfen
					$error_ar["image"] = $t->translate("Error").": ".$t->translate("Wrong file format. Only jpg, gif or png allowed.")." (".__LINE__.")";
				} else {
					srand ((double)microtime());
					$randval = rand();
					$value = time();
					$tnew_filename = $value."_temp.".$regs[1];
					$new_file = dirname($SCRIPT_FILENAME)."/images_docs/".$tnew_filename;
					if (! copy (dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename,$new_file)) 
					$error_ar["image"] = $t->translate("Error").": ".$t->translate("Could not write new file.")." - ".$new_file."(".__LINE__.")";
					else $new_filename=$tnew_filename;
				}
			}

			//echo $mnew_img;
			if (($img_do == 2) && ($new_filename)) { //Bild löschen
				//if (file_exists (dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename)) 
				//	unlink (dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename);
				unset ($new_filename);	
			} elseif (($img_do ==2) && ($vorhandenesbild)) {
				unset ($vorhandenesbild);
			}

			if ((!empty($mnew_img)) && ($mnew_img != "none") && ($img_do == 3)) {
				$old_new_filename = $new_filename;
				if (! ereg ("\.(.{2,4})$", $mnew_img_name, $regs)) { //#### Dateiname überprüfen
					$error_ar["image"] = $t->translate("Error").": ".$t->translate("Wrong file format. Only jpg, gif or png allowed.")." (".__LINE__.")";
	    			} else {
					if (($regs[1] != "jpg") && ($regs[1] != "gif") && ($regs[1] != "png")) 
						$error_ar["image"] = $t->translate("Error").": ".$t->translate("Wrong file format. Only jpg, gif or png allowed.")." (".__LINE__.")";
					else {
						srand ((double)microtime());
						$randval = rand();
						$value = time();
						$new_filename = $value."_temp.".$regs[1];
						$new_file = dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename;
						//echo $new_file;
						//####Sooo Datei übernehmen und umbenennen, aber Dateiendung beibehalten
						if (! copy ($mnew_img,$new_file)) 
							$error_ar["image"] = $t->translate("Error").": ".$t->translate("Could not write new file.")." - ".$new_file."(".__LINE__.")";
						// else {
							//if (file_exists (dirname($SCRIPT_FILENAME)."/images_docs/".$old_new_filename)) 
							//@unlink (dirname($SCRIPT_FILENAME)."/images_docs/".$old_new_filename);
						//}
					}

				}
			} elseif (($img_do == 3) && (empty($mnew_img)) && (!empty($vorhandenesbild))) {
				$delete_img = $new_filename;
				unset ($new_filename);
			} elseif ((empty($mnew_img)) && ($img_do == 3) && (empty($vorhandenesbild))) {
				$error_ar["image"] = $t->translate("Error").": ".$t->translate("Please specify an image")." (".__LINE__.")";
			}
		//} 
 	}
 	
     //####################################### EINGABE der LINKS	
     if ((($status == "do_new") && (! $error_ar) && ($Button != $t->translate("Delete")) ) || ($error_ar2)) { ?>
        <form action="<?php $sess->purl("update_online.php") ?>" method="post">
                <input type="hidden" name="status" value="insert_links">
                <?php if ($ID) { echo "<input type=\"hidden\" name=\"ID\" value=\"$ID\">\n"; } ?>
		<?php if ($new_filename) echo "<input type=\"hidden\" name=\"new_filename\" value=\"$new_filename\">\n"; ?>
		<?php if ($vorhandenesbild) echo "<input type=\"hidden\" name=\"vorhandenesbild\" value=\"$vorhandenesbild\">\n"; ?>
		<?php if ($delete_img) echo "<input type=\"hidden\" name=\"delete_img\" value=\"$delete_img\">\n"; ?>
                <?php if ($BNew) echo "<input type=\"hidden\" name=\"BNew\" value=\"$BNew\">\n";?>
                <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
 		    <?php if ($new_filename) { 
			$size = GetImageSize(dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename);
                	$width = $size[0];
                	$height = $size[1];
                	if ($width > $config_maxwidth) {
                	        $height = round($height / $width * $config_maxwidth);
                	        $width = $config_maxwidth;
                	}
		    ?>
                    <TR><TD colspan="2">&nbsp;</TD></TR>
		    <TR>
			<TD colspan="2" align="center">
				<img src="images_docs/<?php echo $new_filename; ?>" border="0" width="<?php echo $width."\" height=\"".$height."\""; ?> >
			</TD>
		    </TR>
                    <TR><TD colspan="2">&nbsp;</TD></TR>
		   <?php }  elseif ($vorhandenesbild)  {
			$size = GetImageSize(dirname($SCRIPT_FILENAME)."/images_docs/".$vorhandenesbild);
                	$width = $size[0];
                	$height = $size[1];
                	if ($width > $config_maxwidth) {
                	        $height = round($height / $width * $config_maxwidth);
                	        $width = $config_maxwidth;
                	}
		    ?>
                    <TR><TD colspan="2">&nbsp;</TD></TR>
		    <TR>
			<TD colspan="2" align="center">
				<img src="images_docs/<?php echo $vorhandenesbild; ?>" border="0" width="<?php echo $width."\" height=\"".$height."\""; ?> >
			</TD>
		    </TR>
                    <TR><TD colspan="2">&nbsp;</TD></TR>
		   <?php } ?>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Title") ?>:</B></TD>
                        <TD colspan="2">
				<?php echo stripslashes($titel); ?><input type="hidden" name="titel" value="<?php echo urlencode($titel); ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Description") ?>:</B></TD>
                        <TD colspan="2">
				<?php echo stripslashes($beschreibung); ?><input type="hidden" name="beschreibung" value="<?php echo urlencode($beschreibung); ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Created") ?>:</B></TD>
                        <TD colspan="2">
                                <?php //echo $erstellungsdatum;
				      $timestamp = mktime(substr($erstellungszeit,0,2),substr($erstellungszeit,3,2),substr($erstellungszeit,6,2),substr($erstellungsdatum,3,2),substr($erstellungsdatum,0,2),substr($erstellungsdatum,6,4));
 				      echo timestr($timestamp);
    				?>
                                <input type="hidden" name="erstellungsdatum" value="<?php echo $erstellungsdatum; ?>">
				<input type="hidden" name="erstellungszeit" value="<?php echo $erstellungszeit; ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Last updated"); ?>:</B></TD>
                        <TD colspan="2">
                                <?php $timestamp = mktime(substr($aenderungszeit,0,2),substr($aenderungszeit,3,2),substr($aenderungszeit,6,2),substr($aenderungsdatum,3,2),substr($aenderungsdatum,0,2),substr($aenderungsdatum,6,4));
 				      echo timestr($timestamp);
    				?>
                                <input type="hidden" name="aenderungsdatum" value="<?php echo $aenderungsdatum; ?>">
				<input type="hidden" name="aenderungszeit" value="<?php echo $aenderungszeit; ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Language") ?>:</B></TD>
                        <TD colspan="2">
                                <?php
                                $db->query ("SELECT * FROM SPRACHEDEF WHERE ID=$Sprache");
                                $db->next_record();
                                echo $db->f("SPRACHE"); ?>
                                <input type="hidden" name="Sprache" value="<?php echo $Sprache; ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Type") ?>:</B></TD>
                        <TD colspan="2">
                                <?php
                                $db->query ("SELECT * FROM TYPDEF WHERE ID=$typ");
                                $db->next_record();
                                echo $db->f("NAME"); ?>
                                <input type="hidden" name="typ" value="<?php echo $typ; ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php if (count($mautoren) > 1) echo $t->translate("Authors"); else echo $t->translate("Author"); ?>:</B></TD>
                        <TD><?php
				for ($i=0;$i<count($mautoren);$i++) {
 	                $db->query ("SELECT * FROM AUTOR WHERE ID=".$mautoren[$i]);
        	        $db->next_record();
                    echo $db->f("VORNAME")." ".$db->f("NACHNAME");
                    if ($db->f("EMAIL") != "") echo " &lt;".$db->f("EMAIL")."&gt;";
				    echo "<BR>"; ?>
                        	        <input type="hidden" name="mautoren[]" value="<?php echo $mautoren[$i]; ?>">
				       <?php
				} ?>
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Category") ?>:</B></TD>
                        <TD colspan="2">
                                <?php
		      	            $dbKat = new DB_DocsWell;
				    $cat_path = "";
				    $dbt = new DB_DocsWell;
				    $dbt->query("SELECT * FROM KATEGORIE WHERE ID=".$kategorie);
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
				    echo "<input type=\"hidden\" name=\"kategorie\" value=\"$kategorie\">";


                                $db->query("SELECT * FROM KATEGORIE WHERE ID=$kategorie");
                                $db->next_record();
                                echo $t->translate($db->f("NAME")); ?>
                                <input type="hidden" name="kategorie" value="<?php echo $kategorie; ?>">
                        </TD>
                   </TR>

		    <TR><TD colspan="3">&nbsp;</TD></TR>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Format") ?>:</B></TD>
                        <TD colspan="2"><?php echo $t->translate("Please enter a link for each format") ?></TD>
                   </TR>
                   <?php        
			for ($i=0;$i<count($format);$i++) {			
                        	$db->query ("SELECT * FROM FORMATDEF WHERE ID=$format[$i]");
				$db->next_record();
				if ($ID) {
				  $db2 = new DB_DocsWell;
				  $db2->query ("SELECT * FROM FORMAT WHERE DOKUID=$ID AND FORMATID=$format[$i]");
				  $db2->next_record();
				}
		    ?>
                    <TR>
                        <TD align="right"><B><?php echo $db->f("NAME"); ?></B></TD>
                        <TD colspan="2"><input type="text" name="links[]" size="40" 
				 	 value="<?php if ($links[$i]){  echo $links[$i]; $tlink = $links[$i]; } elseif (($ID) && ($db2->f("LINK"))) { echo $db2->f("LINK"); $tlink = $db2->f("LINK"); } else echo "http://"; ?>">
				<?php if ($tlink) 
					echo "<a href=\"$tlink\" target=\"_blank\">Check</a><br>";
				?>
				<input type="hidden" name="format[]" value="<?php echo $format[$i]; ?>"></TD>
                   </TR>
		   <?php } if ($error_ar2) { ?>
			<TR>
			  <TD>&nbsp;</TD>
			  <TD colspan="2">
			  	<?php echo "<font color=\"#AA0000\">".$t->translate("Error").": ".$error_ar2."</font>"; ?>
			  </TD>
			</TR>
		   <?php } ?>			
                      <TR>
                        <TD align="right" valign="top">&nbsp;</TD>
                        <TD>
                          <input type="submit" name="Button" value="<?php echo $t->translate("Send") ?>">
                        </TD>
                      </TR>		    
		   </TBODY>
		</TABLE>
	</form>
<?php } 	

	## Neues aktives doc soll editiert werden
	if ((! $status) or ($error_ar)) {  
	        $db->query ("SELECT * FROM DOKUMENT WHERE ID=$ID");
		$db->next_record();
		$eintrag[ANGELEGTVON] 		= $db->f("ANGELEGTVON");
		$eintrag[SPRACHE]     		= $db->f("SPRACHE");
		$eintrag[TYP]			= $db->f("TYP");
		$eintrag[KATEGORIE]		= $db->f("KATEGORIE");
		$eintrag[TITEL]			= $db->f("TITEL");
		$eintrag[BESCHREIBUNG]		= $db->f("BESCHREIBUNG");
		$eintrag[ERSTELLUNGSDATUM]	= $db->f("ERSTELLUNGSDATUM");
		$eintrag[AENDERUNGSDATUM]	= $db->f("AENDERUNGSDATUM");
		$eintrag[BILD]			= $db->f("BILD");
		$eintrag[BILD_REFERENZ]		= $db->f("BILD_REFERENZ");
?>
		<form action="<?php $sess->purl("update_online.php") ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="status" value="do_new">
			<?php if ($ID) { echo "<input type=\"hidden\" name=\"ID\" value=\"$ID\">"; } ?>
			<input type="hidden" name="User" value="<?php echo $eintrag[ANGELEGTVON] ?>">
			<TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
	                    <TBODY>
	                    <TR>
        	                <TD align="right" valign="top"><B><?php echo $t->translate("Category") ?>:</B></TD>
        	              	<TD valign="top">
 				<?php //############################# Kategorien holen ##################################
				      if ($kategorie) $eintrag[KATEGORIE] = $kategorie; 
	  			      if ($eintrag[KATEGORIE]) {
		      	            	$dbKat = new DB_DocsWell;
				    	$cat_path = "";
					    $dbt = new DB_DocsWell;
					    $dbt->query("SELECT * FROM KATEGORIE WHERE ID=".$eintrag[KATEGORIE]);
					    //echo "------>".$db->f("KATID");
					    $dbt->next_record();
					    $parent = $dbt->f("PARENT_ID");
					    if ($parent) {
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
						    echo "<input type=\"hidden\" name=\"category\" value=\"$eintrag[KATEGORIE]\">";
					     } else echo $t->translate ("Category does not exist");
				     } else echo $t->translate ("Please select"); ?>

				<?php if ($error_ar["category"]): echo "<BR><font color=\"#AA0000\">".
        	                        $error_ar["category"]."</font>"; endif; ?>		
				</TD>
				<TD><a href="categories.php?mode=4&aid=<?php echo $ID ?>"><font size="2"><?php echo $t->translate("Select category") ?></font></a><?php if ($perm->have_perm("admin")) { ?>
        	                   <br><a href="<?php $sess->purl("admcat.php") ?>"><font size="2"><?php echo $t->translate("Insert new category") ?></font></a>
				<?php } ?></TD>
        	            </TR>
	                    <TR>
	                        <TD align="right" valign="top"><B><?php echo $t->translate("Language") ?>:</B></TD>
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
				<TD><?php if ($perm->have_perm("editor") || $perm->have_perm("admin")) { ?>
	                        	<a href="<?php $sess->purl("insert_sprache.php") ?>"><font size="2"><?php echo $t->translate("Insert new language") ?></font></a>
	                        <?php } ?></TD>
	                      </TR>
	                      <TR>
	                        <TD align="right" valign="top"><B><?php echo $t->translate("Type") ?>:</B></TD>
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
				<TD><?php if ($perm->have_perm("editor") || $perm->have_perm("admin")) { ?>
	                           <a href="<?php $sess->purl("insert_typ.php") ?>"><font size="2"><?php echo $t->translate("Insert new type") ?></font></a>
				<?php } ?></TD>
	                      </TR>
	                      <TR>
	                        <TD align="right" valign="top"><B><?php echo $t->translate("Format") ?>:</B><BR><font size="1">(<?php echo $t->translate("multiselection possible") ?>)</font></TD>
	                        <TD>
	                          <select name="format[]" size="10" multiple>
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
	                          <?php if ($error_ar["format"]): echo "<BR><font color=\"#AA0000\">".$t->translate("Error").": ".
	                                $error_ar["format"]."</font>"; endif; ?>
				</TD>
				<TD><?php if ($perm->have_perm("editor") || $perm->have_perm("admin")) { ?>
	                           <a href="<?php $sess->purl("insert_format.php") ?>"><font size="2"><?php echo $t->translate("Insert new format") ?></font></a>
				<?php } ?></TD>
	                      </TR>
	                    <TR>
	                        <TD align=right valign=top><B><?php echo $t->translate("Author") ?>:</B><BR><font size="1">(<?php echo $t->translate("multiselection possible") ?>)</font></TD>
	                      	<TD>
	                          <select name="mautoren[]" size="15" multiple>
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
						echo ">".$db->f("NACHNAME");
               			if ($db->f("VORNAME") != "") echo ", ".$db->f("VORNAME");
               			if ($db->f("EMAIL") != "") echo " &lt;".$db->f("EMAIL")."&gt;";
               			echo "</option>\n";
	                  }
	                  ?>
	                  </select>
				</TD>
				<TD>
	                           <a href="<?php $sess->purl("insert_autor.php") ?>"><font size="2"><?php echo $t->translate("Insert new author") ?></font></a>
				</TD>
	                      </TR>
	                    <TR>
	                        <TD align="right" valign="top"><B><?php echo $t->translate("Title") ?>:</B></TD>
	                        <TD colspan="2">
	                          <input type="text" name="titel" size="30" value="<?php if ($titel) { $eintrag[TITEL] = $titel; } echo stripslashes($eintrag[TITEL]) ?>">
				  <?php if ($error_ar["titel"]): echo "<BR><font color=\"#AA0000\">".$error_ar["titel"]."
								       </font>"; endif; ?>
	                        </TD>
	                      </TR>
	                    <TR>
	                        <TD align="right" valign="top" width="25%"><B><?php echo $t->translate("Description") ?>:</B></TD>
	                        <TD width="75%" colspan="2">
	                          <textarea name="beschreibung" wrap="PHYSICAL" cols="50" rows="10"><?php if ($beschreibung) { $eintrag[BESCHREIBUNG] = $beschreibung; } echo stripslashes($eintrag[BESCHREIBUNG]) ?></textarea>
	                          <?php if ($error_ar["beschreibung"]): echo "<BR><font color=\"#AA0000\"> ".$error_ar["beschreibung"]."</font>"; endif; ?>
	                        </TD>
	                      </TR>
	                    <TR>
	                        <TD align="right" valign="top"><B><?php echo $t->translate("Created") ?>:<br>
	                          </B><font size="1">(DD.MM.YYYY)</font></TD>
                        <?php 
                              //list ($ejahr, $emonat, $etag) = split ('[-]', $eintrag[ERSTELLUNGSDATUM]);  
			      $ejahr = substr($eintrag[ERSTELLUNGSDATUM],0,4);
			      $emonat = substr($eintrag[ERSTELLUNGSDATUM],5,2);
			      $etag = substr($eintrag[ERSTELLUNGSDATUM],8,2);
			      $estunde = substr($eintrag[ERSTELLUNGSDATUM],11,2);
			      $eminute = substr($eintrag[ERSTELLUNGSDATUM],14,2);
			      $esekunde = substr($eintrag[ERSTELLUNGSDATUM],17,2);
                              $edatum = "$etag.$emonat.$ejahr"; 
			      $ezeit = "$estunde:$eminute:$esekunde";
                              if ($erstellungsdatum) : $edatum = $erstellungsdatum; endif; 
                              if ($erstellungszeit) : $ezeit = $erstellungszeit; endif; 
				?>
	                        <TD valign="top" colspan="2">
				  <input type="text" name="erstellungsdatum" maxlength="10" size="10" value="<?php if ($edatum): echo $edatum; else: echo date("d.m.Y"); endif; ?>">
				  <?php echo $t->translate("at") ?>
			          <input type="text" name="erstellungszeit" maxlength="8" size="8" value="<?php if ($ezeit): echo $ezeit; else: echo date("H:i:s"); endif; ?>"> <?php echo $t->translate("o'clock")." ".$t->translate("(hh:mm:ss)"); ?> 				
	                          <?php if ($error_ar["erstellungsdatum"]): echo "<BR><font color=\"#AA0000\"> ".$error_ar["erstellungsdatum"]."</font>"; endif; ?>
	                        </TD>
	                      </TR>
	                    <TR>
	                        <TD align="right" valign="top"><B><?php echo $t->translate("Last updated"); ?>:<br>
	                          </B><font size="1">(DD.MM.YYYY) </font></TD>
                        	<?php $adatum = date("d.m.Y");
                        	      if ($aenderungsdatum) : $adatum = $aenderungsdatum; endif;?>	                          
	                        <TD valign="top" colspan="2">
				  <input type="text" name="aenderungsdatum" maxlength="10" size="10" value="<?php if ($adatum): echo $adatum; else: echo date("d.m.Y"); endif; ?>"> <?php echo $t->translate("at") ?>
			  	  <input type="text" name="aenderungszeit" maxlength="8" size="8" value="<?php if ($aenderungszeit): echo $aenderungszeit; else: echo date("H:i:s");endif; ?>"> <?php echo $t->translate("o'clock")." ".$t->translate("(hh:mm:ss)"); ?>
	                          <?php if ($error_ar["aenderungsdatum"]): echo "<BR><font color=\"#AA0000\"> ".$error_ar["aenderungsdatum"]."</font>"; endif; ?>
	                        </TD>
	                      </TR>
	                      <TR><TD colspan="2">&nbsp;</TD></TR>
		   	      <TR>
	  		        <TD align="right" valign="top"><B><?php echo $t->translate("Image"); ?>:</td>
				<TD colspan="2">
	     			<?php 
				$new_filename = $eintrag[BILD];
				if (($new_filename) && (file_exists(dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename))) { 
					$size = GetImageSize(dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename);
        	        		$width = $size[0];
        	        		$height = $size[1];
                			if ($width > $config_maxwidth) {
                	        	$height = round($height / $width * $config_maxwidth);
                	        	$width = $config_maxwidth;
                			}
					?>
					   <img src="images_docs/<?php echo $new_filename; ?>" border="0" width="<?php echo $width."\" height=\"".$height."\""; ?> >
					   <input type="hidden" name="new_filename" value="<?php echo $new_filename; ?>">
	   	 	      <?php }  elseif ((strlen($eintrag[BILD_REFERENZ]) > 1) && (file_exists(dirname($SCRIPT_FILENAME)."/images_docs/".$eintrag[BILD_REFERENZ]))) {
					$size = GetImageSize(dirname($SCRIPT_FILENAME)."/images_docs/".$eintrag[BILD_REFERENZ]);
        	        		$width = $size[0];
        	        		$height = $size[1];
                			if ($width > $config_maxwidth) {
                	        	$height = round($height / $width * $config_maxwidth);
                	        	$width = $config_maxwidth;
                			}
					?>
					   <img src="images_docs/<?php echo $eintrag[BILD_REFERENZ]; ?>" border="0" width="<?php echo $width."\" height=\"".$height."\""; ?> >
			       <?php } else {
					echo $t->translate("No image");
				    } 
				    if ($error_ar["image"]): echo "<BR><font color=\"#AA0000\">".$error_ar["image"]."</font>"; endif; ?>
				    <br><br>
				    <input type="radio" name="img_do" value="1" checked> <?php echo $t->translate("keep"); ?> <?php if ($new_filename || $eintrag[BILD_REFERENZ]) echo "<input type=\"radio\" name=\"img_do\" value=\"2\"> ".$t->translate("delete"); ?> <input type="radio" name="img_do" value="3"> <?php echo $t->translate("select another one"); ?>:
 				    <br><br> <input type="file" name="mnew_img">
				    <?php
			  	    //############################# vorhandene Bilder holen ##################################
			    	    echo "<br><br>".$t->translate("or take image from document").":<br><br>";
                          	    echo "<select name=\"vorhandenesbild\">\n";
			  	    echo "<option value=\"0\">".$t->translate("Please select")."</option>";
                          	    $db->query("SELECT * FROM DOKUMENT WHERE ((LENGTH(BILD) > 1) OR (LENGTH(BILD_REFERENZ) > 1)) AND STATUS!='D' ORDER BY TITEL ASC");
                          	    while ($db->next_record()) {
	                            	echo "<option value=\"";
				    	if (strlen($db->f("BILD")) > 1) echo $db->f("BILD");
				    	elseif (strlen($db->f("BILD_REFERENZ")) > 1) echo $db->f("BILD_REFERENZ");
				    	echo "\"";
                                    	if (($vorhandenesbild) && (($vorhandenesbild == $db->f("BILD")) || ($vorhandenesbild == $db->f("BILD_REFERENZ")))): echo " selected "; endif;
					if ((! $vorhandenesbild) && ($eintrag[BILD_REFERENZ])&& (($eintrag[BILD_REFERENZ] == $db->f("BILD")) || ($eintrag[BILD_REFERENZ] == $db->f("BILD_REFERENZ")))): echo " selected "; endif;
                                    	echo ">".$db->f("TITEL")."</option>\n";
                          	    }
                          	    echo "</select>\n"; ?>				    

				</TD>
		  	      </TR>
	                      <TR>
	                        <TD vAlign=top align=right>&nbsp;</TD>
	                        <TD>
	                          <input type="submit" name="Button" value="OK"> &nbsp; &nbsp;<input type="submit" name="BNew" value="<?php echo $t->translate("Save as new entry"); ?>"> 
	                        </TD>
	                      </TR></TBODY>
			</TABLE>
		</form>
<?php
 	}
 	
 
 	
	//#############################################################################################
	//### OK, wenn alle Angaben richtig sind, dann ab in die DB damit
	//#############################################################################################

	if (($status == "insert_links") && (! $error_ar) && (! $error_ar2) && (! $newentry)) {
	   // Datum ins richtige Format bringen
	   list ($etag, $emonat, $ejahr) = split ('[/.-]', $erstellungsdatum);
	   list ($estunde, $eminute, $esekunde) = split ('[/:.-]', $erstellungszeit);
	   $erstellungsdatum = "$ejahr-$emonat-$etag $estunde:$eminute:$esekunde";
	   list ($atag, $amonat, $ajahr) = split ('[/.-]', $aenderungsdatum);
   	   list ($astunde, $aminute, $asekunde) = split ('[/:.-]', $aenderungszeit);
	   $aenderungsdatum = "$ajahr-$amonat-$atag $astunde:$aminute:$asekunde";
	   $titel = urldecode($titel);
	   $beschreibung = urldecode($beschreibung);

	   $query = "SELECT max(ID) AS maxid FROM PENDING";
	   $db->query ($query);
           $db->next_record();
           $newid = $db->f("maxid")+1;
	   //echo $newid;

	   if ($new_filename) {
			unset ($vorhandenesbild);
	  		ereg ("\.(.{2,4})$", $new_filename, $regs);
			if ($BNew) $p_filename = $newid."_pending.".$regs[1];
			else $p_filename = $newid."_upd.".$regs[1];
 	 		if (! copy (dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename,dirname($SCRIPT_FILENAME)."/images_docs/".$p_filename)) 
	 			$newentry = $t->translate("Error").": ".$t->translate("Could not write new file.")." - ".$p_filename."(".__LINE__.")";
			else 
				unlink (dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename);
  	   } elseif ($vorhandenesbild) {
	   	 //Nur wenn kein Bild hochgeladen wurde evt. Bild Referer speichern
		unset ($p_filename);
	   } 

	   if ($BNew) {
		   $query = "INSERT INTO PENDING (ID, TITEL, BESCHREIBUNG, ERSTELLUNGSDATUM, AENDERUNGSDATUM, TYP, SPRACHE, KATEGORIE, ANGELEGTVON, BILD, BILD_REFERENZ) ";
	 	   $query .= "VALUES ($newid, '$titel', '$beschreibung', '$erstellungsdatum', '$aenderungsdatum', $typ, $Sprache, $kategorie, '".$auth->auth["uname"]."', '$p_filename', '$vorhandenesbild');"; 
	   } else {
		   $query = "INSERT INTO PENDING (ID, DOKID, TITEL, BESCHREIBUNG, ERSTELLUNGSDATUM, AENDERUNGSDATUM, TYP, SPRACHE, KATEGORIE, ANGELEGTVON, STATUS, BILD, BILD_REFERENZ) ";
		   $query .= "VALUES ($newid, $ID, '$titel', '$beschreibung', '$erstellungsdatum', '$aenderungsdatum', $typ, $Sprache, $kategorie, '".$auth->auth["uname"]."', 'M', '$p_filename', '$vorhandenesbild');"; 
 	   }
	   $db->query ($query);
		    //################### Links zu den verschiedenen Formaten in der FORMAT Tabelle speichern
                    for ($i=0;$i<count($format);$i++) {
		      $query = "INSERT INTO PENDING_FORMAT (DOKUID,FORMATID,LINK, PENDING_ID) VALUES ($ID,$format[$i],'$links[$i]',$newid) ";
		      $db->query($query);
		    }

		    //################### Autoren speichern
                    for ($i=0;$i<count($mautoren);$i++) {
		      $query = "INSERT INTO PENDING_ATR_DKMNT (DOKUMENT_ID,AUTOR_ID, PENDING_ID) VALUES (".$ID.",$mautoren[$i],$newid) ";
		      $db->query($query);
		    }

		    if (! $newentry) {
		    		$newentry = $t->translate("Done successfully");
	            } 
       }

  // #################### Dritte Seite (Eintrag wurde in die DB geschrieben) ############################################ 
      if ($newentry) { ?>
                <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $newentry ?></B></TD>
                        <TD colspan="2">&nbsp;</TD>
                   </TR>
                   </TBODY>
                </TABLE>
<?php
   }
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

