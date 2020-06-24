<?php
  error_reporting(0); define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'sistema');
   $link = mysql_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
   $db = mysql_select_db(DB_DATABASE, $link);
   mysql_query("SET NAMES 'utf8'");
   date_default_timezone_set("America/Santiago");
?>