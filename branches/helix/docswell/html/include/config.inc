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
# The system configuration file
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

######################################################################
# System Config
#
# sys_name          Name of the System
# sys_title         Your site's slogan
# sys_url_title     URL of the system's portal
# sys_url           System URL
# sys_logo_image    Image of your Site
# sys_logo_alt      Alternative text for your site's image
# sys_logo_width    Width of the image of your site
# sys_logo_heigth   Heigth of the image of your site
######################################################################

$sys_name = "DocsWell";
$sys_title = "Document Announcement & Retrieval System";
$sys_url_title = "http://www.berlios.de/";
$sys_url = "http://docswell.berlios.de/";
$sys_logo_image = "images/berliOS_logo.png";
$sys_logo_alt = "BerliOS";
$sys_logo_width = "238";
$sys_logo_heigth = "61";

######################################################################
# Organisation Config
#
# org_name         Name of your Organisation
# org_url	       URL of your Organisation
# org_logo_image   Image of your Organisation
# org_logo_alt	   Alternative text for the image of your Organisation
# org_logo_width   Width of the image of your Organisation
# org_logo_heigth  Height of the image of your Organisation
######################################################################

$org_name = "FOKUS";
$org_url = "http://www.fokus.fhg.de/";
$org_logo_image = "images/logo_fokus.png";
$org_logo_alt = $org_name;
$org_logo_width = "60";
$org_logo_heigth = "60";

######################################################################
# Top Strip
#
# You can change (add, delete, modify) the top strip
# as you wish as long as you mantain this syntax:
#
#         "Title"	=> $sys_url_title."URLofYourTitle",
#
# (don't forget that the last one hasn't got a comma!)
#
######################################################################

$ts_array = array (
	"Home"	=> $sys_url_title."index.php",
	"About us"	=> $sys_url_title."about/index.php",
	"Partners"	=> $sys_url_title."partners/index.php",
	"Contact"	=> $sys_url_title."contact/index.php"
);

######################################################################
# Theme
#
# Configuration of background colors, font families, etc.
#
######################################################################

$th_body_bgcolor = "#FFFFFF";
$th_font_family = "verdana,arial,helvetica,sans-serif";
$th_tt_font_family = "courier,sans-serif";
$th_font_color = "#333333";
$th_hover_font_color = "#FF0000";

$th_nav_bgcolor = "#FFCC33";
$th_navstrip_bgcolor = "#7B7B7B";
$th_nav_font_color = "#333333";
$th_navstrip_font_color = "#FFFFFF";

$th_box_frame_color = "#CCCCCC";
$th_box_frame_width = "1";
$th_box_title_bgcolor = "#CCCCCC";
$th_box_body_bgcolor = "#FFFFFF";
$th_box_title_align = "left";
$th_box_body_align = "left";
$th_box_title_font_color = "#000000";
$th_box_body_font_color = "#333333";
$th_box_error_font_color = "#FF2020";

$th_strip_frame_color = "#CCCCCC";
$th_strip_frame_width = "1";
$th_strip_title_bgcolor = "#CCCCCC";
$th_strip_body_bgcolor = "";
$th_strip_title_align = "center";
$th_strip_body_align = "";
$th_strip_title_font_color = "#000000";
$th_strip_body_font_color = "";

######################################################################
# Page Layout
#
# config_show_appsperpage	maximum number of applications shown each time
# config_show_numberofdays	maximum number of days show at the right side
#
######################################################################

$config_show_appsperpage = "10";
$config_show_numberofdays = 7; 

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

$ml_notify = "1";
$ml_fromaddr = "noreply@mail.berlios.de";
$ml_replyaddr = "noreply@mail.berlios.de";

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

$ml_list = "1";
$ml_listurl = "http://lists.berlios.de/mailman/listinfo/docswell-news";
$ml_weeklylisturl =  "http://lists.berlios.de/mailman/listinfo/docswell-weeklynews";
$ml_newstoaddr = "docswell-news@lists.berlios.de";
$ml_newsreqaddr = "docswell-news-request@lists.berlios.de";
$ml_weeklynewstoaddr = "docswell-weeklynews@lists.berlios.de";
$ml_weeklynewsreqaddr = "docswell-weeklynews-request@lists.berlios.de";
$ml_newsadmaddr = "docswell-admin@lists.berlios.de";
$ml_newsfromaddr = "docswell-admin@lists.berlios.de";
$ml_newsreplyaddr = "docswell-admin@lists.berlios.de";

######################################################################
# Languages
#
# List of languages supported by your website
# You can delete/modify as long as you mantain the syntax
# New languages are always wellcome. Have a look at the documentation!
#
######################################################################

$la_array[] = "English";
$la_array[] = "German";

######################################################################
# Statistic configuration
#
# MinimumAppsByEmail	minimum percentage of an Email domain for
#			being displayed  >= 0.01
# MinimumSeccByEmail	the same but for Sections >= 0.01
# MinimumLicByEmail	the same but for Licenses >= 0.01
# Minimum_apps_in_license   minimum amount of apps a license has to
#			    have to be displayed in the statistic
#			    "Apps by Licenses and Email Domains"
#			    >= 1
#
######################################################################

$MinimumAppsByEmail = "0.4";
$MinimumSeccByEmail = "5";
$MinimumLicByEmail = "1";
$Minimum_apps_in_license = "1";

######################################################################
# Permission for accessing web pages
#
# "user"    only allows access to registered users with user permission
# "editor"  only allows access to registered users with editor permission
# "admin"   only allows access to registered users with admin permission
# "all"     allows access to everybody (also unregistered users)
#
# Please, be sure of what you make!
# An error could make your system fragile.
#
# config_perm_apppend    Access permission to enter apppend.php3
# config_perm_appdom     Access permission to enter appdom.php3
# config_perm_developer  Access permission to enter developer.php3
# config_perm_users      Access permission to enter users.php3
# config_perm_admdate    Access permission to enter admdate.php3
# config_perm_admuser    Access permission to enter admuser.php3
# config_perm_admlang    Access permission to administrate languages
# config_perm_admcomment Access permission to administrate comments
# config_perm_admcat     Access permission to administrate categories
# config_perm_admtype    Access permission to administrate types
# config_perm_admformat  Access permission to administrate formats
# config_perm_nladm      Access permission to administrate newsletters
# config_perm_admfaq     Access permission for administrating the faq
# config_perm_configure  Access permission for configuring the system
# 
######################################################################

$config_perm_apppend = "editor";
$config_perm_appdom = "editor";
$config_perm_developer = "all";
$config_perm_users = "user";
$config_perm_admdate = "admin";
$config_perm_admuser = "admin";
$config_perm_admlang = "admin";
$config_perm_admcomment = "admin";
$config_perm_admcat = "admin";
$config_perm_admtype = "admin";
$config_perm_admformat = "admin";
$config_perm_nladm = "admin";
$config_perm_admfaq = "admin";
$config_perm_configure = "admin";


######################################################################
# PHPLIB user authorization
#
# Put a random string in it 
######################################################################

$hash_secret = "Jabberwocky...";

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
# http://docswell.berlios.de
#
# You can read in the documentation the version number policy followed
# for the DocsWell system development to know when the developers
# recommend you to update your DocsWell system.
#
######################################################################

$DocsWell_Version = "1.0";
?>
