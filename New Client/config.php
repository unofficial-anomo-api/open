<?php
$baseurl = "http://ws.anomo.com/v101/index.php/webservice/";
$db = new SQLite3('<path to sqlite3 database>');
$site_subdomain = '<oneall domain>';
  $site_public_key = '<oneall public key>';
  $site_private_key = '<oneall private key>';
 
  //API Access domain
  $site_domain = $site_subdomain.'.api.oneall.com';
?>