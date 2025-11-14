<?php
require('json-rpc.php');
require("../adodb/adodb.inc.php");
require('../cfgclases/config.php');
if (function_exists('xdebug_disable')) {
    xdebug_disable();
}


class MysqlDemo {
  public function query($query) {
    global $DB_gogess;
	$DB_gogess->SetFetchMode(ADODB_FETCH_NUM);
    if (preg_match("/create|drop/", $query)) {
      throw new Exception("Sorry you are not allowed to execute '" . 
                          $query . "'");
    }
    if (!preg_match("/(select.*from *|insert *into *.*|delete *from *|update *)/", $query)) {
      throw new Exception("Sorry you can't execute '" . $query .
                          "' you are only allowed to select, insert, delete " .
                          "or update  table");
    }
	
    if ($res = $DB_gogess->Execute($query)) {
      
      if ($res->RecordCount() > 0) {
        while (!$res->EOF){
          $result[] = $res->fields;
		  $res->MoveNext();	
        }
        return $result;
      } else {
        return array();
      }
    } else {
      throw new Exception("MySQL Error: " . mysql_error());
    }
  }
}

//print_r(new MysqlDemo());
handle_json_rpc(new MysqlDemo());

?>
