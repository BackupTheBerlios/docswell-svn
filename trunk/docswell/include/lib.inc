<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001,2002 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#                Christian Schmidt (info@mallux.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Main Library file.
# You'll find in DocsWell's documentation an explanation of the
# functions.
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

#
# Shows an error when the database access fails
#

function mysql_die() {
    global $t,$be;
	if (isset($be)) {
        $be->box_full($t->translate("Database Access failed"), mysql_errno()." : ".mysql_error());
    }
}

#
# Returns time in timestamp format 
#

function mktimestamp($time) {
    $timestamp = mktime(substr($time,8,2),substr($time,10,2),substr($time,12,2),substr($time,4,2),substr($time,6,2),substr($time,0,4));
    return $timestamp;
}

#
# Returns time in timestamp format 
#

function mktimestampdw($time) {
    $timestamp = mktime(substr($time,11,2),substr($time,14,2),substr($time,17,2),substr($time,5,2),substr($time,8,2),substr($time,0,4));
    return $timestamp;
}

#
# Returns ratingstring
#

function rating($bewertungen, $summe) {
  global $t;
  #echo "<br><br>".$bewertungen."=Bewertung, ".$summe."=Summe<br><br>";	
  if ($bewertungen > 0) {
  	$rechnung = $bewertungen/$summe;
  	#echo "<br><br>".$rechnung."=Rechnmung<br><br>$bewertung/$summe<br><br>";	
	$rate=round($rechnung); 
  }  else { 
  	$rate = 0;
  }
  if ($rate == 0) { $str = "-"; }
  elseif ($rate == 3) { $str = $t->translate("Good"); }
  elseif ($rate == 2) { $str = $t->translate("OK"); }
  elseif ($rate == 1) { $str = $t->translate("Bad"); } 
  return "$str ($summe)";
}

#
#
#

function timestr($timestamp) {
    global $t;
    $time = strftime("%A, %e. %B %Y, %H:%M:%S %Z", $timestamp);
    return $time;
}

function datestr($date) {
    list ($ejahr, $emonat, $etag) = split ('[/.-]', $date);
    $datum = "$etag.$emonat.$ejahr";
    return $datum;
}

function timestr_short($timestamp){
    global $t;
    $time = strftime("%a, %e. %b, %H:%M", $timestamp);
    return $time;
}

function timestr_comment($timestamp){
    global $t;
    $time = strftime("%e. %b, %H:%M", $timestamp);
    return $time;
}

#
# docfull: Shows whole information about a document
#

function docfull($query) {
  global $bx, $t, $sess, $db;

  $db->query($query);
  $db->next_record();
  $bx->box_begin();
  $bx->box_title($db->f("TITEL"));
  $bx->box_body_begin();
  $timestamp = timestr(mktimestampdw($db->f("AENDERUNGSDATUM")));
  $timestampER = timestr(mktimestampdw($db->f("ERSTELLUNGSDATUM")));
  
  # Anleger
  $dbAn = new DB_DocsWell;
  $dbAn->query("SELECT * FROM auth_user WHERE username='".$db->f("ANGELEGTVON")."'");
  $dbAn->next_record();
  
  # Kategoriedaten
  $dbKat = new DB_DocsWell;
  $dbKat->query("SELECT * FROM KATEGORIE WHERE ID=".$db->f("KATEGORIE"));
  $dbKat->next_record();
  $parent = $dbKat->f("PARENT_ID");
  if ($parent) {
	  $pfad = array();
	  while ($parent != 1) {
		array_unshift ($pfad,$dbKat->f("NAME"));
		$dbKat->query("SELECT * FROM KATEGORIE WHERE ID=$parent");
		$dbKat->next_record();
		$parent = $dbKat->f("PARENT_ID");
	  }
	  array_unshift ($pfad,$dbKat->f("NAME"));
	  $anz = count($pfad);
	
	  $counter =0;
	  foreach ($pfad as $onestep) {
	    $counter++;
	    if ($counter == $anz) {
		  $dbKat->query("SELECT * FROM KATEGORIE WHERE NAME='$onestep'");
		  $dbKat->next_record();
		  $cat_path .= " :: <a href=\"".$sess->url("docbycat.php").$sess->add_query(array("category" => $db->f("KATEGORIE")))."\">".$t->translate($onestep)."</a>";
	    } else 
		$cat_path .= " :: ".$t->translate($onestep)." ";
	  }
	  $cat_path = substr ($cat_path,3);  
  } else $cat_path = $t->translate("Category does not exist");
  
 
  //echo "----------->";
 
  $dbKat->query("SELECT * FROM KATEGORIE WHERE ID=".$db->f("KATEGORIE"));
  $dbKat->next_record();
  
  # Sprache
  $dbSpr = new DB_DocsWell;
  $dbSpr->query("SELECT * FROM SPRACHEDEF WHERE ID=".$db->f("SPRACHE"));
  $dbSpr->next_record();

  /*  Off wegen neuer Tabelle (mehrere Autoren pro Dok)
  # Autorendaten
  $dbAut = new DB_DocsWell;
  $dbAut->query("SELECT * FROM AUTOR WHERE ID=".$db->f("AUTOR"));
  $dbAut->next_record();
  */

  # Typdaten
  $dbTyp = new DB_DocsWell;
  $dbTyp->query("SELECT * FROM TYPDEF WHERE ID=".$db->f("TYP"));
  $dbTyp->next_record();

  # Formatdaten
  $dbForm = new DB_DocsWell;
  $dbForm->query("SELECT * FROM FORMAT WHERE DOKUID=".$db->f("ID"));
  
  echo "<b class=\"small\">".$t->translate("by")." <a href=\"mailto:".$dbAn->f("email_usr")."\">".$dbAn->f("username")."</a> - ".$timestamp."</b>\n";
  if (($db->f("BILD")) && (file_exists("./images_docs/".$db->f("BILD")))) $bild = $db->f("BILD");
  elseif (($db->f("BILD_REFERENZ")) && (file_exists("./images_docs/".$db->f("BILD_REFERENZ")))) $bild = $db->f("BILD_REFERENZ"); 
  if ($bild) {
      echo "<br><br>";
      $size = GetImageSize("./images_docs/".$bild);
      $width = $size[0];
      $height = $size[1];
      if ($width > $GLOBALS["config_maxwidth"]) {
              $height = round($height / $width * $GLOBALS["config_maxwidth"]);
              $width = $GLOBALS["config_maxwidth"];
      }
      echo "<img src=\"images_docs/".$bild."\" border=\"0\" width=\"$width\" height=\"$height\" align=\"right\" hspace=\"5\" vspace=\"5\">";
  } else echo "<p>";
  echo $db->f("BESCHREIBUNG")."	\n";
  echo "<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=".$GLOBALS["th_box_body_bgcolor"].">\n";
  echo "<tr><td colspan=2>&nbsp;</td></tr>";

  //Autoren besorgen
  $dbAut = new DB_DocsWell;
  $Sql = "SELECT a.ID, a.VORNAME, a.NACHNAME, a.EMAIL FROM AUTOR a, AUTOR_DOKUMENT ad WHERE ad.autor_id=a.id AND ad.dokument_id=".$db->f("ID");
  //echo $Sql;
  $dbAut->query($Sql);
  $anz = $dbAut->num_rows();

  $Autoren = array ();
  echo "<tr valign=top><td align=right><b>".$t->translate("Author").":</b></td><td>";
  if ($anz > 0) { //Autoren ausgeben
  	$counter = 0; 
  	while ($dbAut->next_record()) {
		$counter++;
		$Autoren[] = $dbAut->f("ID");
        	echo $dbAut->f("VORNAME")." ".$dbAut->f("NACHNAME");
  		$db_email = $dbAut->f("EMAIL");
 		if (!empty($db_email)) echo " &lt;<a href=\"mailto:$db_email\">".ereg_replace("@"," at ",htmlentities($db_email))."</a>&gt;";
 		/* if (strlen($db3->f("email")) > 0) echo " <a href=\"mailto:".$db3->f("email")."\">";
		echo $db3->f("vorname")." ".$db3->f("nachname");
		if (strlen($db3->f("email")) > 0) echo "</a>";
		*/
		if ($counter < $anz) echo ", ";
  	}
  } else echo "Unknown";

  echo "</td></tr>\n";
  echo "<tr valign=top><td align=right><b>".$t->translate("Type").":</b></td>\n";
  echo "<td><a href=\"".$sess->url("docbytyp.php").$sess->add_query(array("typ" => $db->f("TYP")))."\">".$t->translate($dbTyp->f("NAME"))."</a></td>\n";
  echo "</tr>\n";

  echo "<tr valign=top><td align=right><b>".$t->translate("Category").":</b></td><td>$cat_path</td></tr>\n";

  echo "<tr valign=top><td align=right><b>".$t->translate("Language").":</b></td><td>".$t->translate($dbSpr->f("SPRACHE"))."</td></tr>\n";

    $dbFormDef = new DB_DocsWell;
    $i = 0;
    while ($dbForm->next_record()) {
      $dbFormDef->query("SELECT * FROM FORMATDEF WHERE ID=".$dbForm->f("FORMATID"));
      $dbFormDef->next_record();    
      if ($i == 0) {
        echo "<tr valign=top><td align=right valign=top><b>".$t->translate("Format").":</b></td><td>";
      } else {
        echo "<br>";
      }
      echo "<a href=\"".$sess->url("download.php").$sess->add_query(array("id" => $db->f("ID"),"url" => $dbForm->f("LINK")))."\" target=\"_new\">".$dbFormDef->f("NAME")."</a>\n";
      $i++;
    }
    
  echo "<tr valign=top><td align=right><b>".$t->translate("Last updated").":</b></td><td width=75%> $timestamp</td></tr>\n";

  echo "<tr valign=top><td align=right><b>".$t->translate("Created").":</b></td><td width=75%> $timestampER</td></tr>\n";

  echo "<tr valign=top><td align=right><b>".$t->translate("Downloads").":</b></td><td width=75%> ".$db->f("COUNTER")."</td></tr>\n";

  echo "<tr valign=top><td align=right><b>".$t->translate("Rating").":</b></td><td>".rating($db->f("BEWERTUNG"), $db->f("BEWVONANZP"))."</td></tr>\n";;

    echo "<tr valign=top><td align=right valign=top></td><td align=left>";

    echo "<FORM ACTION=\"rating.php\" METHOD=\"POST\">\n";
    echo "<INPUT TYPE=\"HIDDEN\" NAME=\"dokuid\" VALUE=\"".$db->f("ID")."\">\n";
    echo "<INPUT TYPE=\"HIDDEN\" NAME=\"url\" VALUE=\"".$sess->self_url()."\">\n";
    echo "<br><table cellpadding=0 cellspacing=0 border=0><tr>\n<td align=center><IMG SRC=\"images/rateit.png\" HEIGHT=9 WIDTH=100></td></tr>\n";
    #echo "<IMG src=\"images/blank.gif\" height=1 width=\"-15\" border=0 alt=\"blank.gif\">	<IMG SRC=\"images/caret.png\" HEIGHT=6 WIDTH=9><BR>\n";
    echo "<tr><td align=center><INPUT TYPE=\"RADIO\" NAME=\"bewerten\" VALUE=1>\n";
    echo "<INPUT TYPE=\"RADIO\" NAME=\"bewerten\" VALUE=2>\n";
    echo "<INPUT TYPE=\"RADIO\" NAME=\"bewerten\" VALUE=3></td></tr>\n";
    echo "<tr><td align=center>\n";
    echo "<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"".$t->translate("Rate It")."\">\n";
    echo "</td></tr></table>\n";
    echo "</FORM></td></tr>\n";

    $dbaAut = new DB_DocsWell;
    $Sql = "    SELECT DISTINCT(a.ID), a.TITEL, b.SPRACHE, c.NAME 
		FROM DOKUMENT a, SPRACHEDEF b, TYPDEF c, AUTOR_DOKUMENT ad 
		WHERE ";
    $anzAut = count($Autoren);
    //echo "----".$anzAut."----";
    if ($anzAut > 0) $Sql .= " ( ";
    $counter = 0;
    if ($anzAut > 0) {
	    while (list(, $einer) = each ($Autoren)) {
		$counter++;
		$Sql .= " ad.AUTOR_ID=$einer ";
        	if ($anzAut > $counter) $Sql .= " OR ";
	    }	
    
    	if ($anzAut > 0) $Sql .= " ) ";
    	$Sql .= "	        AND a.ID = ad.DOKUMENT_id
				AND a.ID!=".$db->f("ID")." 
				AND a.SPRACHE=b.ID 
				AND a.TYP=c.ID 
				AND a.STATUS != 'D' ";
    	$Sql .= " ORDER BY a.AENDERUNGSDATUM DESC ";
    	//echo $Sql;
    	$dbaAut->query($Sql);
    	$i = 0;
    	while ($dbaAut->next_record()) {
    	
    	  if ($i == 0) {
    	    echo "<tr><td colspan=2>&nbsp;</td></tr>";
    	    if ($anzAut == 1) echo "<tr valign=top><td align=right valign=top><b>".$t->translate("Others by Author").":</b></td><td>";
    	    else echo "<tr valign=top><td align=right valign=top><b>".$t->translate("Others from the authors").":</b></td><td>";
    	  } else {
    	    echo "<br>";
    	  }
    	  echo "<a href=\"docbyid.php?id=".$dbaAut->f("ID")."\">".$dbaAut->f("TITEL")."</a> ".$dbaAut->f("SPRACHE")." (".$dbaAut->f("NAME").")\n";
    	  $i++;
      }
    }
    echo "</td></tr></table>\n";
    $bx->box_body_end();
    $bx->box_title_begin();
    echo "<b><a href=\"".$sess->url("update_online.php").$sess->add_query(array("ID" => $db->f("ID")))."\" class=\"small\"><img src=\"images/recycled.png\" border=0>&nbsp;".$t->translate("Update")."</a>&nbsp;&nbsp;<a href=\"".$sess->url("cmtdoc.php").$sess->add_query(array("id" => $db->f("ID")))."\" class=\"small\"><img src=\"images/txt.png\" border=0>&nbsp;".$t->translate("Comment")."</a></b>\n";
   $bx->box_title_end();
   $bx->box_end();
}


#
# doccat: shows docs from a certain category
# title puts the name of the category as title of the table
# iter allows to show the docs in steps of x docss each time
#

function doccat($query,$title,$iter, $what) {
  global $bx,$t,$db,$sess;

  $i = $iter;
  $db->query($query);
  $z=0;
  $dbKat = new DB_DocsWell;
  while($db->next_record()) {
    //Kategorie Pfad erstellen
    $cat_path = "";
    $dbt = new DB_DocsWell;
    $dbt->query("SELECT * FROM KATEGORIE WHERE ID=".$db->f("KATID"));
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
		$cat_path .= " :: <a href=\"".$sess->url("docbycat.php").$sess->add_query(array("category" => $db->f("KATID")))."\">".$t->translate($onestep)."</a>";
      } else 
		$cat_path .= " :: ".$t->translate($onestep)." ";
	}
    $cat_path = substr ($cat_path,3);   	  
    
    
    if($z == 0) {
  	$bx->box_begin();
  	switch ($what) {      
    	   case "Cat":
		$title = $t->translate ("Category").": ".$cat_path;
		
		//$title = "->".$title."<-";
		//$title = substr ($title,5)."d";
	        //$title .= " ".$t->translate($db->f("KATID"));	
     	        //$title .= " ".$t->translate($db->f("KategorieName"));
                break;        
           case "Author":
              $title .= " ".$db->f("AutorName").", ".$db->f("AutorVorname");
             break;  
           case "Typ":
              $title .= " ".$t->translate($db->f("TypName"));
             break;               
          default:
              break;
         }
  	
  	$bx->box_title($title);
  	$bx->box_body_begin();
  	echo "<table border=0 align=center cellspacing=0 cellpadding=3 width=100%>\n";  
    }
    echo "<tr><td align=right valign=top width=4%><b>$i</b></td><td width=96%><b><a href=\"".$sess->url("docbyid.php").$sess->add_query(array("id" => $db->f("id")))."\">".$db->f("titel")."</a></b>";

  //Autoren besorgen
  $dbAut = new DB_DocsWell;
  $Sql = "SELECT a.vorname, a.nachname, a.email FROM AUTOR a, AUTOR_DOKUMENT ad WHERE ad.autor_id=a.id AND ad.dokument_id=".$db->f("id");
  //echo $Sql;
  $dbAut->query($Sql);
  $anz = $dbAut->num_rows();

  if ($anz > 0) { //Autoren ausgeben
	echo " <br><b>".$t->translate("by")." ";
  	$counter = 0; 
  	while ($dbAut->next_record()) {
		$counter++;
		if (strlen($dbAut->f("email")) > 0) echo " <a href=\"mailto:".$dbAut->f("email")."\">";
		echo $dbAut->f("vorname")." ".$dbAut->f("nachname");
		if (strlen($dbAut->f("email")) > 0) echo "</a>";
		if ($counter < $anz) echo ", ";
  	}
	echo "</b>\n";
  }
    echo "<br>".$db->f("beschreibung")."\n";
  	switch ($what) {      
    	   case "Cat":
             echo "<br><b>".$t->translate("Type").":</b> ".$t->translate($db->f("TypName"));
              break;        
           case "Author":
             echo "<br><b>".$t->translate("Type").":</b> ".$t->translate($db->f("TypName"));
             echo "<br><b>".$t->translate("Category").":</b> ".$cat_path;
             break;  
           case "Typ":
             echo "<br><b>".$t->translate("Category").":</b> ".$cat_path;
             break;               
          default:
              break;
         }
    echo "<br><b>".$t->translate("Language").":</b> ".$t->translate($db->f("sprache"));
    echo "<br><b>".$t->translate("Downloads").":</b> ".$db->f("downloads");
    echo "; <b><nobr>".$t->translate("Rating").":</b> ".rating($db->f("bewertung"), $db->f("bewvonanzpand"))."</nobr>";
    $timeupd = timestr(mktimestampdw($db->f("aendatum")));
    //$timeupd = datestr($db->f("aendatum"));
    
    //$timecre = datestr($db->f("erdatum"));
    $timecre = timestr(mktimestampdw($db->f("erdatum")));
    if (strcmp($timeupd, $timecre)) {
    	echo "<br><b>".$t->translate("Last updated").":</b> ".$timeupd."\n";
    }
    echo "<br><b>".$t->translate("Created").":</b> ".$timecre."</td></tr>\n";
    $i++;
    ++$z;
  }
  echo "</table>\n";
#  $bx->box_body_end();
  $bx->box_end();
}

## docdat($query):
##
## Display document data

function docdat($query) {
  global $bx,$db,$sess;
  //echo $query;
  $db->query($query);
  while ($db->next_record()) {
    docd();
    $bx->box_end();
  }
}


## docupdate($query):
##
## Display Document data and Update Link

function docupdate($query) {
  global $perm, $bx, $t, $sess, $db;

  $db->query($query);
  while ($db->next_record()) {
    //echo "--->".$db->f("BILD");
    docd();

    $bx->box_title_begin();
    echo "<table width=100% border=0 cellspacing=0 cellpadding=0><tr valign=bottom>\n";

    $db_status = $db->f("STATUS");
    //echo $db_status;
    switch ($db_status) {
      case 'P':
        echo "<td width=40%><b><a href=\"".$sess->url("update_online.php").$sess->add_query(array("ID" => $db->f("id")))."\" class=\"small\"><img src=\"images/recycled.png\" border=0>&nbsp;".$t->translate("Review")."</a></b></td>\n";
        echo "<td width=60% align=right border=0><b class=\"small\">".$t->translate("Waiting for Review by an Editor")."</b>\n";
        break;
      case 'D':
        echo "<td width=40%><b><a href=\"".$sess->url("update_online.php").$sess->add_query(array("ID" => $db->f("id")))."\" class=\"small\"><img src=\"images/editdelete.png\" border=0>&nbsp;".$t->translate("Review")."</a></b></td>\n";
        echo "<td width=60% align=right border=0><b class=\"small\">".$t->translate("Is deleted")."</b>\n";
        break;
      case 'M':
        echo "<td width=40%><b><a href=\"".$sess->url("update_online.php").$sess->add_query(array("ID" => $db->f("id")))."\"><img src=\"images/recycled.png\" border=0>&nbsp;".$t->translate("Review")."</a></b></td>\n";
        echo "<td width=60% align=right border=0><b class=\"small\">".$t->translate("Is modified")."</b>\n";
        break;
      default:
        echo "<td width=100%><b><a href=\"".$sess->url("update_online.php").$sess->add_query(array("ID" => $db->f("id")))."\" class=\"small\"><img src=\"images/recycled.png\" border=0>&nbsp;".$t->translate("Update")."</a></b>\n";
        break;
    }
    echo "</td></tr></table>\n";
    $bx->box_title_end();
    $bx->box_end();
  }
}


## docd():
##
## Common support for functions docdat and docupdate

function docd() {
  global $bx,$t,$sess,$db;

  $bx->box_begin();
  $bx->box_title_begin();
  echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>\n";
  echo "<tr valign=bottom>";
  echo "<td width=30%><b><a href=\"".$sess->url("docbyid.php").$sess->add_query(array("id" => $db->f("id")))."\">".$db->f("titel")."</a></b></td>\n";
  echo "<td width=70% align=right>\n";

  echo "&nbsp;&nbsp;<b><a href=\"".$sess->url("docbytyp.php").$sess->add_query(array("typ" => $db->f("DocType")))."\">".$t->translate($db->f("TypName"))."</a></b>\n";

  $db2 = new DB_DocsWell;
  $db2->query("select a.FORMATID, a.LINK, b.NAME from FORMAT a, FORMATDEF b where a.DOKUID=".$db->f("id")." and a.FORMATID = b.ID");
  $del = 0;
  while ($db2->next_record()) {
	if($del!=0) {
		echo "<font class=\"small\"> | </font>";	
	} 
	echo "<a href=\"".$sess->url("download.php").$sess->add_query(array("id" => $db->f("id"),"url" => $db2->f("LINK")))."\" target=\"_new\" class=\"small\">".$t->translate($db2->f("NAME"))."</a>";
	$del=1;
  }

#  $db2_count = $db2->f("COUNT(*)");
#  if ($db2_count <= 0) {
#        $num = "";
#    } else {
#        $num = "<b>[".$db2_count."]</b>";
#    }
#  echo " <a href=\"".$sess->url("cmtapp.php").$sess->add_query(array("id" => $db->f("appid")))."\"><img src=\"images/txt.png\" border=0 alt=\"".$t->translate("Comments")."\"></a> $num</a>\n";

  echo "<br><a href=\"".$sess->url("docbycat.php").$sess->add_query(array("category" => $db->f("KatID")))."\"><b>".$t->translate($db->f("KategorieName"))."</b></a>\n";

  // Sprache besorgen
  $db2->query("SELECT * FROM SPRACHEDEF WHERE ID='".$db->f("sprache")."'");
  if ($db2->next_record())
    echo " <span class=\"small\">".$db2->f("SPRACHE")."</span>\n";

  echo "</td></tr>\n";
  echo "</table>\n";
  $bx->box_title_end();
  $bx->box_body_begin();
  $timestamp = timestr(mktimestampdw($db->f("aendatum")));

  //Autoren besorgen
  $db3 = new DB_DocsWell;
  $Sql = "SELECT a.vorname, a.nachname, a.email FROM AUTOR a, AUTOR_DOKUMENT ad WHERE ad.autor_id=a.id AND ad.dokument_id=".$db->f("id");
  //echo $Sql;
  $db3->query($Sql);
  $anz = $db3->num_rows();
  echo "<b class=\"small\">";
  if ($anz > 0) { //Autoren ausgeben
  	echo $t->translate("by")." ";
  	$counter = 0; 
  	while ($db3->next_record()) {
		$counter++;
 		if (strlen($db3->f("email")) > 0) echo " <a href=\"mailto:".$db3->f("email")."\">";
		echo $db3->f("vorname")." ".$db3->f("nachname");
		if (strlen($db3->f("email")) > 0) echo "</a>";
		if ($counter < $anz) echo ", ";
  	}
	echo " - ";
  }
  echo $timestamp;
  echo " (".$db->f("ANGELEGTVON").")</b>\n";
  //echo $db->f("BILD_REFERENZ")."<";
    if (($db->f("BILD")) && (file_exists("./images_docs/".$db->f("BILD")))) $bild = $db->f("BILD");
    elseif (($db->f("BILD_REFERENZ")) && (file_exists("./images_docs/".$db->f("BILD_REFERENZ")))) $bild = $db->f("BILD_REFERENZ"); 
    //echo $bild;
    if ($bild) {
	echo "<br><br>";
	$size = GetImageSize("./images_docs/".$bild);
      	$width = $size[0];
     	$height = $size[1];
      if ($width > $GLOBALS["config_maxwidth"]) {
              $height = round($height / $width * $GLOBALS["config_maxwidth"]);
              $width = $GLOBALS["config_maxwidth"];
      }
	echo "<img src=\"images_docs/".$bild."\" border=\"0\" width=\"$width\" height=\"$height\" align=\"right\" hspace=5>";
    } else
	echo "<p>";
  echo $db->f("beschreibung")."\n";
  $bx->box_body_end();
}


## doctyp():
##
## Display marginal recent docs by each type

function doctyp() {
  global $t, $bx, $db, $sess;

  $db_typ = new DB_DocsWell;
  $db_typ->query("SELECT ID,NAME FROM TYPDEF ORDER BY NAME ASC");

  if ($db_typ->num_rows() > 0) {
    while($db_typ->next_record()) {
      $typid = $db_typ->f("ID");
      $bx->box_begin();
      $bx->box_title_begin();
      echo "<center><b><a href=\"".$sess->url("docbytyp.php").$sess->add_query(array("typ" => "$typid"))."\">".$t->translate($db_typ->f("NAME"))."</a></b></center>";
      $bx->box_title_end();
      $bx->box_body_begin();

      $db->query("SELECT ID,TITEL, AENDERUNGSDATUM FROM DOKUMENT WHERE TYP='$typid' AND STATUS='A' ORDER BY AENDERUNGSDATUM DESC, ID DESC LIMIT 10");
      while($db->next_record()) {
        echo "<div class=newsind>&#149;&nbsp;";
        echo "<a href=\"".$sess->url("docbyid.php").$sess->add_query(array("id" => $db->f("ID")))."\">".$db->f("TITEL")."</a> [".strftime("%a, %e. %b, %H:%M %Z", mktimestampdw($db->f("AENDERUNGSDATUM")))."]</div>\n";
      }
      echo "<p class=\"small\"><b><a href=\"".$sess->url("docbytyp.php").$sess->add_query(array("typ" => "$typid"))."\">".$t->translate("more")."...</a></b>";
      $bx->box_body_end();
      $bx->box_end();
    }
    return 1;
  } else {
    return 0;
  }
}


## docday($start):
##
## Display marginal Document data

function docday($start) {
  global $bx, $db, $sess;

  $where = "DATE_FORMAT(AENDERUNGSDATUM,'%Y-%m-%d')=\"$start\" AND STATUS='A'";
  $db->query("SELECT ID,TITEL FROM DOKUMENT WHERE $where ORDER BY AENDERUNGSDATUM DESC, ID DESC");

  if ($db->num_rows() > 0) {
    $bx->box_begin();
    $bx->box_title_begin();
    # $time = mktime(0,0,0,substr($start,5,2),substr($start,8,2),substr($start,0,4));
    $start_content = datestr($start);
    # $start_content = strftime("%Y-%m-%d", $time);
    echo "<center><b><a href=\"".$sess->self_url().$sess->add_query(array("start" => $start_content, "days" => "1"))."\">".$start_content."</b></center></a>";

    $bx->box_title_end();
    $bx->box_body_begin();

    while($db->next_record()) {
      echo "<li><a href=\"".$sess->url("docbyid.php").$sess->add_query(array("id" => $db->f("ID")))."\">".$db->f("TITEL")."</a></li>\n";
    }
    $bx->box_body_end();
    $bx->box_end();
    return 1;
  } else {
    return 0;
  }
}


// 
//  category($selected)
//  Displays the different categories as a select form 
//  $selected ist the SELECTED section
// 

function category($selected) {
  global $db, $t;

  $db_local = new DB_DocsWell;
  $db_local->query("SELECT DISTINCT NAME FROM KATEGORIE ORDER BY NAME ASC");
  while($db_local->next_record()) {
    echo "<option";
    $db_cat = $db_local->f("NAME");
    if ($db_cat == $selected) echo " selected";
    echo ">".$t->translate($db_cat)."\n";
  }
}

// 
//  type ($selected)
//  Displays the different types as a select form 
//  $selected ist the SELECTED license
// 

function type($selected) {
  global $db, $t;

  $db_local = new DB_DocsWell;
  $db_local->query("SELECT * FROM TYPDEF ORDER BY NAME ASC");
  while ($db_local->next_record()) {
    $db_type = $db_local->f("NAME");
    echo "<option";
    if ($db_type == $selected) echo " selected";
    echo ">".$t->translate($db_type)."\n";
  }
}

// 
//  authors ($selected)
//  Displays the different authors as a select form 
//  $selected ist the SELECTED license
// 

function authors($selected) {
  global $db, $t;

  $db_local = new DB_DocsWell;
  $db_local->query("SELECT * FROM AUTOR ORDER BY NACHNAME ASC");
  while ($db_local->next_record()) {
    $db_type = $db_local->f("NACHNAME").", ".$db_local->f("VORNAME")." &lt;".$db_local->f("EMAIL")."&gt; ";
    echo "<option value=\"".$db_local->f("ID")."\" ";
    if ($db_type == $selected) echo " selected";
    echo ">".$db_type."\n";
  }
}


// 
//  format ($selected)
//  Displays the different languages as a select form 
//  $selected ist the SELECTED license
// 

function format($selected) {
  global $db;

  $db_local = new DB_DocsWell;
  $db_local->query("SELECT * FROM FORMATDEF ORDER BY NAME ASC");
  while ($db_local->next_record()) {
    $db_format = $db_local->f("NAME");
    echo "<option";
    if ($db_format == $selected) echo " selected";
    echo ">".$db_format."\n";
  }
}

// 
//  language ($selected)
//  Displays the different languages as a select form 
//  $selected ist the SELECTED license
// 

function language($selected) {
  global $db, $t;

  $db_local = new DB_DocsWell;
  $db_local->query("SELECT * FROM SPRACHEDEF ORDER BY SPRACHE ASC");
  while ($db_local->next_record()) {
    $db_lang = $db_local->f("SPRACHE");
    echo "<option";
    if ($db_lang == $selected) echo " selected";
    echo ">".$t->translate($db_lang)."\n";
  }
}

function urgency($int) {
  switch ($int) {
    case 1:
      return "low";
      break;
    case 2:
      return "medium";
      break;
    case 3:
      return "high";
      break;
    default:
      return "medium";
      break;
  }
}


## show_more($iter,$maxiter,$url,$urlquery)
##
## shows 10 apps of the current iteraction $iter
## until it reaches the maximum number of iteractions $maxiter
## $url is the name of the page (*.php)
## $urlquery contains an array with the paramaters for the new page
##            (everything after the ?)

function show_more($iter,$maxiter,$url,$urlquery) {
  global $sess;

  $iter /=10;
  echo "<table border=0 width=600><tr>";
  echo "<td>&nbsp;</td>\n";
  echo "<td align=right>";

  $maxiter= Floor($maxiter);

  if ($iter > 3) {
    echo "<a href=\"".$sess->url($url).$sess->add_query($urlquery).$sess->add_query(array("iter" => 0))."\">&lt;&lt;</a>\n";
  }

  $number = $iter - 3;
  if ($number < 0) $number = 0;
  if ($iter > 2) {
    echo "<a href=\"".$sess->url($url).$sess->add_query($urlquery).$sess->add_query(array("iter" => $number))."\">&lt;</a>\n";
  }

  switch ($iter) {
    case 0: $bias=0; break;
    case 1: $bias=1; break;
    case ($maxiter-1): if ($iter>3) {$bias=3;} else {$bias=2;} break;
    case ($maxiter): if ($iter>4) {$bias=4;} else {$bias=2;} break;
    default: $bias=2; break;
  }

  for($i=$iter-$bias;$i<$maxiter+1 && $i<($iter+5-$bias);$i++) {
    $number1 = $i*10 +1;
    $number2 = $number1 + 9;
    $number = strval($number1)."-".strval($number2);
    if ($i != $iter) {
      echo "<a href=\"".$sess->url($url).$sess->add_query($urlquery).$sess->add_query(array("iter" => $i))."\">&nbsp;$number</a>\n";
    }
    else echo "<B>&nbsp;$number</B>\n"; 
   }

  $number = $iter + 5 - $bias;
  if ($number > $maxiter+$bias) $number =$maxiter+$bias;
  if ($iter < $maxiter-4+$bias) {
    echo "<a href=\"".$sess->url($url).$sess->add_query($urlquery).$sess->add_query(array("iter" => $number))."\"> &gt;</a>\n";
  }

  $number = $iter + 10 - $bias;
  if ($number > $maxiter) $number = $maxiter;
  if ($iter < $maxiter-5 +$bias) {
    echo "<a href=\"".$sess->url($url).$sess->add_query($urlquery).$sess->add_query(array("iter" => $number))."\"> &gt;&gt;</a>\n";
  }

   echo "</td>\n";
   echo "</tr></table><BR>";
}

function wrap($string,$width=75,$break=" ") {
	$out = "";
	$lin = "";
	$tok = strtok($string,$break);
	while ($tok) {
		if ((strlen($lin) + strlen($tok)) > $width) {
			$out .= $lin."\n";
			$lin = "";
		}
		if (strlen($lin) > 0)
			$lin .= " ";
		$lin .= $tok;
		$tok = strtok (" ");
	}
	$out .= $lin;
	return $out;
}

function typestr($type) {
	global $t;
	if ($type == "S")
		$str = $t->translate("Stable");
	if ($type == "D")
		$str = $t->translate("Development");
	return $str;
}

function increasecnt($id) {
  global $db;
  
  $db->query("UPDATE DOKUMENT SET COUNTER=COUNTER+1 WHERE id='$id'");
}

function nlmsg($period) {
  global $db;

  switch ($period) {
    case "weekly":
      $lastday = time() - 7 * 24 * 60 * 60;
      $where = "DATE_FORMAT(DOKUMENT.AENDERUNGSDATUM ,'%Y-%m-%d')<=\"".date("Y-m-d")."\" AND DATE_FORMAT(DOKUMENT.AENDERUNGSDATUM ,'%Y-%m-%d')>\"".date("Y-m-d",$lastday)."\"";
      break;
    case "daily":
    default:
      $where = "DATE_FORMAT(DOKUMENT.AENDERUNGSDATUM ,'%Y-%m-%d')=\"".date("Y-m-d")."\"";
      break;
  }

  $db->query("SELECT DOKUMENT.*, SPRACHEDEF.SPRACHE as sprachestring, KATEGORIE.NAME, DATE_FORMAT(AENDERUNGSDATUM,'%d.%m.%Y') AS fdate, TYPDEF.NAME as typname FROM DOKUMENT, SPRACHEDEF, KATEGORIE, TYPDEF, auth_user WHERE $where AND SPRACHEDEF.ID=DOKUMENT.SPRACHE AND DOKUMENT.KATEGORIE=KATEGORIE.ID AND TYPDEF.ID = DOKUMENT.TYP AND DOKUMENT.ANGELEGTVON=auth_user.username AND DOKUMENT.STATUS ='A' ORDER BY DOKUMENT.AENDERUNGSDATUM DESC"); 
  if ($db->num_rows() <= 0) return 0;

  $msg = $GLOBALS["sys_name"]." $period newsletter for ".date("l, dS of F Y, H:i:s T")."\n";
  $msg .= "Number of announcements: ".$db->num_rows()."\n";
  $msg .= "\n               -----------------------------\n";
  $msg .= "                   Documentation Headlines\n";
  $msg .= "               -----------------------------\n\n";
	
  $i = 1;
  while($db->next_record()) {
    $msg .= "$i: ".$db->f("TITEL")."\n";
    $i++;
  }

  $msg .= "\n               -----------------------------\n";
  $msg .= "                   Documentation Details\n";
  $msg .= "               -----------------------------\n";

//  @mysql_data_seek($result, 0);
  $db->seek(0);

  $i = 1;
  while ($db->next_record()) {
    list ($ejahr, $emonat, $etag) = split ('[-]', $db->f("ERSTELLUNGSDATUM"));  
    $msg .= "\nAnnouncement : $i\n";
    $msg .= "Title        : ".$db->f("TITEL")."\n";
    $msg .= "Date         : ".$db->f("fdate")."\n";
    $msg .= "Type         : ".$db->f("typname")."\n";

    # Kategoriedaten
    $dbKat = new DB_DocsWell;
    $cat_path = "";
    $dbKat->query("SELECT * FROM KATEGORIE WHERE ID=".$db->f("KATEGORIE"));
    $dbKat->next_record();
    $parent = $dbKat->f("PARENT_ID");
    if ($parent) {
	  $pfad = array();
	  while ($parent != 1) {
		array_unshift ($pfad,$dbKat->f("NAME"));
		$dbKat->query("SELECT * FROM KATEGORIE WHERE ID=$parent");
		$dbKat->next_record();
		$parent = $dbKat->f("PARENT_ID");
	  }
	  array_unshift ($pfad,$dbKat->f("NAME"));
	  $anz = count($pfad);
	
	  $counter = 0;
	  foreach ($pfad as $onestep) {
	    $counter++;
	    if ($counter == $anz) {
		  $dbKat->query("SELECT * FROM KATEGORIE WHERE NAME='$onestep'");
		  $dbKat->next_record();
	    }
		$cat_path .= ":: $onestep ";
      }
	  $cat_path = substr ($cat_path,3);  
    } else $cat_path = "Category does not exist";
    $msg .= "Category     : $cat_path\n";

    $msg .= "Language     : ".$db->f("sprachestring")."\n";

  	//Autoren besorgen
  	$dbAut = new DB_DocsWell;
  	$Sql = "SELECT a.vorname, a.nachname, a.email FROM AUTOR a, AUTOR_DOKUMENT ad WHERE ad.autor_id=a.id AND ad.dokument_id=".$db->f("ID");
	$dbAut->query($Sql);
	$anz = $dbAut->num_rows();

	if ($anz > 0) { //Autoren ausgeben
		$msg .= "Author       : ";
  		$counter = 0; 
  		while ($dbAut->next_record()) {
			$counter++;
			if ($dbAut->f("vorname") != "") $msg .= $dbAut->f("vorname")." ";
			$msg .= $dbAut->f("nachname");
			if ($counter < $anz) $msg .= "\n               ";
  		}
	 }
	 $msg .= "\n";
         //$msg .= "\nDescription  : \n".wrap($db->f("BESCHREIBUNG"))."\n";
         //$msg .= "\n";
    $msg .= $GLOBALS["sys_name"]."     : ".$GLOBALS["sys_url"]."docbyid.php?id=".$db->f("ID")."\n";
    $msg .= "\n               -----------------------------\n";
    $i++;
  }
  $msg .= "\nYou get this ".$GLOBALS["sys_name"]." $period newsletter,"
  ."\nbecause you have subscribed to the mailing list ";

  switch ($period) {
    case "weekly":
      $msg .= "\n".$GLOBALS["ml_weeklynewstoaddr"]."."
      ."\nTo unsubscribe from this mailing list,"
      ."\nsend a message by email to"
      ."\n".$GLOBALS["ml_weeklynewsreqaddr"]
      ."\nwith \"unsubscribe <password>\" as subject or visit"
      ."\n".$GLOBALS["ml_weeklylisturl"];
      break;
    case "daily":
    default:
      $msg .= "\n".$GLOBALS["ml_newstoaddr"]."."
      ."\nTo unsubscribe from this mailing list,"
      ."\nsend a message by email to"
      ."\n".$GLOBALS["ml_newsreqaddr"]
      ."\nwith \"unsubscribe <password>\" as subject or visit"
      ."\n".$GLOBALS["ml_listurl"];
      break;
  }
  $msg .= "\nand follow the instructions there."
  ."\n\n - ".$GLOBALS["sys_name"]." crew";

  return $msg;
}

function mailuser($perms, $subj, $message) {
  global $t, $db;
  $db->query("SELECT email_usr FROM auth_user WHERE perms LIKE '%$perms%'");
  while($db->next_record()) {
    mail($db->f("email_usr"),"[".$GLOBALS["sys_name"]."] ".$subj,$message,"From: ".$GLOBALS["ml_fromaddr"]."\nReply-To: ".$GLOBALS["ml_replyaddr"]."\nX-Mailer: PHP");
  }
}

//############## maketree #######################################################################
//# $parent 	= Wo der Baum beginnen soll							#
//# $open 	= Array von allen offenen Zweigen						#
//# $level	= Auf welcher Stufe des Baumes wir sind						#
//# $mode	= Art-ID des Baumes								#
//# $aid	= Dokument ID, bei Link, die eine id brauchen					#
//###############################################################################################

function maketree ($parent, $open, $level, $mode=1, $aid=0, $add_string="") {

 	if ($mode == 9) $link = "searchform.php";
	if ($mode == 8) $link = "admcat.php";	
	if ($mode == 7) $link = "admcat.php";	
	if ($mode == 6) $link = "admcat.php";
	if ($mode == 5) $link = "edit_modified.php";
	if ($mode == 4) $link = "update_online.php";
	if ($mode == 3) $link = "edit_new.php";
	if ($mode == 2) $link = "insform.php";
	if ($mode == 1) $link = "docbycat.php";


	global $PHP_SELF, $t;
	//$open = array_unique ($open);
	$db = new DB_DocsWell;
	$db_leave = new DB_DocsWell;
	$Sql = "SELECT * FROM KATEGORIE WHERE PARENT_ID='$parent' ORDER BY name ASC";
	$db->query($Sql);
	while($db->next_record()) {
		for ($i=0;$i<$level;$i++)
		if ($level > $i) {
			echo "&nbsp;<img src=\"images/dirnext.png\" alt=\":\">";
			if ($level == $i+1) 
				echo "&nbsp;<img src=\"images/dirleave.png\" alt=\"...\">";	
			else 
				echo "&nbsp;&nbsp;&nbsp;";
		}

		//##########
		$Sql = "SELECT COUNT(*) AS cnt FROM KATEGORIE WHERE PARENT_ID='".$db->f("ID")."'";
		$db_leave->query($Sql);
		$db_leave->next_record();
		$cnt = $db_leave->f("cnt");
		//##########

		if (($cnt > 0) && ($open[$db->f("ID")] != 1)) {
			echo "&nbsp;<a href=\"categories.php?";
			foreach (array_keys($open) as $onekey) 
				echo "pn[".$onekey."]=".$open[$onekey]."&";
			echo "pn[".$db->f("ID")."]=1&mode=$mode&aid=$aid&add_string=".urlencode($add_string);
			echo "\">";
		} elseif (($cnt > 0) && ($open[$db->f("ID")] == 1)) {
			echo "&nbsp;<a href=\"categories.php?";
			foreach (array_keys($open) as $onekey) {
				if ($onekey != $db->f("ID"))
				echo "pn[".$onekey."]=".$open[$onekey]."&";
			}
			echo "mode=$mode&aid=$aid&add_string=".urlencode($add_string);
			echo "\">";
		} 

		if (($cnt > 0) && ($open[$db->f("ID")] != 1)) {
			echo "<img src=\"images/diropen.png\" border=\"0\" alt=\"[+]\"></a>";
		}
		elseif (($cnt > 0) && ($open[$db->f("ID")] == 1)) {
			echo "<img src=\"images/dirclose.png\" border=\"0\" alt=\"[-]\"></a>";
		}

		if (($cnt == 0) || (($mode >5) && ($mode<9))) {
			$Sql = "SELECT COUNT(*) AS cnt2 FROM DOKUMENT WHERE KATEGORIE='".$db->f("ID")."' AND STATUS<>'D'";
			$db_leave->query($Sql);
			$db_leave->next_record();
			$cnt2 = $db_leave->f("cnt2");
			if (($cnt2 > 0) || ($mode > 1)) {
				echo "&nbsp;<a href=\"$link?category=".$db->f("ID")."&".urldecode($add_string);
				if ($mode==3) echo "&ID=$aid&status=edit_new";
				if ($mode==4) echo "&ID=$aid";
				if ($mode==5) echo "&ID=$aid&status=edit_new";
				if ($mode==6) echo "&mode=1&cnt=$cnt2";
				if ($mode==7) echo "&mode=2";
				if ($mode==8) echo "&mode=3&cnt=$cnt2";
				if ($mode==8) echo "&mode=3&cnt=$cnt2";
				//if ($mode==9) echo "&".$add_string;
				echo "\">".$t->translate($db->f("NAME"))."</a>";
			} else 
				echo "&nbsp;".$t->translate($db->f("NAME"));
			echo "&nbsp;[".$cnt2."]";
		} else
			echo "&nbsp;".$t->translate($db->f("NAME"));
		echo "<br>\n";


		if ($open[$db->f("ID")]==1) 
			maketree ($db->f("ID"),$open,$level+1,$mode,$aid,$add_string);
	}
}
?>
