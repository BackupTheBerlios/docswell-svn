	<h3>PHPlib Session</h3>
<?php
	// s is a per session variable, u is a per user variable.
	if (!isset($s)) {
		$s = 0;
		$sess->register('s');
	}
?>
	<p>Per Session Data: <?php echo ++$s ?>
	<br>Session ID: <?php echo $sess->id ?>
	<p>If this page works correctly, then you have a correctly configured <?php echo $sys_name;?>_Session class.
	<p>[ <a href="<?php $sess->pself_url()?>">Reload</a> ] this page to increment the counter.
<?php
	$mode = fileperms($dbconfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<p><font color=\"red\">Database configuration file $dbconfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-r--r-- and try again!</font>\n";
		} else {
			echo "<p><font color=\"green\">Database configuration file $dbconfile has correct ".get_perms($mode)." permissions.</font>\n";
		}
	}
	$mode = fileperms($prependfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<p><font color=\"red\">PHPlib prepend file $prependfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-r--r--!</font>\n";
		} else {
			echo "<p><font color=\"green\">PHPlib prepend file $prependfile has correct ".get_perms($mode)." permissions.</font>\n";
		}
	}
?>
	<p><font color="green">Congratulations!
	<br><?php echo $sys_name;?> is correctly installed.
	<br>Now visit <a href="<?php echo "./";?>"><?php echo $sys_name;?></a> homepage</font>
	<p>[ <a href="install.php">Go back</a> ]
