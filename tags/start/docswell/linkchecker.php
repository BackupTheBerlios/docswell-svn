<?
// Author (unknown)
// Changed by Gregorio Robles
// License: GPL (www.gnu.org)
// It now shows only the links whose response is different from 200 = OK
// and 302 = Found

$text['N/A'] = "Ikke HTTP";
$text[OK]    = "Valid hostname";
$text[FEJL]  = "Invalid hostname";
$text[Død]   = "No responce";
$text[100]   = "Continue";
$text[101]   = "Switching Protocols";
$text[200]   = "OK";
$text[201]   = "Created";
$text[202]   = "Accepted";
$text[203]   = "Non-Authoritative Information";
$text[204]   = "No Content";
$text[205]   = "Reset Content";
$text[206]   = "Partial Content";
$text[300]   = "Multiple Choices";
$text[301]   = "Moved Permanently";
$text[302]   = "Found";
$text[303]   = "See Other";
$text[304]   = "Not Modified";
$text[305]   = "Use Proxy";
$text[307]   = "Temporary Redirect";
$text[400]   = "Bad Request";
$text[401]   = "Unauthorized";
$text[402]   = "Payment Required";
$text[403]   = "Forbidden";
$text[404]   = "Not Found";
$text[405]   = "Method Not Allowed";
$text[406]   = "Not Acceptable";
$text[407]   = "Proxy Authentication Required";
$text[408]   = "Request Timeout";
$text[409]   = "Conflict";
$text[410]   = "Gone";
$text[411]   = "Length Required";
$text[412]   = "Precondition Failed";
$text[413]   = "Request Entity Too Large";
$text[414]   = "Request-URI Too Long";
$text[415]   = "Unsupported Media Type";
$text[416]   = "Requested Range Not Satisfiable";
$text[417]   = "Expectation Failed";
$text[500]   = "Internal Server Error";
$text[501]   = "Not Implemented";
$text[502]   = "Bad Gateway";
$text[503]   = "Service Unavailable";
$text[504]   = "Gateway Timeout";
$text[505]   = "HTTP Version Not Supported";

function specialconcat($base,$path) {
	$base = ereg_replace("(.*/)[^/]*","\\1", $base);
	$path = ereg_replace("^(\.){1}/", "", $path);
	if (ereg("^/", $path)) {
	   $base = ereg_replace("^(http://([^/]+))/{1}(.*)", "\\1", $base);
	}
	return $base.$path;
}

function sortarray($arr) {
   if (count($arr) == 0) return $arr;
   reset($arr);
   while (list($key,$value) = each($arr)) $newarr[$value] = $key;
   reset($newarr);
   while (list($key,$value) = each($newarr)) $sortedarr[] = $key;
   return $sortedarr;
}

function firstArd($url) {
   $urlArray = parse_url($url);
   if (!$urlArray[port]) $urlArray[port] = "80";
   if (!$urlArray[path]) $urlArray[path] = "/";
   if ($urlArray[query]) $urlArray[path] .= "?$urlArray[query]";
   $sock = fsockopen($urlArray[host], $urlArray[port]);
   if ($sock) {
      $dump .= "GET $urlArray[path] HTTP/1.1\r\n";
      $dump .= "Host: $urlArray[host]\r\nConnection: close\r\n";
      $dump .= "Connection: close\r\n\r\n";
      fputs($sock, $dump);
	   while($str = fgets($sock, 1024)) $headers[] = $str;
	   fclose($sock);
      flush();
	   for($i=0; $i<count($headers); $i++) {
         if (eregi("^HTTP/[0-9]+\.[0-9]+ 200", $headers[$i])) $location = $url;
         if (eregi("^Location: ", $headers[$i])) $location = eregi_replace("^Location:( )?", "", $headers[$i]);
	   }
   }
   $location = trim($location);
   return $location;
}

function check($url) {
   if (!eregi("^http://", $url)) {
      if (eregi("^mailto:", $url)) {
	     $url = trim(eregi_replace("^mailto:(.+)", "\\1", $url));
		 list($brugernavn, $host) = split("@", $url);
		 $dnsCheck = checkdnsrr($host,"MX");
		 if ($dnsCheck) $return[code] = "OK";
		 else $return[code] = "ERROR";
	  }
      else $return[code] = "N/A";
   }
   else {
      $urlArray = parse_url($url);
         if (!$urlArray[port]) $urlArray[port] = "80";
         if (!$urlArray[path]) $urlArray[path] = "/";
         $sock = fsockopen($urlArray[host], $urlArray[port], &$errnum, &$errstr);
         if (!$sock) $return[code] = "Død";
         else {
            $dump .= "GET $urlArray[path] HTTP/1.1\r\n";
            $dump .= "Host: $urlArray[host]\r\nConnection: close\r\n";
            $dump .= "Connection: close\r\n\r\n";
            fputs($sock, $dump);
	        while($str = fgets($sock, 1024)) {
	          if (eregi("^http/[0-9]+.[0-9]+ ([0-9]{3}) [a-z ]*", $str)) $return[code]        = trim(eregi_replace("^http/[0-9]+.[0-9]+ ([0-9]{3}) [a-z ]*", "\\1", $str));
		       if (eregi("^Content-Type: ", $str))                        $return[contentType] = trim(eregi_replace("^Content-Type: ", "", $str));
	        }
	        fclose($sock);
            flush();
         }
   }
	  return $return;
}

function liste($url) {
   global $Comments;
   global $otherLinks;
   global $removeQ;
   $text = implode("", file($url));
   $text = eregi_replace("<!--([^-]|-[^-]|--[^>])*-->","", $text);
   
   while (eregi("[:space:]*(href|src)[:space:]*=[:space:]*([^ >]+)", $text, $regs)) {
      $regs[2] = ereg_replace("\"", "", $regs[2]);
      $regs[2] = ereg_replace("'", "", $regs[2]);
      if ($removeQ) $mylist[] = ereg_replace("\?.*$", "", $regs[2]);
      else $mylist[] = ereg_replace("#.*$", "", $regs[2]);
      $text = substr($text, strpos($text, $regs[1]) + strlen($regs[1]));
   }

   $mylist = sortarray($mylist);
   for($i=0; $i<count($mylist); $i++) {
      $temp = "";
      if (!eregi("^(mailto|news|javascript|ftp)+:(//)?", $mylist[$i])) {
         if (!eregi("^http://", $mylist[$i])) $temp = specialconcat($url, $mylist[$i]);
		 else $temp = $mylist[$i];
      }
	  else {
	     if ($otherLinks) $temp = $mylist[$i];
	  }
	  if ($temp && $temp != $url) $return[] = $temp;
   }
   if (count($return) != 0) return $return;
   else return false;
}

if ($url && !eregi("^http://", $url)) $url = "http://$url";

if ($url && (eregi("^http://[0-9a-z.-@:]+", $url) || !eregi("^http://.*/.*[|><]", $url))) {
   if ($removeQ) $url = ereg_replace("\?.*$", "", $url);
   $urlArray = parse_url($url);
   if (!$urlArray[port]) $urlArray[port] = "80";
   if (!$urlArray[path]) $urlArray[path] = "/";
   if ($urlArray[query]) $urlArray[path] .= "?$urlArray[query]";
   $uri = "http://".$extra.$urlArray[host].$urlArray[path];
   while($uri != firstArd($uri) && $trin++ < 5) {
      $uri = firstArd($uri);
	  $steps[] = $uri;
   }
}

?>

<html>

<head>
<title>Linkchecker for BerliOS</title>
<style type="text/css">
body {
  background-color: rgb(255,255,255);
}

td, p, li, .p {
  font-family:verdana, sans-serif;
  font-size:10pt;
}

th {
  font-family:verdana, sans-serif;
  font-size:10pt;
  background-color:rgb(0,0,0);
  color:rgb(255,255,255);
}

h1 {
  font-family:verdana, sans-serif;
}
</style>
</head>

<body>

<h1>Linkchecker for BerliOS</h1>
Displays all links whose response is different from 200 = OK or 302 = Found.
<P>

<? if ($url) { ?>

   <table width="100%">

   <tr><td width=35% valign="top">

<? } ?>

<table>
 <form action="<? print basename($PHP_SELF) ?>" name="submitForm">
  <tr><td colspan="2"><input name="url" size="40" class="oneline" value="<? $uri ? print $uri : print $url ?>"></td></tr>
  <tr><td><input type="checkbox" name="removeQ" value="1" <? if ($removeQ) print "checked"; ?>></td><td>Remove querystring</td></tr>
  <tr><td><input type="checkbox" name="otherLinks" value="1" <? if ($otherLinks) print "checked"; ?>></td><td>Other links</td></tr>
  <tr><td>&nbsp;</td><td><input type="submit" value="  Check  " class="button"> <input type="reset" value="  Reset  " class="button">  </td></tr>
 </form>
</table>

<? if ($url) { ?>

   </td><td valign="top" rowspan="2">

<? } ?>

<?

if ($uri) {
   $liste = liste($uri);
   if (is_array($liste)) {
      print "<table border=\"1\" bordercolor=\"black\" cellspacing=\"0\">\n";
      print "<tr><th>Number</th><th>Status</th><th>Description</th><th>URL</th></tr>";
      for($i=0; $i<count($liste); $i++) {

	     if ($i == count($liste)-1) $printTemp = $uri;

		 else {
			$procent = number_format($i*100/count($liste),0,".","");
		    $printTemp = "$procent% - $liste[$i]";
	     }

       $check = check($liste[$i]);
		 $code = $check[code];
		 $check[contentType] ? $contentType = ereg_replace(";.*$", "", $check[contentType]) : $contentType = "Ukendt";
		 $statCode[$code]++;
		 $statContentType[$contentType]++;
         if (($code != 200) && ($code != 302)) {
                 print "<tr>
                 <td style=\"font-size:80%;\" nowrap>$i</td>
		 <td style=\"font-size:80%;\" nowrap>$code</td>
		 <td style=\"font-size:80%;\" nowrap>$text[$code]</td>
		 <td style=\"font-size:80%;\" nowrap>";
		 if (eregi("^text/html", $contentType) && ereg("^(2|3)+[0-9]{2}", $code)) {
		    print "<a href=\"./".basename($PHP_SELF)."?url=".rawurlencode($liste[$i])."\">".rawurldecode($liste[$i])."</a>";
		 }
		 else print rawurldecode($liste[$i]);
		 print "</td nowrap></tr>\n";
          }
      }

      print "</table>\n";
   }
   else print "<p><strong>I didn't find any links.</strong></p>";

   print '</td></tr><tr><td valign="top">';

   if (count($steps) >= 1) {
      print "<p><strong>Passerede</strong></p>";
	  print "<ol style=\"font-size:80%;\">";
      for($i=0; $i<count($steps); $i++) print "<li><p>$steps[$i]</li>\n";
	  print "</ol>";
   }

   if (count($statCode) >= 1) {
      while(list($key, $value) = each($statCode)) {
		 $procent = ereg_replace('(\.)?0+$', '', number_format(($value*100/count($liste)),2,".",""));
		 $space = "";
		 for($i=0; $i<$procent/3; $i++) $space .= "&nbsp;";
         $print_statsCode .= "<tr>
		 <td>$text[$key]</td>
		 <td style=\"text-align:right;\">$value</td>
		 <td><span style=\"background-color:navy;\">$space</span>&nbsp;$procent%</td>
		 </tr>\n";
      }
	  print "<p><strong>Responce codes</strong></p>";
	  print "<table xborder=\"1\" bordercolor=\"black\" cellspacing=\"0\">";
	  print "<tr><th nowrap>Status&nbsp;&nbsp;</th>
	             <th nowrap>Number&nbsp;&nbsp;</th>
				 <th nowrap>Percent</th></tr>";
	  print $print_statsCode;
	  print "</table>";
   }

   if (count($statContentType) >= 1) {
      while(list($key, $value) = each($statContentType)) {
		 $procent = ereg_replace('(\.)?0+$', '', number_format(($value*100/count($liste)),2,".",""));
		 $space = "";
		 for($i=0; $i<$procent/3; $i++) $space .= "&nbsp;";
         $print_statsContent .= "<tr>
		 <td>$key</td>
		 <td style=\"text-align:right;\">$value</td>
		 <td><span style=\"background-color:navy;\">$space</span>&nbsp;$procent%</td>
		 </tr>\n";
      }
	  print "<p><strong>Content-Type</strong></p>";
	  print "<table xborder=\"1\" bordercolor=\"black\" cellspacing=\"0\">";
	  print "<tr><th nowrap>Content-Type&nbsp;&nbsp;</th>
	             <th nowrap>Number&nbsp;&nbsp;</th>
				 <th nowrap>Percent</th></tr>";
	  print $print_statsContent;
	  print "</table>";
   }

   print '</td></tr>';
  

}

if ($url && !$uri) print "<div align=\"center\"><p><strong>Invalid adresse.</strong></p></div>";

?>

<? if ($url) { ?>

   </td></tr>

<? } ?>

</table>

</body>

</html>
