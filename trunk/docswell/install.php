<?php

######################################################################
# DocsWell: Document Announcement and Retrieval System
# ===================================================================
#
# Copyright (c) 2002 by
#                Lutz Henckel (lutz.henckel@fokus.fhg.de)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Install system and check configuration
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
#
# $Id: install.php,v 1.4 2002/10/04 16:43:04 helix Exp $
#
######################################################################  

require("./include/config.inc");

$dbconfile = "./include/local.inc";
$sysconfile = "./include/config.inc";
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
	echo "<p>[ <a href=\"install.php\">Go back</a> ] [ <a href=\"install.php?action=set_phplib\">Next</a> ]<p>\n";
    phpinfo();
    exit;
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

/* Set System URL */

case "set_url":
	require("./install/header.inc");
	if (!isset($op)) {
		$op = "";
	}
	switch ($op) {
	case "set":
		require("./install/set_url_set.php");
		break;
	case "":
	default:
		require("./install/set_url.php");
		break;
	}
	break;

/* Check DocsWell Session */

case 'check_session':
	require("./include/prepend.php3");
	require("./include/prepend.php3"); page_open(array('sess' => 'DocsWell_Session'));
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

	echo "<p><b>File Permissions</b>\n";
	echo "<ul>\n";

	/* File permissions for system config */
	$mode = fileperms($sysconfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<li><font color=\"green\">System configuration file $sysconfile has correct ".get_perms($mode)." permissions.</font>\n";
		} else {
			echo "<li><font color=\"red\">System configuration file $sysconfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-rw-rw and try again!</font>\n";
		}
	}

	/* File permissions for database config */
	$mode = fileperms($dbconfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<li><font color=\"green\">Database configuration file $dbconfile has correct ".get_perms($mode)." permissions.</font>\n";
		} else {
			echo "<li><font color=\"red\">Database configuration file $dbconfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-rw-rw and try again!</font>\n";
		}
	}

	/* File permissions for PHPLIB prepend */
	$mode = fileperms($prependfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<li><font color=\"green\">PHPlib prepend file $prependfile has correct ".get_perms($mode)." permissions.</font>\n";
		} else {
			echo "<li><font color=\"red\">PHPlib prepend file $prependfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-rw-rw and try again!</font>\n";
		}
	}
	echo "</ul>\n";

	/* PHP Version */
	$some_no = 0;
	$version = phpversion();
	$major = $version[0];
	$pl = strstr($version, "pl");
	if ($pl)
    		$version = substr_replace($version, '', -strlen($pl));
	if ($major == 3) {
    		$bits = explode('.', $version);
    		$minor = $bits[count($bits) - 1];
    		$release = $bits[count($bits) - 2];
    		$class = 'release';
	} else {
    		if (strspn($version, '0123456789.') == strlen($version)) {
        		$bits = explode('.', $version);
        		$minor = $bits[count($bits) - 1];
    			$release = $bits[count($bits) - 2];
        		$class = 'release';
    		} else {
        		$tail = substr($version, -4);
        		if (($tail == '-dev') || ($tail == '-cvs')) {
         		   	$bits = explode('.', $version);
        		    	$minor = $bits[count($bits) - 1];
    				$release = $bits[count($bits) - 2];
        		    	$minor = substr($minor, 0, strlen($minor) - 4);
        		    	$class = substr($tail, 1);
        		} else {
        		    	$minor = substr($version, 3);
         		   	$class = 'beta';
        		}
    		}
	}
?>
	<p><b>PHP Version</b>
	<ul>
    	<li>PHP Version: <?php echo "$version$pl"; ?></li>
    	<li>PHP Major Version: <?php echo $major; ?>, PHP Release: <?php echo "$release$pl"; ?>, PHP Minor Version: <?php echo "$minor$pl"; ?>, PHP Version Classification: <?php echo $class; ?></li>
    	<?php if ($major == 3) {
        	if ($minor < 16): ?>
            	<li><B><font color="red">Your PHP3 version is older than 3.0.16. You should upgrade to 3.0.16 (or later).</font></B></li>
        	<?php else: ?>
            	<li><B><font color="green">Your PHP3 version is recent. You should not have any problems with <?php echo $sys_name;?> modules.</font></B></li>
        	<?php endif;
    	} elseif ($major == 4) {
        	if ($class == 'beta') { $some_no=1; ?>
            	<li><B><font color="red">You are running a beta or release candidate of PHP4. You need to upgrade to a release version, at least 4.0.3.</font></B></li>
        	<?php } elseif ($release == 0 && $minor < 3) { $some_no=1; ?>
            	<li><B><font color="red">You are running a version of PHP4 older than 4.0.3. You need to upgrade to at least 4.0.3.</font></B></li>
        	<?php } else { ?>
            	<li><B><font color="green">You are running a supported release of PHP4.</font></B></li>
        	<?php } ?>
    	<?php } else { ?>
        	<li><font color="orange">Wow, a mystical PHP from the future. Maybe yo've got to look up if a more modern <?php echo $sys_name;?> version exists!</font></li>
    	<?php } ?>
	</ul>

<?php
	/* PHP Settings */
	$register_globals = get_cfg_var("register_globals");
	$magic_quotes_gpc = get_magic_quotes_gpc();
	$magic_quotes_runtime = !get_magic_quotes_runtime();
?>

	<p><b>Miscellaneous PHP Settings</b>
    <ul>
	<li>register_globals in php.ini set to On: 
<?php
	status($register_globals);
	echo "\n";
	if (!$register_globals) {
	  echo "<br><font color=\"red\">$sys_name wants this setting on.</font>\n";
	}
?>

    <li>magic_quotes_gpc set to On: <?php echo status($magic_quotes_gpc) ?></li>
    <?php if (!$magic_quotes_gpc) { $some_no=1; ?>
        <font color="red">PHPLIB installation instructions (and other useful programs like phpMyAdmin) claim that they want this setting on. Maybe they'll work perfectly well with it off, but lets better have it like they want.</font>
    <?php } ?>
    <li>magic_quotes_runtime set to Off: <?php echo status($magic_quotes_runtime) ?></li>
    <?php if (!$magic_quotes_runtime) { $some_no=1; ?>
        <font color="red">magic_quotes_runtime may not cause quite as many problems as magic_quotes_gpc, but you still do not need it. Turn it off. If the PHPLIB installation instructions claim that they want this setting on, they lie - PHPLIB versions 7 and later work perfectly well with it off.</font>
    <?php } ?>
	</ul>

<?php
	/* PHP module capabilities */
	$mysql = function_exists('mysql_pconnect');
	$pgsql = function_exists('pg_pconnect');
?>
	<p><b>PHP Module Capabilities</b>
	<ul>
    	<li>MySQL Support: <?php status($mysql) ?></li>
    	<li>PostgreSQL Support: <?php status($pgsql) ?></li>
	</ul>

	<p><b>Installation Steps</b>	

<?php
	echo "<ol>\n";
	echo "<li><a href=\"install.php?action=view_phpinfo\">View PHP configuration</a>\n";
	echo "<li><a href=\"install.php?action=set_phplib\">Set path to PHPlib</a>\n";
	echo "<li><a href=\"install.php?action=check_phplib\">Check PHPlib</a>\n";
	echo "<li><a href=\"install.php?action=set_url\">Set System URL</a>\n";
	echo "<li><a href=\"install.php?action=create_dbusr\">Create $sys_name Database User</a>\n";
	echo "<li><a href=\"install.php?action=create_db\">Create $sys_name Database</a>\n";
	echo "<li><a href=\"install.php?action=check_db\">Check $sys_name Database</a>\n";
	echo "<li><a href=\"install.php?action=check_session\">Check PHPlib Session</a>\n";
	echo "</ol>\n";
	break;
}
?>
</body>
</html>
