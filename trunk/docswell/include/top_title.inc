<?php

######################################################################
# DocsWell: Software Announcement & Retrieval System
# ================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://sourcewell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# This file shows a bar with a title at the top of the pages
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

?>

<!-- top title -->
<table BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%" valign="center" >
<tr VALIGN=TOP BGCOLOR="<?php echo $th_nav_bgcolor;?>">
<td BGCOLOR="<?php echo $th_body_bgcolor;?>"><a href="<?php echo $sys_url_title;?>"><img SRC="<?php echo $sys_logo_image;?>" HSPACE=5 VSPACE=5 BORDER=0 height=<?php echo $sys_logo_heigth;?> width=<?php echo $sys_logo_width;?> ALT="<?php echo $sys_logo_alt;?>"></a></td>
<td WIDTH="10"><img SRC="images/blank.gif" BORDER=0 height=1 width=10></td>
<td VALIGN="middle" WIDTH="99%"><font color="<?php echo $th_nav_font_color;?>"><b class="title"><?php echo $sys_name;?></b>
<br><?php echo $t->translate($sys_title);?></font></td>

<!-- logo at right -->
<td VALIGN="middle">
<a href="<?php echo $org_url;?>" TARGET="_blank"><img SRC="<?php echo $org_logo_image;?>" ALT="<?php echo $org_logo_alt;?>" HSPACE=10 BORDER=0 height=<?php echo $org_logo_heigth;?> width=<?php echo $org_logo_width;?> align=RIGHT></a></td>
</tr>
<!-- end logo at right -->

<tr>
<td COLSPAN="4" BGCOLOR="<?php echo $th_navstrip_bgcolor;?>"><img SRC="images/blank.gif" height=2 width=2></td>
</tr>
</table>
<!-- end top title -->
