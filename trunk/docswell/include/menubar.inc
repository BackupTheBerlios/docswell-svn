<!-- BerliOS menu -->
<table BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
<tr BGCOLOR="<?php echo $th_navstrip_bgcolor;?>">
<td ALIGN=CENTER>
<span class="titlebar"><font color="<?php echo $th_navstrip_font_color;?>"><?php echo $sys_name?></font></span></td>
</tr>

<tr ALIGN=RIGHT BGCOLOR="<?php echo $th_nav_bgcolor;?>">
<td><a href="<?php $sess->purl("index.php") ?>" class="menus"><?php echo $t->translate("Home"); ?></a>
<br><a href="<?php $sess->purl("faq.php") ?>" class="menus"><?php echo $t->translate("Q&amp;A"); ?></a>

<br><br>

<?php
if (isset($auth) && !empty($auth->auth["perm"]) && !($logout) ) {
  if ($perm->have_perm("user") || $perm->have_perm("user_pending") || $perm->have_perm("editor") || $perm->have_perm("admin") || $perm->have_perm("anonymous")) {
?>
<a href="<?php $sess->purl("logout.php") ?>" class="menus"><?php echo $t->translate("Logout"); ?></a>
<?php
  }
} else {
?>
<a href="<?php $sess->purl("login.php") ?>" class="menus"><?php echo $t->translate("Login"); ?></a>
<?php
}
?>
<br><a href="<?php $sess->purl("register.php") ?>" class="menus"><?php echo $t->translate("New User"); ?></a>
<br><a href="<?php $sess->purl("remind.php") ?>" class="menus"><?php echo $t->translate("Forgot Password"); ?></a>
<?php
if (isset($auth) && !empty($auth->auth["perm"]) && !($logout)) {
	if (($perm->have_perm("user") || $perm->have_perm("user_pending") || $perm->have_perm("editor") || $perm->have_perm("admin")) && !($perm->have_perm("anonymous"))) {
?>
<br><a href="<?php $sess->purl("chguser.php") ?>" class="menus"><?php echo $t->translate("Change User"); ?></a>
<?php
	}
}

if (($config_perm_users == "all") || (isset($perm) && $perm->have_perm($config_perm_users))  && !($logout)) {
?>
<br><a href="<?php $sess->purl("users.php") ?>" class="menus"><?php echo $t->translate("Users"); ?></a>
<?php
}
?>
</td>
</tr>
</table>
<table BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
<tr BGCOLOR="<?php echo $th_navstrip_bgcolor;?>">
<td ALIGN=CENTER>
<span class="titlebar"><font color="<?php echo $th_navstrip_font_color;?>"><?php echo $t->translate("Documents"); ?></font></span></td>
</tr>

<tr ALIGN=RIGHT BGCOLOR="<?php echo $th_nav_bgcolor;?>">
<td>
<?php
echo "<a href=\"".$sess->url("index.php")."\" class=\"menus\">".$t->translate("Recent Docs")."</a>\n";
echo "<br><a href=\"".$sess->url("insform.php")."\" class=\"menus\">".$t->translate("New Doc")."</a>\n";
echo "<br><a href=\"".$sess->url("docbyuser.php")."\" class=\"menus\">".$t->translate("Update Doc")."</a>\n";

if (($config_perm_developer == "all") || (isset($perm) && $perm->have_perm($config_perm_developer))  && !($logout)) {
  echo "<br><a href=\"".$sess->url("developers.php")."\" class=\"menus\">".$t->translate("Authors")."</a>\n";
}
?>
<br><a href="<?php $sess->purl("typs.php") ?>" class="menus"><?php echo $t->translate("Types"); ?></a>
<br><a href="<?php $sess->purl("categories.php") ?>" class="menus"><?php echo $t->translate("Categories"); ?></a>
<br>
<?php
if ($ml_list) {
  echo "<br><a href=\"".$sess->url("newsletter.php")."\" class=\"menus\">".$t->translate("Newsletter")."</a>\n";
}
?>
<br><a href="<?php $sess->purl("backend.php"); ?>" class="menus"><?php echo $t->translate("Backend"); ?></a>
</td>
</tr>
</table>
<!-- end BerliOS menu -->
<!-- Editor menue // -->
<?php
if (isset($perm)) {
if (( ($perm->have_perm("editor")) || ($perm->have_perm("admin"))) && !($logout)) {

?>
<table BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
<tr BGCOLOR="<?php echo $th_navstrip_bgcolor;?>">
<td ALIGN=CENTER><img SRC="images/blank.gif" height="1" width="135" border=0><br>
<span class="titlebar"><font color="<?php echo $th_navstrip_font_color;?>"><?php echo $t->translate("Editor"); ?></font></span></td>
</tr>
<tr ALIGN=RIGHT BGCOLOR="<?php echo $th_nav_bgcolor;?>">
  <td>
  <?php 
	$db->query("SELECT COUNT(*) FROM PENDING WHERE status='N'");
	$db->next_record();
	echo "<a href=\"".$sess->url("edit_new.php")."\" class=\"menus\">".$t->translate("Verify new")." [".$db->f("COUNT(*)")."]</a>\n";
  ?>
  </td>
</tr>
<tr ALIGN=RIGHT BGCOLOR="<?php echo $th_nav_bgcolor;?>">
  <td>
  <?php 
	$db->query("SELECT COUNT(*) FROM PENDING WHERE status='M'");
	$db->next_record();
	echo "<a href=\"".$sess->url("edit_modified.php")."\" class=\"menus\">".$t->translate("Verify modified")." [".$db->f("COUNT(*)")."]</a>\n";
  ?>
  </td>
</tr>
<tr ALIGN=RIGHT BGCOLOR="<?php echo $th_nav_bgcolor;?>">
  <td>
  <?php 
	$db->query("SELECT COUNT(*) FROM DOKUMENT WHERE status='D'");
	$db->next_record();
	echo "<a href=\"".$sess->url("delete_entry.php")."\" class=\"menus\">".$t->translate("Delete entry")." [".$db->f("COUNT(*)")."]</a>\n";
  ?>
  </td>
</tr>
</table>
<?php }  }?>
<!-- Ende Editor menue // -->
<!-- Admin menu -->
<?php

if (
    (($config_perm_admuser == "all") ||
       ($config_perm_admlicens == "all") ||
       ($config_perm_admcomment == "all") ||
       ($config_perm_admsec == "all") ||
       ($config_perm_admcat == "all") ||
       ($config_perm_nladm == "all") ||
       ($config_perm_admfaq == "all") ||
       ($config_perm_configure == "all"))
  || (isset($perm) &&
       (($perm->have_perm($config_perm_admuser)) ||
        ($perm->have_perm($config_perm_admlicens)) ||
        ($perm->have_perm($config_perm_admcomment)) ||
        ($perm->have_perm($config_perm_admsec)) ||
        ($perm->have_perm($config_perm_admcat)) ||
        ($perm->have_perm($config_perm_nladm)) ||
        ($perm->have_perm($config_perm_admfaq)) ||
        ($perm->have_perm($config_perm_configure) ) ))
  && !($logout)) {

?>
<table BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
<tr BGCOLOR="<?php echo $th_navstrip_bgcolor;?>">
<td ALIGN=CENTER><img SRC="images/blank.gif" height="1" width="135" border=0><br>
<span class="titlebar"><font color="<?php echo $th_navstrip_font_color;?>"><?php echo $t->translate("Administration"); ?></font></span></td>
</tr>

<tr ALIGN=RIGHT BGCOLOR="<?php echo $th_nav_bgcolor;?>">
<td>
<?php

  if (($config_perm_admuser == "all") || (isset($perm) && $perm->have_perm($config_perm_admuser))  && !($logout)) {
    echo "<a href=\"".$sess->url("admstatus.php")."\" class=\"menus\">".$t->translate("Check status")."</a>\n";
  }

  if (($config_perm_admuser == "all") || (isset($perm) && $perm->have_perm($config_perm_admuser))  && !($logout)) {
    $db->query("SELECT COUNT(*) FROM auth_user");
    $db->next_record();
    echo "<br><a href=\"".$sess->url("admuser.php")."\" class=\"menus\">".$t->translate("Users")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_admlang == "all") || (isset($perm) && $perm->have_perm($config_perm_admlang))  && !($logout)) {
    $db->query("SELECT COUNT(*) FROM AUTOR");
    $db->next_record();
    echo "<br><a href=\"".$sess->url("admauthor.php")."\" class=\"menus\">".$t->translate("Authors")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_admlang == "all") || (isset($perm) && $perm->have_perm($config_perm_admlang))  && !($logout)) {
    $db->query("SELECT COUNT(*) FROM SPRACHEDEF");
    $db->next_record();
    echo "<br><a href=\"".$sess->url("admlang.php")."\" class=\"menus\">".$t->translate("Languages")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_admtype == "all") || (isset($perm) && $perm->have_perm($config_perm_admtype))  && !($logout)) {
    $db->query("SELECT COUNT(*) FROM TYPDEF");
    $db->next_record();
    echo "<br><a href=\"".$sess->url("admtyp.php")."\" class=\"menus\">".$t->translate("Types")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_admformat == "all") || (isset($perm) && $perm->have_perm($config_perm_admformat))  && !($logout)) {
    $db->query("SELECT COUNT(*) FROM FORMATDEF");
    $db->next_record();
    echo "<br><a href=\"".$sess->url("admformat.php")."\" class=\"menus\">".$t->translate("Formats")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_admcat == "all") || (isset($perm) && $perm->have_perm($config_perm_admcat))  && !($logout)) {
    $db->query("SELECT COUNT(*) FROM KATEGORIE");
    $db->next_record();
    echo "<br><a href=\"".$sess->url("admcat.php")."\" class=\"menus\">".$t->translate("Categories")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_admcomment == "all") || (isset($perm) && $perm->have_perm($config_perm_admcomment))  && !($logout)) {
    $db->query("SELECT COUNT(*) FROM KOMMENTAR");
    $db->next_record();
    echo "<br><a href=\"".$sess->url("admcomment.php")."\" class=\"menus\">".$t->translate("Comments")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_admfaq == "all") || (isset($perm) && $perm->have_perm($config_perm_admfaq))  && !($logout)) {
    $db->query("SELECT COUNT(*) FROM faq WHERE language='$la'");
    $db->next_record();
    echo "<br><a href=\"".$sess->url("admfaq.php")."\" class=\"menus\">".$t->translate("Q&amp;A")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_nladm == "all") || (isset($perm) && $perm->have_perm($config_perm_nladm))  && !($logout) && ($ml_list)) {
				// Daily Newsletter
    $where = "DATE_FORMAT(DOKUMENT.AENDERUNGSDATUM,'%Y-%m-%d')=\"".date("Y-m-d")."\"";
    $db->query("SELECT COUNT(*) FROM DOKUMENT WHERE $where AND STATUS='A'"); 
    $db->next_record();
    echo "<br><a href=\"".$sess->url("nladm.php?period=daily")."\" class=\"menus\">".$t->translate("Daily Newsletter")." [".$db->f("COUNT(*)")."]</a>\n";
				// Weekly Newsletter
    $lastday = time() - 7 * 24 * 60 * 60;
    $where = "DATE_FORMAT(DOKUMENT.AENDERUNGSDATUM,'%Y-%m-%d')<=\"".date("Y-m-d")."\" AND DATE_FORMAT(DOKUMENT.AENDERUNGSDATUM,'%Y-%m-%d')>\"".date("Y-m-d",$lastday)."\"";
    $db->query("SELECT COUNT(*) FROM DOKUMENT WHERE $where AND STATUS='A'"); 
    $db->next_record();
    echo "<br><a href=\"".$sess->url("nladm.php?period=weekly")."\" class=\"menus\">".$t->translate("Weekly Newsletter")." [".$db->f("COUNT(*)")."]</a>\n";
  }

  if (($config_perm_configure == "all") || (isset($perm) && $perm->have_perm($config_perm_configure))  && !($logout)) {
    echo "<br><a href=\"".$sess->url("configure.php")."\" class=\"menus\">".$t->translate("Configure")."</a>\n";
  }

?>
</td>
</tr>
</table>
<?php
}
?>
<!-- end Admin menu -->
<!-- Search menu -->
<table BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
<tr BGCOLOR="<?php echo $th_navstrip_bgcolor;?>">
<td ALIGN=CENTER><img SRC="images/blank.gif" height="1" width="135" border=0><br>
<span class="titlebar"><font color="<?php echo $th_navstrip_font_color;?>"><?php echo $t->translate("Search"); ?></font></span></td>
</tr>

<tr ALIGN=RIGHT BGCOLOR="<?php echo $th_nav_bgcolor;?>">
<td align=center>
<p>
<form action="<?php $sess->purl("docsearch.php"); ?>">
<input TYPE="text" SIZE="10" NAME="search" VALUE="">
<?php
echo "<p><input TYPE=\"submit\" NAME=\"Search\" VALUE=\"".$t->translate("Search")."\">";
?>
</form>
<p align=right><a href="<?php $sess->purl("searchform.php"); ?>" class="menus"><?php echo $t->translate("Advanced Search"); ?></a>
<br><a href="<?php $sess->purl("/cgi-bin/dwsearch"); ?>" class="menus" target="_blank"><?php echo $t->translate("Document Search"); ?></a>
</td>
</tr>
</table>
<!-- end Search menu -->
<!-- Language menu -->
<table BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
<tr BGCOLOR="<?php echo $th_navstrip_bgcolor;?>">
<td ALIGN=CENTER><img SRC="images/blank.gif" height="1" width="135" border=0><br>
<span class="titlebar"><font color="<?php echo $th_navstrip_font_color;?>"><?php echo $t->translate("Language");?></font></span></td>
</tr>

<tr ALIGN=RIGHT BGCOLOR="<?php echo $th_nav_bgcolor;?>">
<td align=center>
<p>
<form action="<?php $sess->pself_url()?>">
<?php
while (is_array($HTTP_GET_VARS) 
		&& list($key, $val) = each($HTTP_GET_VARS)) {
	if ($key != "lang" && $key != "go") {
		echo "<input TYPE=\"hidden\" NAME=\"$key\" VALUE=\"$val\">\n";
	}
}
?>
<select name="lang" size=1>
<?php
while (list(, $ln) = each($la_array)) {
	if ($la == $ln) {
		$sel = "selected";
	} else {
		$sel ="";
	}
	echo "<option value=\"$ln\" $sel>".$t->translate($ln)."\n";
}
?>
</select>
<?php
echo "<p><input TYPE=\"submit\" NAME=\"go\" VALUE=\"".$t->translate("Go")."\">";
?>
</form>
</td>
</tr>
</table>
<?php
if (ereg("Gecko", "$HTTP_USER_AGENT")) {
	echo "<p align=center><a href=\"javascript:addNetscapePanel();\"><img SRC=\"images/add-button.gif\" BORDER=0 height=45 width=100></a>\n";
}
echo "<p align=\"center\"><a href=\"http://developer.berlios.de\">
<img src=\"http://developer.berlios.de/bslogot.php?group_id=99&type=1\" width=\"124\" height=\"32\" border=\"0\" hspace=\"3\" vspace=\"3\" alt=\"BerliOS Logo\"></a>\n";
?>
<!-- end Language menu -->
