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
# Insert format
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
if ($perm->have_perm("user_pending")) {
  $bx->box_full($t->translate("Error"), $t->translate("Access denied"));
  $auth->logout();
} else {

  $bx->box_begin();
  $bx->box_title($t->translate("New Document"));
  $bx->box_body_begin();

	## Neues Dokument soll eingefügt werden, hier die Datenüberprüfung
	if ($status == 'insert_new') {
		// Eingaben ueberpruefen
	        if (! $titel) {
			$error_ar["titel"] = $t->translate("Error").": ".$t->translate("Please enter the title of the document")." (".__LINE__.")";
			// echo $error_ar["titel"];
        	}
        	if (($titel) && (strlen($titel) < 2)) {
                	$error_ar["titel"] = $t->translate("Error").": ".$t->translate("The title is to short")." (".__LINE__.")";
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

		if (! $erstellungszeit) {
			$error_ar["erstellungsdatum"] = $t->translate("Error").": ".$t->translate("Please enter the time of creation")." (".__LINE__.")";
		}
		else {
			list ($estunde, $eminute, $esekunde) = split ('[/:.-]', $erstellungszeit);
			if (! (($estunde > -1) && ($estunde < 24))) {
				$error_ar["erstellungsdatum"] = $t->translate("Error").": ".$t->translate("Wrong hour format")." (".__LINE__.")";
			}
                        if (! (($eminute > -1) && ($eminute < 60))) {
                                $error_ar["erstellungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong minute format")." (".__LINE__.")";
                        }			
                        if (! (($esekunde > -1) && ($esekunde < 60))) {
                                $error_ar["erstellungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong second format")." (".__LINE__.")";
                        }
			// echo $error_ar["erstellungsdatum"]; 
		}

                if (! $aenderungsdatum) {
                        $error_ar["aenderungsdatum"] = $t->translate("Error").": ".$t->translate("Please enter the date of last update")." (".__LINE__.")";
                        // echo $error_ar["aenderungsdatum"];
                }
                else {
                        list ($atag, $amonat, $ajahr) = split ('[/.-]', $aenderungsdatum);
                        if (! (($atag > 0) && ($atag < 32)))
                                $error_ar["aenderungsdatum"] = $t->translate("Error").": ".$t->translate("Wrong day format")." (".__LINE__.")";
                        if (! (($amonat > 0) && ($amonat < 13)))
                                $error_ar["aenderungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong month format")." (".__LINE__.")";
                        if (! (($ajahr > 1950) && ($ajahr < 3000))) 
                                $error_ar["aenderungsdatum"] .= $t->translate("Error").": ".$t->translate("Wrong year format")." (".__LINE__.")";
                }

		if (! $aenderungszeit) {
			$error_ar["aenderungsdatum"] = $t->translate("Error").": ".$t->translate("Please enter the time of modification")." (".__LINE__.")";
		}
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

		if (!empty($timage_name)) {
			if (! ereg ("\.(.{2,4})$", $timage_name, $regs)) { //#### Dateiname überprüfen
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
					if (! copy ($timage,$new_file)) 
						$error_ar["image"] = $t->translate("Error").": <br>".$t->translate("Could not write new file.")." - ".$new_file."(".__LINE__.")";
				}
			}
		} 
		//echo "NACH BILD";
		//exit;

 	}
 	
        //#### Ein neues Dokument soll in die DB geschrieben werden, jetzt wurden die Links eingegben #############################
        //############################################# Letzte Überprüfung und Pending Eintrag schreiben ##########################
        if ($status == "insert_links") {
                // Eingaben ueberpruefen
                if (! $links) {
                        $error_ar2 = "$texte[30]. (".__LINE__.")";
                        // echo $error_ar2;
                } else {
			for ($i=0;$i<count($format);$i++) {                     
				$db->query ("SELECT * FROM FORMATDEF WHERE ID=$format[$i]");
				$db->next_record();
				if (($links[$i] == "http://") or (! $links[$i])) {
					$error_ar2 .= $t->translate("Please enter a link for the format").": ".$db->f("NAME")." (".__LINE__.").<br> ";
				} // if 
				if (! ereg ("://",$links[$i])) {
					$error_ar2 .= $t->translate("Please enter a absolute link for the format").": ".$db->f("NAME")." (".__LINE__.")s. ";
				} // if 
			} // for
		} // else	
	} // if 	

	//#############################################################################################
	//### OK, wenn alle Angaben richtig sind, dann ab in die DB damit
	//#############################################################################################

	if (($status == "insert_links") && (! $error_ar) && (! $error_ar2)) {
	 // Datum ins richtige Format bringen
	 list ($etag, $emonat, $ejahr) = split ('[/.-]', $erstellungsdatum);
  	 list ($estunde, $eminute, $esekunde) = split ('[/:.-]', $erstellungszeit);
	 $erstellungsdatum = "$ejahr-$emonat-$etag $estunde:$eminute:$esekunde";
	 list ($atag, $amonat, $ajahr) = split ('[/.-]', $aenderungsdatum);
 	 list ($astunde, $aminute, $asekunde) = split ('[/:.-]', $aenderungszeit);
	 $aenderungsdatum = "$ajahr-$amonat-$atag $astunde:$aminute:$asekunde";
         $titel = $titel;
         $beschreibung = $beschreibung;

	 //Mit LOCK arbeiten, weil sonst (bei gleichzeitigem Schreibvorgang Fehler)
         //auftreten können!
	 //$db->query ("LOCK TABLES PENDING WRITE;");
   	 $query = "SELECT max(ID) AS maxid FROM PENDING";
	 $db->query ($query);
         $db->next_record();
         $newid = $db->f("maxid")+1;	 

	//	 echo $newid;

	 if ($new_filename) {
		unset ($vorhandenesbild);
	  	ereg ("\.(.{2,4})$", $new_filename, $regs);
	        $p_filename = $newid."_pending.".$regs[1];
 	 	if (! copy (dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename,dirname($SCRIPT_FILENAME)."/images_docs/".$p_filename)) 
	 		$newentry = $t->translate("Error").": ".$t->translate("Could not write new file.")." - ".$p_filename."(".__LINE__.")";
		else 
			unlink (dirname($SCRIPT_FILENAME)."/images_docs/".$new_filename);
	 } elseif ($vorhandenesbild) {
	   	 //Nur wenn kein Bild hochgeladen wurde evt. Bild Referer speichern
		unset ($p_filename);
	 } 
	 

	 $query = "INSERT INTO PENDING (ID, TITEL, BESCHREIBUNG, ERSTELLUNGSDATUM, AENDERUNGSDATUM, TYP, SPRACHE, KATEGORIE, ANGELEGTVON, BILD, BILD_REFERENZ) ";
	 $query .= "VALUES ($newid, '$titel', '$beschreibung', '$erstellungsdatum', '$aenderungsdatum', $typ, $Sprache, $kategorie, '".$auth->auth["uname"]."', '$p_filename', '$vorhandenesbild');"; 
	 $db->query ($query);

	 //Tabelle wieder freigeben
	 //$db->query ("UNLOCK TABLES");


	 //echo "WHY";


	 //################### Links zu den verschiedenen Formaten in der FORMAT Tabelle speichern
         for ($i=0;$i<count($format);$i++) {
	 	$query = "INSERT INTO PENDING_FORMAT (DOKUID,FORMATID,LINK, PENDING_ID) VALUES ($newid,$format[$i],'$links[$i]',$newid) ";
                $db->query($query);
	 }
    
         //echo "WONT";

	 //################### Autor(en) speichern
         for ($i=0;$i<count($mautoren);$i++) {
	 	$query = "INSERT INTO PENDING_ATR_DKMNT (DOKUMENT_ID,AUTOR_ID,PENDING_ID) VALUES ($newid,$mautoren[$i],$newid) ";
                $db->query($query);
	 }

  	 $newentry = $t->translate("Done successfully");
	}


// ##########################################
// # Anzeige der ersten Eingabemaske
// ##########################################
        if ((! $status) || ($error_ar)) { ?>
	<form action="<?php $sess->purl("insform.php") ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="status" value="insert_new">
		<TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Category") ?>:</B></TD>
                      	<TD valign="top">
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
  				      $cat_path .= " :: ".$t->translate($onestep)." ";
				    }
				    $cat_path = substr ($cat_path,3);  
				    echo $cat_path;
				    echo "<input type=\"hidden\" name=\"category\" value=\"$category\">";
			     } else echo $t->translate ("Please select"); ?>
			<?php if ($error_ar["category"]): echo "<BR><font color=\"#AA0000\">".
                                $error_ar["category"]."</font>"; endif; ?>		
			</TD>
			<TD valign="top"><a href="categories.php?mode=2"><font class="small"><?php echo $t->translate("Select category") ?></font></a>
			   <?php if ($perm->have_perm("admin")) { ?>
                           <br><a href="<?php $sess->purl("admcat.php") ?>"><font class="small"><?php echo $t->translate("Insert new category") ?></font></a>
			<?php } ?></TD>
                    </TR>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Language") ?>:</B></TD>
                        <TD>
                          <select name="Sprache">
                    <?php //############################# Sprachen holen ##################################
                    		$db->query ("SELECT * FROM SPRACHEDEF ORDER BY SPRACHE ASC");
			  
				  while ($db->next_record()) {		      				  
                            	  	echo "<option value=\"".$db->f("ID")."\"";
					if (($Sprache) && ($Sprache == $db->f("ID"))): echo " selected "; endif;
					echo ">".$t->translate($db->f("SPRACHE"))."</option>\n";                            	  
                            	  }
                     ?>
                          </select>
			</TD>
			
			<TD><?php if ($perm->have_perm("editor") || $perm->have_perm("admin")) { ?>
                        	<a href="<?php $sess->purl("insert_sprache.php") ?>"><font class="small"><?php echo $t->translate("Insert new language") ?></font></a>
                        <?php } ?></TD>
                      </TR>
                      <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Type") ?>:</B></TD>
                      	<TD>
                          <select name="typ">
                    <?php //############################# Dokumenttypen holen ##################################
				$db->query ("SELECT * FROM TYPDEF ORDER BY NAME ASC");
				  
				  while ($db->next_record()) {
		      				  
                            	  	echo "<option value=\"".$db->f("ID")."\"";
					if (($typ) && ($typ == $db->f("ID"))): echo " selected "; endif;
					echo ">".$t->translate($db->f("NAME"))."</option>\n";
                            	  
                            	  }
                     ?>
                          </select>
			</TD>
			<TD><?php if ($perm->have_perm("editor") || $perm->have_perm("admin")) { ?>
                           <a href="<?php $sess->purl("insert_typ.php") ?>"><font class="small"><?php echo $t->translate("Insert new type") ?></font></a>
			<?php } ?></TD>
                      </TR>
                      <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Format") ?>:</B><BR><font size="1">(<?php echo $t->translate("multiselection possible") ?>)</font></TD>
                        <TD>
                          <select name="format[]" size="10" multiple>
                    <?php //############################# Dokumentformate holen ##################################
				
                    		$db->query ("SELECT * FROM FORMATDEF ORDER BY NAME ASC");
				  
				  while ($db->next_record()) {
		      				  
                            	  	echo "<option value=\"".$db->f("ID")."\""; 
					if ($format) {
						for ($i=0;$i<count($format);$i++) {
							if ($format[$i] == $db->f("ID")): echo " selected "; endif;
						}
					}
					echo ">". $db->f("NAME") ."</option>\n";
                            	  
                            	  }
                     ?>
                          </select>
                          <?php if ($error_ar["format"]): echo "<BR><font color=\"#AA0000\">".
                                $error_ar["format"]."</font>"; endif; ?>
			</TD>
			<TD><?php if ($perm->have_perm("editor") || $perm->have_perm("admin")) { ?>
                           <a href="<?php $sess->purl("insert_format.php") ?>"><font class="small"><?php echo $t->translate("Insert new format") ?></font></a>
			<?php } ?></TD>
                      </TR>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Author") ?>:</B><BR><font size="1">(<?php echo $t->translate("multiselection possible") ?>)</font></TD>
                      	<TD>
                          <select name="mautoren[]" size="15" multiple>
                    <?php //############################# Autoren holen ##################################
                    		$db->query("SELECT * FROM AUTOR ORDER BY NACHNAME ASC");
				  
				  while ($db->next_record()) {
		      				  
                            	  	echo "<option value=\"".$db->f("ID")."\"";
					if ($mautoren) {
						for ($i=0;$i<count($mautoren);$i++) {
							if ($mautoren[$i] == $db->f("ID")): echo " selected "; endif;
						}
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
                           <a href="<?php $sess->purl("insert_autor.php") ?>"><font class="small"><?php echo $t->translate("Insert new author") ?></font></a>
			</TD>
                      </TR>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Title") ?>:</B></TD>
                        <TD colspan="2">
                          <input type="text" name="titel" size="30" value="<?php echo htmlentities(stripslashes($titel), ENT_COMPAT) ?>">
			  <?php if ($error_ar["titel"]): echo "<BR><font color=\"#AA0000\">".$error_ar["titel"]."
							       </font>"; endif; ?>
                        </TD>
                      </TR>
                    <TR>
                        <TD align="right" valign="top" width="25%"><B><?php echo $t->translate("Description") ?>:</B></TD>
                        <TD width="75%" colspan="2">
                          <textarea name="beschreibung" wrap="PHYSICAL" cols="50" rows="10"><?php echo stripslashes($beschreibung) ?></textarea>
                          <?php if ($error_ar["beschreibung"]): echo "<BR><font color=\"#AA0000\"> ".$error_ar["beschreibung"]."</font>"; endif; ?>
                        </TD>
                      </TR>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Image") ?>:</B></TD>
                        <TD colspan="2">
			  <input type="hidden" name="MAX_FILE_SIZE" value="">
			  <input type="file" name="timage">
			  <?php if ($error_ar["image"]): echo "<BR><font color=\"#AA0000\">".$error_ar["image"]."
							       </font>"; endif; 
			  if ($new_filename) {
				echo "<input type=\"hidden\" name=\"new_filename\" value=\"$new_filename\"> ";
				echo "<b>".$t->translate("Image saved")."!</b>";
			
			  }
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
                                  echo ">".$db->f("TITEL")."</option>\n";
                          }
                          echo "</select>\n";
			  ?>
		
			  

                        </TD>
                      </TR>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Created") ?>:<br>
                          </B><font size="1">(DD.MM.YYYY) </font></TD>
                        <TD valign="top" colspan="2">
			  <input type="text" name="erstellungsdatum" maxlength="10" size="10" value="<?php if ($erstellungsdatum): echo $erstellungsdatum; else: echo date("d.m.Y"); endif; ?>"> <?php echo $t->translate("at") ?>
			  <input type="text" name="erstellungszeit" maxlength="8" size="8" value="<?php if ($erstellungszeit): echo $erstellungszeit; else: echo date("H:i:s"); endif; ?>"> <?php echo $t->translate("o'clock")." ".$t->translate("(hh:mm:ss)"); ?> 
                          <?php if ($error_ar["erstellungsdatum"]): echo "<BR><font color=\"#AA0000\"> ".$error_ar["erstellungsdatum"]."</font>"; endif; ?>
                        </TD>
                      </TR>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Last updated"); ?>:<br>
                          </B><font size="1">(DD.MM.YYYY) </font></TD>
                        <TD valign="top" colspan="2">
			  <input type="text" name="aenderungsdatum" maxlength="10" size="10" value="<?php if ($aenderungsdatum): echo $aenderungsdatum; else: echo date("d.m.Y");endif; ?>"> <?php echo $t->translate("at") ?>
			  <input type="text" name="aenderungszeit" maxlength="8" size="8" value="<?php if ($aenderungszeit): echo $aenderungszeit; else: echo date("H:i:s");endif; ?>"> <?php echo $t->translate("o'clock")." ".$t->translate("(hh:mm:ss)"); ?>
                          <?php if ($error_ar["aenderungsdatum"]): echo "<BR><font color=\"#AA0000\"> ".$error_ar["aenderungsdatum"]."</font>"; endif; ?>
                        </TD>
                      </TR>
                      
                      <TR>
                        <TD vAlign=top align=right>&nbsp;</TD>
                        <TD><br>
                          <input type="submit" name="Button" value="<?php echo ereg_replace ("\n","",$t->translate("Send")) ?>">
                        </TD>
                      </TR></TBODY>
		</TABLE>
	</form>
<?php // #################### Zweite Seite (Eingabe der Links) ############################################ ?>
<?php } elseif ((($status == "insert_new") && (! $error_ar)) || ($error_ar2)) { 
	//echo $blub2;
?>
	
        <form action="<?php $sess->purl("insform.php") ?>" method="post">
                <input type="hidden" name="status" value="insert_links">
		<?php if ($new_filename) echo "<input type=\"hidden\" name=\"new_filename\" value=\"$new_filename\">"; ?>
		<?php if ($vorhandenesbild) echo "<input type=\"hidden\" name=\"vorhandenesbild\" value=\"$vorhandenesbild\">"; ?>
                <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
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
		   <?php } elseif ($vorhandenesbild)  {
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
                        <TD align="right"><B><?php echo $t->translate("Title") ?>:</B></TD>
                        <TD>
				<?php echo htmlentities(stripslashes($titel),ENT_COMPAT); ?><input type="hidden" name="titel" value="<?php echo htmlentities(stripslashes($titel),ENT_COMPAT); ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Description") ?>:</B></TD>
                        <TD>
                                <?php echo htmlentities(stripslashes($beschreibung),ENT_COMPAT); ?>
								<input type="hidden" name="beschreibung" value="<?php echo htmlentities(stripslashes($beschreibung),ENT_COMPAT); ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right"><B><?php echo $t->translate("Created") ?>:</B></TD>
                        <TD>
                                <?php //echo $erstellungsdatum;
				      $timestamp = mktime(substr($erstellungszeit,0,2),substr($erstellungszeit,3,2),substr($erstellungszeit,6,2),substr($erstellungsdatum,3,2),substr($erstellungsdatum,0,2),substr($erstellungsdatum,6,4));
 				      echo timestr($timestamp);
    				?>
                                <input type="hidden" name="erstellungsdatum" value="<?php echo $erstellungsdatum; ?>">
				<input type="hidden" name="erstellungszeit" value="<?php echo $erstellungszeit; ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right"><B><?php echo $t->translate("Last updated"); ?>:</B></TD>
                        <TD>
                                <?php $timestamp = mktime(substr($aenderungszeit,0,2),substr($aenderungszeit,3,2),substr($aenderungszeit,6,2),substr($aenderungsdatum,3,2),substr($aenderungsdatum,0,2),substr($aenderungsdatum,6,4));
 				      echo timestr($timestamp);
    				?>
                                <input type="hidden" name="aenderungsdatum" value="<?php echo $aenderungsdatum; ?>">
				<input type="hidden" name="aenderungszeit" value="<?php echo $aenderungszeit; ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Language") ?>:</B></TD>
                        <TD>
                                <?php
                                $db->query("SELECT * FROM SPRACHEDEF WHERE ID=$Sprache");
                                $db->next_record();
                                echo $t->translate($db->f("SPRACHE")); ?>
                                <input type="hidden" name="Sprache" value="<?php echo $Sprache; ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Type") ?>:</B></TD>
                        <TD>
                                <?php
                                $db->query ("SELECT * FROM TYPDEF WHERE ID=$typ");
                                $db->next_record($result);
                                echo $db->f("NAME"); ?>
                                <input type="hidden" name="typ" value="<?php echo $typ; ?>">
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php if (count($mautoren) > 0) echo $t->translate("Authors"); else echo $t->translate("Author"); ?>:</B></TD>
                        <TD><?php
				for ($i=0;$i<count($mautoren);$i++) {
 	                               $db->query ("SELECT * FROM AUTOR WHERE ID=".$mautoren[$i]);
        	                       $db->next_record();
				       echo $db->f("VORNAME")." ".$db->f("NACHNAME");
					   if ($db->f("EMAIL") != "") echo " &lt;".$db->f("EMAIL")."&gt;";
					   echo "<BR>";
                	               //echo "$mautor[1] $mautor[2]"; ?>
                        	        <input type="hidden" name="mautoren[]" value="<?php echo $mautoren[$i]; ?>">
				       <?php
				} ?>
                        </TD>
                   </TR>
                   <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Category") ?>:</B></TD>
                        <TD>
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

				/*
                                $db->query ("SELECT * FROM KATEGORIE WHERE ID=$kategorie");
                                $db->next_record();
                                echo $t->translate($db->f("NAME")); 
				*/
				?>
                        </TD>
                    </TR>
		    <TR><TD colspan="3">&nbsp;</TD></TR>
                    <TR>
                        <TD align="right" valign="top"><B><?php echo $t->translate("Format") ?>:</B></TD>
                        <TD><?php echo $t->translate("Please enter a link for each format") ?></TD>
                   </TR>
                   <?php        
			for ($i=0;$i<count($format);$i++) {			
                        	$db->query ("SELECT * FROM FORMATDEF WHERE ID=$format[$i]");
				$db->next_record();
		    ?>	
                    <TR>
                        <TD align="right"><B><?php echo $db->f("NAME"); ?></B></TD>
                        <TD><input type="text" name="links[]" size="30" 
				 	 value="<?php if ($links[$i]): echo $links[$i]; else: echo "http://"; endif; ?>">´
				<input type="hidden" name="format[]" value="<?php echo $format[$i]; ?>"></TD>
                   </TR>
		   <?php } if ($error_ar2) { ?>
			<TR>
			  <TD>&nbsp;</TD>
			  <TD>
			  	<?php echo "<font color=\"#AA0000\">".$t->translate("Error").": ".$error_ar2."</font>"; ?>
			  </TD>
			</TR>
		   <?php } ?>			
                      <TR>
                        <TD align=right>&nbsp;</TD>
                        <TD>
                          <input type="submit" name="Button" value="<?php echo $t->translate("Send") ?>">
                        </TD>
                      </TR>
		</TABLE>
	</form>
<?php }
  // #################### Dritte Seite (Eintrag wurde in die DB geschrieben) ############################################ 
      elseif ($newentry) { ?>
                <TABLE cellSpacing=1 cellPadding=3 width="100%" bgColor=#ffffff border=0>
                    <TBODY>
                    <TR>
                        <TD align="right"><B><?php echo $newentry ?></B></TD>
                        <TD colspan="2">&nbsp;</TD>
                   </TR>
                   </TBODY>
                </TABLE>
<?php
  }
  $bx->box_body_end();
  $bx->box_end();
}
?>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
