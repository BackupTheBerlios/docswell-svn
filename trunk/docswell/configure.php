<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# Configures the DocsWell system
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
###################################################################### 

require("./include/prepend.php3");

page_open(array("sess" => "DocsWell_Session",
                "auth" => "DocsWell_Auth",
                "perm" => "DocsWell_Perm"));

require("./include/header.inc");

$be = new box("80%",$th_box_frame_color,$th_box_frame_width,$th_box_title_bgcolor,$th_box_title_font_color,$th_box_title_align,$th_box_body_bgcolor,$th_box_error_font_color,$th_box_body_align);
?>

<!-- content -->
<?php
if (($config_perm_admlicens != "all") && (!isset($perm) || !$perm->have_perm($config_perm_configure))) {
  $be->box_full($t->translate("Error"), $t->translate("Access denied"));
} else {
			// To avoid loosing data
  if (!isset($sys_name_new) || empty($sys_name_new)) $sys_name_new = $sys_name;
  if (!isset($sys_title_new) || empty($sys_title_new)) $sys_title_new = $sys_title;
  if (!isset($sys_url_title_new) || empty($sys_url_title_new)) $sys_url_title_new = $sys_url_title;
  if (!isset($sys_url_new) || empty($sys_url_new)) $sys_url_new = $sys_url;
  if (!isset($sys_logo_image_new) || empty($sys_logo_image_new)) $sys_logo_image_new = $sys_logo_image;
  if (!isset($sys_logo_alt_new) || empty($sys_logo_alt_new)) $sys_logo_alt_new = $sys_logo_alt;
  if (!isset($sys_logo_width_new) || empty($sys_logo_width_new)) $sys_logo_width_new = $sys_logo_width;
  if (!isset($sys_logo_heigth_new) || empty($sys_logo_heigth_new)) $sys_logo_heigth_new = $sys_logo_heigth;
  if (!isset($org_name_new) || empty($org_name_new)) $org_name_new = $org_name;
  if (!isset($org_url_new) || empty($org_url_new)) $org_url_new = $org_url;
  if (!isset($org_logo_image_new) || empty($org_logo_image_new)) $org_logo_image_new = $org_logo_image;
  if (!isset($org_logo_alt_new) || empty($org_logo_alt_new)) $org_logo_alt_new = $org_logo_alt;
  if (!isset($org_logo_width_new) || empty($org_logo_width_new)) $org_logo_width_new = $org_logo_width;
  if (!isset($org_logo_heigth_new) || empty($org_logo_heigth_new)) $org_logo_heigth_new = $org_logo_heigth;
  if (!isset($th_body_bgcolor_new) || empty($th_body_bgcolor_new)) $th_body_bgcolor_new = $th_body_bgcolor;
  if (!isset($th_font_family_new) || empty($th_font_family_new)) $th_font_family_new = $th_font_family;
  if (!isset($th_tt_font_family_new) || empty($th_tt_font_family_new)) $th_tt_font_family_new = $th_tt_font_family;
  if (!isset($th_font_color_new) || empty($th_font_color_new)) $th_font_color_new = $th_font_color;
  if (!isset($th_hover_font_color_new) || empty($th_hover_font_color_new)) $th_hover_font_color_new = $th_hover_font_color;
  if (!isset($th_nav_bgcolor_new) || empty($th_nav_bgcolor_new)) $th_nav_bgcolor_new = $th_nav_bgcolor;
  if (!isset($th_navstrip_bgcolor_new) || empty($th_navstrip_bgcolor_new)) $th_navstrip_bgcolor_new = $th_navstrip_bgcolor;
  if (!isset($th_nav_font_color_new) || empty($th_nav_font_color_new)) $th_nav_font_color_new = $th_nav_font_color;
  if (!isset($th_navstrip_font_color_new) || empty($th_navstrip_font_color_new)) $th_navstrip_font_color_new = $th_navstrip_font_color;
  if (!isset($th_box_frame_color_new) || empty($th_box_frame_color_new)) $th_box_frame_color_new = $th_box_frame_color;
  if (!isset($th_box_frame_width_new) || empty($th_box_frame_width_new)) $th_box_frame_width_new = $th_box_frame_width;
  if (!isset($th_box_title_bgcolor_new) || empty($th_box_title_bgcolor_new)) $th_box_title_bgcolor_new = $th_box_title_bgcolor;
  if (!isset($th_box_body_bgcolor_new) || empty($th_box_body_bgcolor_new)) $th_box_body_bgcolor_new = $th_box_body_bgcolor;
  if (!isset($th_box_title_align_new) || empty($th_box_title_align_new)) $th_box_title_align_new = $th_box_title_align;
  if (!isset($th_box_body_align_new) || empty($th_box_body_align_new)) $th_box_body_align_new = $th_box_body_align;
  if (!isset($th_box_title_font_color_new) || empty($th_box_title_font_color_new)) $th_box_title_font_color_new = $th_box_title_font_color;
  if (!isset($th_box_body_font_color_new) || empty($th_box_body_font_color_new)) $th_box_body_font_color_new = $th_box_body_font_color;
  if (!isset($th_box_error_font_color_new) || empty($th_box_error_font_color_new)) $th_box_error_font_color_new = $th_box_error_font_color;
  if (!isset($th_strip_frame_color_new) || empty($th_strip_frame_color_new)) $th_strip_frame_color_new = $th_strip_frame_color;
  if (!isset($th_strip_frame_width_new) || empty($th_strip_frame_width_new)) $th_strip_frame_width_new = $th_strip_frame_width;
  if (!isset($th_strip_title_bgcolor_new) || empty($th_strip_title_bgcolor_new)) $th_strip_title_bgcolor_new = $th_strip_title_bgcolor;
  if (!isset($th_strip_body_bgcolor_new) || empty($th_strip_body_bgcolor_new)) $th_strip_body_bgcolor_new = $th_strip_body_bgcolor;
  if (!isset($th_strip_title_align_new) || empty($th_strip_title_align_new)) $th_strip_title_align_new = $th_strip_title_align;
  if (!isset($th_strip_body_align_new) || empty($th_strip_body_align_new)) $th_strip_body_align_new = $th_strip_body_align;
  if (!isset($th_strip_title_font_color_new) || empty($th_strip_title_font_color_new)) $th_strip_title_font_color_new = $th_strip_title_font_color;
  if (!isset($th_strip_body_font_color_new) || empty($th_strip_body_font_color_new)) $th_strip_body_font_color_new = $th_strip_body_font_color;

  if (!isset($config_show_appsperpage_new) || empty($config_show_appsperpage_new)) $config_show_appsperpage_new = $config_show_appsperpage;
  if (!isset($config_show_numberofdays_new) || empty($config_show_numberofdays_new)) $config_show_numberofdays_new = $config_show_numberofdays;

  if (!isset($ml_notify_new) || empty($ml_notify_new)) $ml_notify_new = $ml_notify;
  if (!isset($ml_fromaddr_new) || empty($ml_fromaddr_new)) $ml_fromaddr_new = $ml_fromaddr;
  if (!isset($ml_replyaddr_new) || empty($ml_replyaddr_new)) $ml_replyaddr_new = $ml_replyaddr;

  if (!isset($ml_list_new) || empty($ml_list_new)) $ml_list_new = $ml_list;
  if (!isset($ml_listurl_new) || empty($ml_listurl_new)) $ml_listurl_new = $ml_listurl;
  if (!isset($ml_weeklylisturl_new) || empty($ml_weeklylisturl_new)) $ml_weeklylisturl_new = $ml_weeklylisturl;
  if (!isset($ml_newstoaddr_new) || empty($ml_newstoaddr_new)) $ml_newstoaddr_new = $ml_newstoaddr;
  if (!isset($ml_newsreqaddr_new) || empty($ml_newsreqaddr_new)) $ml_newsreqaddr_new = $ml_newsreqaddr;
  if (!isset($ml_weeklynewstoaddr_new) || empty($ml_weeklynewstoaddr_new)) $ml_weeklynewstoaddr_new = $ml_weeklynewstoaddr;
  if (!isset($ml_weeklynewsreqaddr_new) || empty($ml_weeklynewsreqaddr_new)) $ml_weeklynewsreqaddr_new = $ml_weeklynewsreqaddr;
  if (!isset($ml_newsadmaddr_new) || empty($ml_newsadmaddr_new)) $ml_newsadmaddr_new = $ml_newsadmaddr;
  if (!isset($ml_newsfromaddr_new) || empty($ml_newsfromaddr_new)) $ml_newsfromaddr_new = $ml_newsfromaddr;
  if (!isset($ml_newsreplyaddr_new) || empty($ml_newsreplyaddr_new)) $ml_newsreplyaddr_new = $ml_newsreplyaddr;

  if (!isset($MinimumAppsByEmail_new) || empty($MinimumAppsByEmail_new)) $MinimumAppsByEmail_new = $MinimumAppsByEmail;
  if (!isset($MinimumSeccByEmail_new) || empty($MinimumSeccByEmail_new)) $MinimumSeccByEmail_new = $MinimumSeccByEmail;
  if (!isset($MinimumLicByEmail_new) || empty($MinimumLicByEmail_new)) $MinimumLicByEmail_new = $MinimumLicByEmail;
  if (!isset($Minimum_apps_in_license_new) || empty($Minimum_apps_in_license_new)) $Minimum_apps_in_license_new = $Minimum_apps_in_license;

  if (!isset($config_perm_apppend_new) || empty($config_perm_apppend_new)) $config_perm_apppend_new = $config_perm_apppend;
  if (!isset($config_perm_appdom_new) || empty($config_perm_appdom_new)) $config_perm_appdom_new = $config_perm_appdom;
  if (!isset($config_perm_developer_new) || empty($config_perm_developer_new)) $config_perm_developer_new = $config_perm_developer;
  if (!isset($config_perm_users_new) || empty($config_perm_users_new)) $config_perm_users_new = $config_perm_users;
  if (!isset($config_perm_admdate_new) || empty($config_perm_admdate_new)) $config_perm_admdate_new = $config_perm_admdate;
  if (!isset($config_perm_admuser_new) || empty($config_perm_admuser_new)) $config_perm_admuser_new = $config_perm_admuser;
  if (!isset($config_perm_admlicens_new) || empty($config_perm_admlicens_new)) $config_perm_admlicens_new = $config_perm_admlicens;
  if (!isset($config_perm_admcomment_new) || empty($config_perm_admcomment_new)) $config_perm_admcomment_new = $config_perm_admcomment;
  if (!isset($config_perm_admsec_new) || empty($config_perm_admsec_new)) $config_perm_admsec_new = $config_perm_admsec;
  if (!isset($config_perm_admcat_new) || empty($config_perm_admcat_new)) $config_perm_admcat_new = $config_perm_admcat;
  if (!isset($config_perm_nladm_new) || empty($config_perm_nladm_new)) $config_perm_nladm_new = $config_perm_nladm;
  if (!isset($config_perm_nladm_new) || empty($config_perm_nladm_new)) $config_perm_nladm_new = $config_perm_nladm;
  if (!isset($config_perm_admfaq_new) || empty($config_perm_admfaq_new)) $config_perm_admfaq_new = $config_perm_admfaq;
  if (!isset($config_perm_configure_new) || empty($config_perm_configure_new)) $config_perm_configure_new = $config_perm_configure;

//  if (!isset(_new) || empty()) _new = ;
?>

<Center><h3>Configuring the DocsWell system (alpha version)</h3></CENTER>
<?

  if ($configure == "1"){

#
# We make the config.inc file with the DocsWell configuration 
#

    $fp = fopen ("include/config.inc", "w"); 
    fputs($fp, "<?php

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
# This is the configuration file
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

######################################################################
# System Config
#
# sys_name:		Name of the System
# sys_title:		Your site's slogan
# sys_url_title		URL of the system's portal
# sys_url		System URL
# sys_logo_image	Image of your Site
# sys_logo_alt		Alternative text for your site's image
# sys_logo_width	Width of the image of your site
# sys_logo_heigth	Heigth of the image of your site
######################################################################

\$sys_name = \"$sys_name_new\";
\$sys_title = \"$sys_title_new\";
\$sys_url_title = \"$sys_url_title_new\";
\$sys_url = \"$sys_url_new\";
\$sys_logo_image = \"$sys_logo_image_new\";
\$sys_logo_alt = \"$sys_logo_alt_new\";
\$sys_logo_width = \"$sys_logo_width_new\";
\$sys_logo_heigth = \"$sys_logo_heigth_new\";

######################################################################
# Organisation Config
#
# org_name	   Name of your Organisation
# org_url	   URL of your Organisation
# org_logo_image   Image of your Organisation
# org_logo_alt	   Alternative text for the image of your Organisation
# org_logo_width   Width of the image of your Organisation
# org_logo_heigth  Height of the image of your Organisation
######################################################################

\$org_name = \"$org_name_new\";
\$org_url = \"$org_url_new\";
\$org_logo_image = \"$org_logo_image_new\";
\$org_logo_alt = \$org_name;
\$org_logo_width = \"$org_logo_width_new\";
\$org_logo_heigth = \"$org_logo_heigth_new\";

######################################################################
# Top Strip
#
# You can change (add, delete, modify) the top strip
# as you wish as long as you mantain this syntax:
#
#         \"Title\"	=> \$sys_url_title.\"URLofYourTitle\",
#
# (don't forget that the last one hasn't got a comma!)
#
######################################################################

\$ts_array = array (
	\"Home\"	=> \$sys_url_title.\"index.php\",
	\"About us\"	=> \$sys_url_title.\"about/index.php\",
	\"Partners\"	=> \$sys_url_title.\"partners/index.php\",
	\"Contact\"	=> \$sys_url_title.\"contact/index.php\"
);

######################################################################
# Theme
#
# Configuration of background colors, font families, etc.
#
######################################################################

\$th_body_bgcolor = \"$th_body_bgcolor_new\";
\$th_font_family = \"$th_font_family_new\";
\$th_tt_font_family = \"$th_tt_font_family_new\";
\$th_font_color = \"$th_font_color_new\";
\$th_hover_font_color = \"$th_hover_font_color_new\";

\$th_nav_bgcolor = \"$th_nav_bgcolor_new\";
\$th_navstrip_bgcolor = \"$th_navstrip_bgcolor_new\";
\$th_nav_font_color = \"$th_nav_font_color_new\";
\$th_navstrip_font_color = \"$th_navstrip_font_color_new\";

\$th_box_frame_color = \"$th_box_frame_color_new\";
\$th_box_frame_width = \"$th_box_frame_width_new\";
\$th_box_title_bgcolor = \"$th_box_title_bgcolor_new\";
\$th_box_body_bgcolor = \"$th_box_body_bgcolor_new\";
\$th_box_title_align = \"$th_box_title_align_new\";
\$th_box_body_align = \"$th_box_body_align_new\";
\$th_box_title_font_color = \"$th_box_title_font_color_new\";
\$th_box_body_font_color = \"$th_box_body_font_color_new\";
\$th_box_error_font_color = \"$th_box_error_font_color_new\";

\$th_strip_frame_color = \"$th_strip_frame_color_new\";
\$th_strip_frame_width = \"$th_strip_frame_width_new\";
\$th_strip_title_bgcolor = \"$th_strip_title_bgcolor_new\";
\$th_strip_body_bgcolor = \"$th_strip_body_bgcolor_new\";
\$th_strip_title_align = \"$th_strip_title_align_new\";
\$th_strip_body_align = \"$th_strip_body_align_new\";
\$th_strip_title_font_color = \"$th_strip_title_font_color_new\";
\$th_strip_body_font_color = \"$th_strip_body_font_color_new\";

######################################################################
# Page Layout
#
# config_show_appsperpage	maximum number of applications shown each time
# config_show_numberofdays	maximum number of days show at the right side
#
######################################################################

\$config_show_appsperpage = \"$config_show_appsperpage_new\";
\$config_show_numberofdays = \"$config_show_numberofdays_new\";

######################################################################
# Email Notification
#
# Notify admin by email that a new user has registered
# and editors that apps were inserted, reviewed, updated or changed.
#
# ml_notify		To be notified, ml_notify apps have to be inserted
# ml_fromaddr		Email address in the From field
# ml_replyaddr		Return Email address
#
######################################################################

\$ml_notify = \"$ml_notify_new\";
\$ml_fromaddr = \"$ml_fromaddr_new\";
\$ml_replyaddr = \"$ml_replyaddr_new\";

######################################################################
# Newsletter Configuration
#
# ml_list: Whether you want to have Mailing Lists ('1') or not ('0')
# ml_listurl		
# ml_weeklylisturl	
# ml_newstoaddr 
# ml_newsreqaddr 
# ml_weeklynewstoaddr 
# ml_weeklynewsreqaddr 
# ml_newsadmaddr: E-mail address of the list administrator
# ml_newsfromaddr: From-field of the e-mails
# ml_newsreplyaddr: Replay-addreess of th e-mails
#
######################################################################

\$ml_list = \"$ml_list_new\";
\$ml_listurl = \"$ml_listurl_new\";
\$ml_weeklylisturl =  \"$ml_weeklylisturl_new\";
\$ml_newstoaddr = \"$ml_newstoaddr_new\";
\$ml_newsreqaddr = \"$ml_newsreqaddr_new\";
\$ml_weeklynewstoaddr = \"$ml_weeklynewstoaddr_new\";
\$ml_weeklynewsreqaddr = \"$ml_weeklynewsreqaddr_new\";
\$ml_newsadmaddr = \"$ml_newsadmaddr_new\";
\$ml_newsfromaddr = \"$ml_newsfromaddr_new\";
\$ml_newsreplyaddr = \"$ml_newsreplyaddr_new\";

######################################################################
# Languages
#
# List of languages supported by your website
# You can delete/modify as long as you mantain the syntax
# New languages are always wellcome. Have a look at the documentation!
#
######################################################################

\$la_array[] = \"English\";
\$la_array[] = \"German\";
\$la_array[] = \"Spanish\";


######################################################################
# Statistic configuration
#
# MinimumAppsByEmail	minimum percentage of an Email domain for
#			being displayed  >= 0.01
# MinimumSeccByEmail	the same but for Sections >= 0.01
# MinimumLicByEmail	the same but for Licenses >= 0.01
# Minimum_apps_in_license   minimum amount of apps a license has to
#			    have to be displayed in the statistic
#			    \"Apps by Licenses and Email Domains\"
#			    >= 1
#
######################################################################

\$MinimumAppsByEmail = \"$MinimumAppsByEmail_new\";
\$MinimumSeccByEmail = \"$MinimumSeccByEmail_new\";
\$MinimumLicByEmail = \"$MinimumLicByEmail_new\";
\$Minimum_apps_in_license = \"$Minimum_apps_in_license_new\";

######################################################################
# Permission for accessing web pages
#
# \"user\"    only allows access to registered users with user permission
# \"editor\"  only allows access to registered users with editor permission
# \"admin\"   only allows access to registered users with admin permission
# \"all\"     allows access to everybody (also unregistered users)
#
# Please, be sure of what you make!
# An error could make your system fragile.
#
# config_perm_apppend	Access permission to enter apppend.php
# config_perm_appdom	Access permission to enter appdom.php
# config_perm_developer	Access permission to enter developer.php
# config_perm_users	Access permission to enter users.php
# config_perm_admdate	Access permission to enter admdate.php
# config_perm_admuser	Access permission to enter admuser.php
# config_perm_admlicens	Access permission to administrate licenses
# config_perm_admcomment	Access permission to administrate comments
# config_perm_admsec	Access permission to administrate sections
# config_perm_admcat	Access permission to administrate categories
# config_perm_nladm	Access permission to administrate newsletters
# config_perm_admfaq 	Access permission for administrating the faq
# config_perm_configure Access permission for configuring the system
# 
######################################################################

\$config_perm_apppend = \"$config_perm_apppend_new\";
\$config_perm_appdom = \"$config_perm_appdom_new\";
\$config_perm_developer = \"$config_perm_developer_new\";
\$config_perm_users = \"$config_perm_users_new\";
\$config_perm_admdate = \"$config_perm_admdate_new\";
\$config_perm_admuser = \"$config_perm_admuser_new\";
\$config_perm_admlicens = \"$config_perm_admlicens_new\";
\$config_perm_admcomment = \"$config_perm_admcomment_new\";
\$config_perm_admsec = \"$config_perm_admsec_new\";
\$config_perm_admcat = \"$config_perm_admcat_new\";
\$config_perm_nladm = \"$config_perm_nladm_new\";
\$config_perm_admfaq = \"$config_perm_admfaq_new\";
\$config_perm_configure = \"$config_perm_configure_new\";


######################################################################
# PHPLIB user authorization
#
# Put a random string in it 
######################################################################

\$hash_secret = \"Jabberwocky...\";

######################################################################
# 
# Ok... that's it. You've finished configuring the DocsWell system
#
# The rest of parameters that are listed beyond this comment
# are internal for the DocsWell system or needed for advanced purposes
#
######################################################################

######################################################################
# DocsWell Version
#
# Please, do not touch this in any case!
# It just gives the version of DocsWell you're are using
# You can always download the latest version of DocsWell at
# http://sourcewell.berlios.de
#
# You can read in the documentation the version number policy followed
# for the DocsWell system development to know when the developers
# recommend you to update your DocsWell system.
#
######################################################################

\$DocsWell_Version = \"1.0\";

?>");

    fclose($fp);
    if (fopen("include/config.inc", "r") != "false") {
      print "<center>Configuration modifications done!</center>\n";
      print "<center>Press the button to see the modifications</center>\n";
      print "<center><a href=\"".$sess->url("configure.php")."\">See Changes</a></center>\n";
    } else {
      print "<center>Error: config.inc could not be created!</center>\n";
    }
  } else {
    print "<form action=\"".$sess->self_url().$sess->add_query(array("configure" => "1"))."\" method=\"post\">\n";

    print "<CENTER><table border=0 width=94%>\n<tr>\n";
    print "  <td width=25%><B>Name of the system</B></td>\n  <td width=75%><input type=text name=sys_name_new value=\"$sys_name\" size=45></td>\n </tr>\n <tr>\n";
//    print "  <td width=25%><B></B></td>\n  <td width=75%><input type=text name=_new value=$ size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Your site's slogan</B></td>\n  <td width=75%><input type=text name=sys_title_new value=\"$sys_title\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>URL of the system's portal</B></td>\n  <td width=75%><input type=text name=sys_url_title_new value=\"$sys_url_title\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>System URL</B></td>\n  <td width=75%><input type=text name=sys_url_new value=\"$sys_url\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Image of your Site</B></td>\n  <td width=75%><input type=text name=sys_logo_image_new value=\"$sys_logo_image\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Alternative text for your site's image</B></td>\n  <td width=75%><input type=text name=sys_logo_alt_new value=\"$sys_logo_alt\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Width of the image of your site</B></td>\n  <td width=75%><input type=text name=sys_logo_width_new value=\"$sys_logo_width\" size=3></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Heigth of the image of your site</B></td>\n  <td width=75%><input type=text name=sys_logo_heigth_new value=\"$sys_logo_heigth\" size=3></td>\n </tr>\n <tr>\n";


    print "  <td width=25%><B>Name of your Organisation</B></td>\n  <td width=75%><input type=text name=org_name_new value=\"$org_name\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>URL of your Organisation</B></td>\n  <td width=75%><input type=text name=org_url_new value=\"$org_url\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Image of your Organisation</B></td>\n  <td width=75%><input type=text name=org_logo_image_new value=\"$org_logo_image\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Alternative text for the image of your Organisation</B></td>\n  <td width=75%><input type=text name=org_logo_alt_new value=\"$org_logo_alt\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Width of the image of your Organisation</B></td>\n  <td width=75%><input type=text name=org_logo_width_new value=\"$org_logo_width\" size=3></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Height of the image of your Organisation</B></td>\n  <td width=75%><input type=text name=org_logo_heigth_new value=\"$org_logo_heigth\" size=3></td>\n </tr>\n <tr>\n";

    print "  <td width=25%><B>th_body_bgcolor</B></td>\n  <td width=75%><input type=text name=th_body_bgcolor_new value=\"$th_body_bgcolor\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_font_family</B></td>\n  <td width=75%><input type=text name=th_font_family_new value=\"$th_font_family\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_font_color</B></td>\n  <td width=75%><input type=text name=th_font_color_new value=\"$th_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_hover_font_color</B></td>\n  <td width=75%><input type=text name=th_hover_font_color_new value=\"$th_hover_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_nav_bgcolor</B></td>\n  <td width=75%><input type=text name=th_nav_bgcolor_new value=\"$th_nav_bgcolor\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_navstrip_bgcolor</B></td>\n  <td width=75%><input type=text name=th_navstrip_bgcolor_new value=\"$th_navstrip_bgcolor\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_nav_font_color</B></td>\n  <td width=75%><input type=text name=th_nav_font_color_new value=\"$th_nav_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_nav_font_color</B></td>\n  <td width=75%><input type=text name=th_nav_font_color_new value=\"$th_nav_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_navstrip_font_color</B></td>\n  <td width=75%><input type=text name=th_navstrip_font_color_new value=\"$th_navstrip_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_frame_color</B></td>\n  <td width=75%><input type=text name=th_box_frame_color_new value=\"$th_box_frame_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_frame_width</B></td>\n  <td width=75%><input type=text name=th_box_frame_width_new value=\"$th_box_frame_width\" size=2></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_title_bgcolor</B></td>\n  <td width=75%><input type=text name=th_box_title_bgcolor_new value=\"$th_box_title_bgcolor\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_body_bgcolor</B></td>\n  <td width=75%><input type=text name=th_box_body_bgcolor_new value=\"$th_box_body_bgcolor\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_title_align</B></td>\n  <td width=75%><input type=text name=th_box_title_align_new value=\"$th_box_title_align\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_body_align</B></td>\n  <td width=75%><input type=text name=th_box_body_align_new value=\"$th_box_body_align\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_title_font_color</B></td>\n  <td width=75%><input type=text name=th_box_title_font_color_new value=\"$th_box_title_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_body_font_color</B></td>\n  <td width=75%><input type=text name=th_box_body_font_color_new value=\"$th_box_body_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_box_error_font_color</B></td>\n  <td width=75%><input type=text name=th_box_error_font_color_new value=\"$th_box_error_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_strip_frame_color</B></td>\n  <td width=75%><input type=text name=th_strip_frame_color_new value=\"$th_strip_frame_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_strip_frame_width</B></td>\n  <td width=75%><input type=text name=th_strip_frame_width_new value=\"$th_strip_frame_width\" size=2></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_strip_title_bgcolor</B></td>\n  <td width=75%><input type=text name=th_strip_title_bgcolor_new value=\"$th_strip_title_bgcolor\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_strip_body_bgcolor</B></td>\n  <td width=75%><input type=text name=th_strip_body_bgcolor_new value=\"$th_strip_body_bgcolor\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_strip_title_align</B></td>\n  <td width=75%><input type=text name=th_strip_title_align_new value=\"$th_strip_title_align\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_strip_body_align</B></td>\n  <td width=75%><input type=text name=th_strip_body_align_new value=\"$th_strip_body_align\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_strip_title_font_color</B></td>\n  <td width=75%><input type=text name=th_strip_title_font_color_new value=\"$th_strip_title_font_color\" size=7></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>th_strip_body_font_color</B></td>\n  <td width=75%><input type=text name=th_strip_body_font_color_new value=\"$th_strip_body_font_color\" size=7></td>\n </tr>\n <tr>\n";

    print "  <td width=25%><B>maximum number of applications shown each time</B></td>\n  <td width=75%><input type=text name=config_show_appsperpage_new value=\"$config_show_appsperpage\" size=2></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>maximum number of days show at the right side</B></td>\n  <td width=75%><input type=text name=config_show_numberofdays_new value=\"$config_show_numberofdays\" size=2></td>\n </tr>\n <tr>\n";

    print "  <td width=25%><B>To be notified, ml_notify apps have to be inserted</B></td>\n  <td width=75%><input type=text name=ml_notify_new value=\"$ml_notify\" size=3></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Email address in the From field</B></td>\n  <td width=75%><input type=text name=ml_fromaddr_new value=\"$ml_fromaddr\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Return Email address</B></td>\n  <td width=75%><input type=text name=ml_replyaddr_new value=\"$ml_replyaddr\" size=45></td>\n </tr>\n <tr>\n";

    print "  <td width=25%><B>Whether you want to have Mailing Lists ('1') or not ('0')</B></td>\n  <td width=75%><input type=text name=ml_list_new value=\"$ml_list\" size=1></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>ml_listurl</B></td>\n  <td width=75%><input type=text name=ml_listurl_new value=\"$ml_listurl\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>ml_weeklylisturl</B></td>\n  <td width=75%><input type=text name=ml_weeklylisturl_new value=\"$ml_weeklylisturl\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>ml_newstoaddr</B></td>\n  <td width=75%><input type=text name=ml_newstoaddr_new value=\"$ml_newstoaddr\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>ml_newsreqaddr</B></td>\n  <td width=75%><input type=text name=ml_newsreqaddr_new value=\"$ml_newsreqaddr\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>ml_weeklynewstoaddr</B></td>\n  <td width=75%><input type=text name=ml_weeklynewstoaddr_new value=\"$ml_weeklynewstoaddr\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>ml_weeklynewsreqaddr</B></td>\n  <td width=75%><input type=text name=ml_weeklynewsreqaddr_new value=\"$ml_weeklynewsreqaddr\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>E-mail address of the list administrator</B></td>\n  <td width=75%><input type=text name=ml_newsadmaddr_new value=\"$ml_newsadmaddr\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>From-field of the e-mails</B></td>\n  <td width=75%><input type=text name=ml_newsfromaddr_new value=\"$ml_newsfromaddr\" size=45></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Replay-addreess of th e-mails</B></td>\n  <td width=75%><input type=text name=ml_newsreplyaddr_new value=\"$ml_newsreplyaddr\" size=45></td>\n </tr>\n <tr>\n";

    print "  <td width=25%><B>minimum percentage of an Email domain for being displayed</B></td>\n  <td width=75%><input type=text name=MinimumAppsByEmail_new value=\"$MinimumAppsByEmail\" size=4></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>the same but for Sections</B></td>\n  <td width=75%><input type=text name=MinimumSeccByEmail_new value=\"$MinimumSeccByEmail\" size=4></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>the same but for Licenses</B></td>\n  <td width=75%><input type=text name=MinimumLicByEmail_new value=\"$MinimumLicByEmail\" size=4></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>minimum amount of apps a license has to have to be displayed in the statistic</B></td>\n  <td width=75%><input type=text name=Minimum_apps_in_license_new value=\"$Minimum_apps_in_license\" size=2></td>\n </tr>\n <tr>\n";

    print "  <td width=25%><B>Access permission to enter apppend.php</B></td>\n  <td width=75%><select name=config_perm_apppend_new>\n";
    lib_select_perm($config_perm_apppend);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to enter appdom.php</B></td>\n  <td width=75%><select name=config_perm_appdom_new>\n";
    lib_select_perm($config_perm_appdom);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to enter developer.php</B></td>\n  <td width=75%><select name=config_perm_developer_new>\n";
    lib_select_perm($config_perm_developer);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to enter users.php</B></td>\n  <td width=75%><select name=config_perm_users_new>\n";
    lib_select_perm($config_perm_users);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to enter admdate.php</B></td>\n  <td width=75%><select name=config_perm_admdate_new>\n";
    lib_select_perm($config_perm_admdate);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to enter admuser.php</B></td>\n  <td width=75%><select name=config_perm_admuser_new>\n";
    lib_select_perm($config_perm_admuser);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to administrate licenses</B></td>\n  <td width=75%><select name=config_perm_admlicens_new>\n";
    lib_select_perm($config_perm_admlicens);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to administrate comments</B></td>\n  <td width=75%><select name=config_perm_admcomment_new>\n";
    lib_select_perm($config_perm_admcomment);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to administrate sections</B></td>\n  <td width=75%><select name=config_perm_admsec_new>\n";
    lib_select_perm($config_perm_admsec);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to administrate categories</B></td>\n  <td width=75%><select name=config_perm_admcat_new>\n";
    lib_select_perm($config_perm_admcat);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission to administrate newsletters</B></td>\n  <td width=75%><select name=config_perm_nladm_new>\n";
    lib_select_perm($config_perm_nladm);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission for administrating the faq</B></td>\n  <td width=75%><select name=config_perm_admfaq_new>\n";
    lib_select_perm($config_perm_admfaq);
    print "</select></td>\n </tr>\n <tr>\n";
    print "  <td width=25%><B>Access permission for configuring the system</B></td>\n  <td width=75%><select name=config_perm_configure_new>\n";
    lib_select_perm($config_perm_configure);
     print "</select></td>\n </tr>\n <tr>\n";

    print "  <td colspan=2 align=right><input type=SUBMIT VALUE=Configure></form></td>\n </tr>\n</table></CENTER><BR>\n";

  }
}
?>

<!-- end content -->

<?php
require("./include/footer.inc");
@page_close();
?>
