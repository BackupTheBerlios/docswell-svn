<?php
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

	/* PHP module capabilities */
	$mysql = function_exists('mysql_pconnect');
	$pgsql = function_exists('pg_pconnect');

	/* PHP Settings */
	$magic_quotes_gpc = get_magic_quotes_gpc();
	$magic_quotes_runtime = !get_magic_quotes_runtime();
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
            	<li><B><font color="green">You are running a supported release of PHP4. Enjoy the ride!</font></B></li>
        	<?php } ?>
    	<?php } else { ?>
        	<li><font color="orange">Wow, a mystical PHP from the future. Maybe yo've got to look up if a more modern <?php echo $sys_name;?> version exists!</font></li>
    	<?php } ?>
	</ul>

	<p><b>Miscellaneous PHP Settings</b>
	<ul>
    	<li>magic_quotes_gpc set to On: <?php echo status($magic_quotes_gpc) ?></li>
    	<?php if (!$magic_quotes_gpc) { $some_no=1; ?>
        	<li><font color="red">PHPLIB installation instructions (and other useful programs like phpMyAdmin) claim that they want this setting on. Maybe they'll work perfectly well with it off, but lets better have it like they want.</font></li>
    	<?php } ?>
    	<li>magic_quotes_runtime set to Off: <?php echo status($magic_quotes_runtime) ?></li>
    	<?php if (!$magic_quotes_runtime) { $some_no=1; ?>
        	<li><font color="red">magic_quotes_runtime may not cause quite as many problems as magic_quotes_gpc, but you still do not need it. Turn it off. If the PHPLIB installation instructions claim that they want this setting on, they lie - PHPLIB versions 7 and later work perfectly well with it off.</font></li>
    	<?php } ?>
	</ul>

	<p><b>PHP Module Capabilities</b>
	<ul>
    	<li>MySQL Support: <?php status($mysql) ?></li>
    	<li>PostgreSQL Support: <?php status($pgsql) ?></li>
	</ul>
	<p>[ <a href="install.php">Go back</a> ] [ <a href="install.php?action=set_phplib">Next</a> ]
	<p>
