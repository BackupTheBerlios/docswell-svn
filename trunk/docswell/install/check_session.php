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
	<p>If this page works correctly, then you have a correctly configured DocsWell_Session class. You should be done with PHPLIB setup. Congratulations!
	<p>[ <a href="<?php $sess->pself_url()?>">Reload</a> ] this page to see the counters increment.
	<br>[ <a href="install.php">Go back</a> ]
