<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#		 Christian Schmidt (schmidt@mallux.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Search documents by their name
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

require("./include/prepend.php3");

if ($select_cat) { 
	$add_string = "search=$search&Sprache=$Sprache&typ=$typ&format=$format&Autor=$Autor"; 
	$mode=9;
	include ('categories.php');	
	exit; 
} 

page_open(array("sess" => "DocsWell_Session"));
if (isset($auth) && !empty($auth->auth["perm"])) {
  @page_close();
  page_open(array("sess" => "DocsWell_Session",
                  "auth" => "DocsWell_Auth",
                  "perm" => "DocsWell_Perm"));
}

require("./include/header.inc");

$bx = new box("100%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_body_font_color,$th_box_body_align);
$bs = new box("100%",$th_strip_frame_color,$th_strip_frame_width,$th_strip_title_bgcolor,$th_strip_title_font_color,$th_strip_title_align,$th_strip_body_bgcolor,$th_strip_body_font_color,$th_strip_body_align);
$be = new box("",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php

      // When there's a search for a blank line, we look for "xxxxxxxx"
if ((!isset($search) || $search=="") && (!$format || $format==-1) && (!$Sprache || $Sprache==-1) && (!$typ || $typ==-1) && (!$kategorie || $kategorie==-1) && (!$Autor || $Autor==-1)) {
  $search = "xxxxxxxx";
}

// $iter is a variable for printing the Top Statistics in steps of 10 apps
if (!isset($iter)) $iter=0;
$iter*=10;

$flag=0;

 $Cquery = "SELECT COUNT(*) FROM DOKUMENT a, KATEGORIE z ";

 $columns = " distinct a.TITEL AS titel, a.BESCHREIBUNG as beschreibung, a.COUNTER AS downloads, a.SPRACHE as sprache,  a.KATEGORIE AS KatID, a.ERSTELLUNGSDATUM as erdatum,  a.AENDERUNGSDATUM as aendatum, a.TYP as DocType, a.ID as id, a.ANGELEGTVON, c.NAME as KategorieName, d.NAME as TypName, a.BILD as BILD, a.BILD_REFERENZ as BILD_REFERENZ ";
 $tables = "DOKUMENT a, FORMAT b, KATEGORIE c, TYPDEF d ";
 $where = "a.STATUS!='D' AND a.ID = b.DOKUID and a.KATEGORIE = c.ID and a.TYP = d.ID "; 

 if ($Autor && $Autor!=-1) {
   $Cquery .= ", AUTOR e, AUTOR_DOKUMENT f ";
   $tables .= ", AUTOR e, AUTOR_DOKUMENT f ";
 }
  
 if($format && $format!=-1) {
   $Cquery .= ", FORMAT b where a.STATUS!='D' AND a.ID = b.DOKUID AND b.FORMATID = $format ";
   $where .= "and b.FORMATID = $format ";
   $flag=1;
 }

 if($search && $search != "") {
   if ($flag != 0) {
      $Cquery .= " AND (ucase(a.TITEL) like ucase('%$search%') OR ucase(a.BESCHREIBUNG) like ucase('%$search%')) ";
   } else {
      $Cquery .= " where a.STATUS!='D' AND (ucase(a.TITEL) like ucase('%$search%') OR ucase(a.BESCHREIBUNG) like ucase('%$search%')) ";
   }
   $where .= " AND (ucase(a.TITEL) like ucase('%$search%') OR ucase(a.BESCHREIBUNG) like ucase('%$search%')) ";
   $flag=1;
 }


 if ($Sprache && $Sprache!=-1) {
   if ($flag != 0) {
      $Cquery .= " AND a.SPRACHE=$Sprache ";
   } else {
      $Cquery .= " where a.STATUS!='D' AND a.SPRACHE=$Sprache ";
   }
   $where .= " AND a.SPRACHE=$Sprache ";
   $flag=1;
 } 

 if ($Autor && $Autor!=-1) {
   if ($flag != 0) {
      $Cquery .= " AND e.ID=$Autor AND e.ID=f.AUTOR_ID AND a.ID=f.DOKUMENT_ID  ";
   } else {
      $Cquery .= " where a.STATUS!='D' AND e.ID=$Autor AND e.ID=f.AUTOR_ID AND a.ID=f.DOKUMENT_ID  ";
   }
   $where .= " AND e.ID=$Autor AND e.ID=f.AUTOR_ID AND a.ID=f.DOKUMENT_ID ";
   $flag=1;
 }

 if ($typ && $typ!=-1) {
   if ($flag != 0) {
      $Cquery .= " AND a.TYP=$typ  ";
   } else {
      $Cquery .= " where a.STATUS!='D' AND a.TYP=$typ ";
   }
   $where .= " AND a.TYP=$typ ";
   $flag=1;
 }

 if ($kategorie && $kategorie!=-1) {
   if ($flag != 0) {
      $Cquery .= " AND a.KATEGORIE=$kategorie ";
   } else {
      $Cquery .= " where a.STATUS!='D' AND a.KATEGORIE=$kategorie ";
   }
   $where .= " AND a.KATEGORIE=$kategorie ";
   $flag=1;
 }

                        // We need to know the total number of apps

//echo "<br><br><br>$Cquery\n<br><br><br>";

$db->query($Cquery." AND z.id=a.KATEGORIE ");
//echo $Cquery;
//echo $Cquery;
$db->next_record();
$cnt = $db->f("COUNT(*)");
//echo $cnt."<<<<<<<<<<<<<<<<<<<<<<<";
if ($cnt == 0) {
  $bx->box_full($t->translate("Search"),$t->translate("No Documents found"));
} else {



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


  $numiter = (($cnt-1)/10);


  $limit = "$iter,10";

  $sort = "(".$cnt.") ";
  $sort .= $t->translate("sorted by").": "
  ."<a href=\"".$sess->url("docsearch.php").$sess->add_query(array("search" => $search, "Sprache" => $Sprache, "typ" => $typ, "format" => $format, "Autor" => $Autor, "kategorie" => $kategorie, "by" => "Date"))."\">".$t->translate("Date")."</a>"
//  ." | <a href=\"".$sess->url("docsearch.php").$sess->add_query(array("search" => $search, "Sprache" => $Sprache, "typ" => $typ, "format" => $format, "Autor" => $Autor, "kategorie" => $kategorie, "by" => "Author"))."\">".$t->translate("Author")."</a>"
  ." | <a href=\"".$sess->url("docsearch.php").$sess->add_query(array("search" => $search, "Sprache" => $Sprache, "typ" => $typ, "format" => $format, "Autor" => $Autor, "kategorie" => $kategorie, "by" => "Category"))."\">".$t->translate("Category")."</a>\n"
  ." | <a href=\"".$sess->url("docsearch.php").$sess->add_query(array("search" => $search, "Sprache" => $Sprache, "typ" => $typ, "format" => $format, "Autor" => $Autor, "kategorie" => $kategorie, "by" => "Typ"))."\">".$t->translate("Type")."</a>\n"
  ." | <a href=\"".$sess->url("docsearch.php").$sess->add_query(array("search" => $search, "Sprache" => $Sprache, "typ" => $typ, "format" => $format, "Autor" => $Autor, "kategorie" => $kategorie, "by" => "Name"))."\">".$t->translate("Title")."</a>\n";
    $bs->box_strip($sort);

  $query="SELECT $columns FROM $tables WHERE $where ORDER BY $order LIMIT $limit";
//  echo "<br><br><br>$query\n<br><br><br>";
  //echo $query;
  docdat($query);

}
if ($numiter > 1) {
  $url = "docsearch.php";
  $urlquery = array("search" => ($search), "by" => $by, "Sprache" => $Sprache, "format" => $format, "Autor" => $Autor, "typ" => $typ, "kategorie" => $kategorie);
  show_more ($iter,$numiter,$url,$urlquery);
}

?>
<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
