<?php

######################################################################
# DevCounter: Open Source Developer Counter
# ===================================================================
#
# Copyright (c) 2002 by
#                Lutz Henckel (lutz.henckel@fokus.fhg.de)
#
# BerliOS DevCounter: http://devcounter.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Install system and check configuration
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
#
# $Id: install.php,v 1.2 2002/10/01 11:09:24 helix Exp $
#
######################################################################  

require("./include/config.inc");

$dbconfile = "./include/local.inc";
$prependfile = "./include/prepend.php3";
$phplibdefault = "/usr/share/php/phplib/";

function status($foo) {
    if ($foo) {
        echo '<font color="green"><b>Yes</b></font>';
    } else {
        echo '<font color="red"><b>No</b></font>';
    }
}

function get_perms($mode) {
	$owner["read"]    = ($mode & 00400) ? 'r' : '-';
	$owner["write"]   = ($mode & 00200) ? 'w' : '-';
	$owner["execute"] = ($mode & 00100) ? 'x' : '-';
	$group["read"]    = ($mode & 00040) ? 'r' : '-';
	$group["write"]   = ($mode & 00020) ? 'w' : '-';
	$group["execute"] = ($mode & 00010) ? 'x' : '-';
	$world["read"]    = ($mode & 00004) ? 'r' : '-';
	$world["write"]   = ($mode & 00002) ? 'w' : '-';
	$world["execute"] = ($mode & 00001) ? 'x' : '-';

	/* Adjust for SUID, SGID and sticky bit */
	if( $mode & 0x800 )
		$owner["execute"] = ($owner[execute]=='x') ? 's' :
'S';
	if( $mode & 0x400 )
		$group["execute"] = ($group[execute]=='x') ? 's' :
'S';
	if( $mode & 0x200 )
		$world["execute"] = ($world[execute]=='x') ? 't' :
'T';

	$perms .= sprintf("%1s%1s%1s", $owner[read], $owner[write], $owner[execute]);
	$perms .= sprintf("%1s%1s%1s", $group[read], $group[write], $group[execute]);
	$perms .= sprintf("%1s%1s%1s\n", $world[read], $world[write], $world[execute]);
	return $perms;
}

if (!isset($action)) {
	$action = "";
}

switch ($action) {

/* View PHP configuration */

case "view_phpinfo":
	require("./install/header.inc");
	echo "<p>[ <a href=\"install.php\">Go back</a> ] [ <a href=\"install.php?action=check_php\">Next</a> ]<p>\n";
    phpinfo();
    exit;
	break;

/* Check PHP */

case "check_php":
	require("./install/header.inc");
	require("./install/check_php.php");
	break;

/* Set path to PHPlib */

case "set_phplib":
	require("./install/header.inc");
	if (!isset($op)) {
		$op = "";
	}
	switch ($op) {
	case "set":
		require("./install/set_phplib_set.php");
		break;
	case "":
	default:
		require("./install/set_phplib.php");
		break;
	}
	break;

/* Check PHPlib */

case "check_phplib":
	require("./install/header.inc");
	require("./install/check_phplib.php");
	break;

/* Check DevCounter Session */

case 'check_session':
	require("./include/prepend.php3");
	require("./include/prepend.php3"); page_open(array('sess' => 'DevCounter_Session'));
	require("./install/header.inc");
	require("./install/check_session.php");
	page_close();
	break;

/* Check Database */

case "check_db":
	require("./include/prepend.php3");
	require("./install/header.inc");
	require("./install/check_db.php");
	break;

/* Create Database User */

case "create_dbusr":
	require("./include/prepend.php3");
	require("./install/header.inc");
	if (!isset($op)) {
		$op = "";
	}
	switch ($op) {
	case "set":
		require("./install/create_dbusr_set.php");
		break;
	case "":
	default:
		require("./install/create_dbusr.php");
		break;
	}
	break;

/* Create Database */

case "create_db":
	require("./include/prepend.php3");
	require("./install/header.inc");
	if (!isset($op)) {
		$op = "";
	}
	switch ($op) {
	case "set":
		require("./install/create_db_set.php");
		break;
	case "":
	default:
		require("./install/create_db.php");
		break;
	}
	break;

case "default":
default:
	require("./install/header.inc");
	$mode = fileperms($dbconfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<p><font color=\"green\">Database configuration file $dbconfile has correct ".get_perms($mode)." permissions.\n";
			echo "<br>Go ahead.\n";
		} else {
			echo "<p><font color=\"red\">Database configuration file $dbconfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-rw-rw and try again!</font>\n";
		}
	}
	$mode = fileperms($prependfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<p><font color=\"green\">PHPlib prepend file $prependfile has correct ".get_perms($mode)." permissions.\n";
			echo "<br>Go ahead.\n";
		} else {
			echo "<p><font color=\"red\">PHPlib prepend file $prependfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-rw-rw and try again!</font>\n";
		}
	}
?>
<ol>
<li><a href="install.php?action=view_phpinfo">View PHP configuration</a>
<li><a href="install.php?action=check_php">Check PHP</a>
<li><a href="install.php?action=set_phplib">Set path to PHPlib</a>
<li><a href="install.php?action=check_phplib">Check PHPlib</a>
<li><a href="install.php?action=create_dbusr">Create <?php echo $sys_name?> Database User</a>
<li><a href="install.php?action=create_db">Create <?php echo $sys_name?> Database</a>
<li><a href="install.php?action=check_db">Check <?php echo $sys_name?> Database</a>
<li><a href="install.php?action=check_session">Check PHPlib Session</a>
</ol>
<?php
	break;
}
?>
</body>
</html>
