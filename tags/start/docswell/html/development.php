<?php

######################################################################
# DocsWell: Document Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# The DocsWell page for developers
#
# It also shows the number of apps in each one
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
###################################################################### 

require("header.inc");

?>

<!-- content -->

<P><H2>For developers</H2>

<P>DocsWell is Open Source, so you're invited to contribute to it.

<P>DocsWell has been thought as an announcement and retrieval system
for documents, but maybe you're interested in adapting DocsWell for
announcing other kind of things. Or maybe you want to improve
DocsWell adding features or correcting errors. If one of these is your case, keeping on
reading will be of interest for you.

<P>The documentation that is included in the <A HREF="http://developer.berlios.de/project/filelist.php?group_id=99">SourceWell package</A> has been made with the idea of a developer who wants to
make further development in DocsWell or who wants to make some
modifications so that DocsWell suits his/her needs.

<P>Note: For developing or modifying DocsWell, <A HREF="http://www.php.net">PHP</A> knowledge is needed. You should also have
certain SQL experience if you want to handle with databases.

<P>Please report to the <A HREF="authors.php3">authors</A> any adaptions and/or modifications. This
could help us knowing what DocsWell should implement in the future
and making other DocsWell users benefit from your work.

<P>For advanced uses, <A HREF="http://phplib.netuse.de/">PHPLib</A> should also be known. You can read about
PHPLib's API in PHPLib's manual. At this moment, PHPLib is used only
for sessions and authentication. If you aren't going to work with
them, you don't need to have a look at PHPLib.

<P>&nbsp;

<!-- end content -->

<?php
require("footer.inc");
?>
