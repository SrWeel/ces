<?php
require('json-rpc.php');
require("../adodb/adodb.inc.php");
require('../cfgclases/config.php');
if (function_exists('xdebug_disable')) {
    xdebug_disable();
}

$query="select * from gogess_menu";
$DB_gogess->SetFetchMode(ADODB_FETCH_NUM);
    if ($res = $DB_gogess->Execute($query)) {
      if ($res == true) {
        //return true;
      }
      if ($res->RecordCount() > 0) {
         while (!$res->EOF) { 
          $result[] = $res->fields;
		   $res->MoveNext();	
        }
       
      } else {
       
      }
    } else {
      throw new Exception("MySQL Error: ");
    }
  
print_r($result);


?>
