<?php
require('json-rpc.php');
//define('ADODB_ASSOC_CASE',2); 
require("../adodb/adodb.inc.php");
require('../cfgclases/config.php');



if (function_exists('xdebug_disable')) {
    xdebug_disable();
}


class MysqlDemo {
  public function query($query) {
    global $DB_gogess;
    if (preg_match("/create|drop/", $query)) {
      throw new Exception("Sorry you are not allowed to execute '" . 
                          $query . "'");
    }
    if (!preg_match("/(select.*from *|insert *into *.*|delete *from *|update *)/", $query)) {
      throw new Exception("Sorry you can't execute '" . $query .
                          "' you are only allowed to select, insert, delete " .
                          "or update 'chef_alumno' table");
    }
	
	
    if ($res = $DB_gogess->Execute($query)) {

      if ($res->RecordCount() > 0) {
        while (!$res->EOF) { 
		//while ($row = $res->fetch_array(MYSQLI_NUM)) {
          $result[] = $res->fields;
		  
		  $res->MoveNext();	 
        }
		
        
		$fp = fopen("fichero.txt", "w");
	fputs($fp, implode($result));
	fclose($fp);
		
		return $result;
		
		
		
      } else {
        return array();
      }
	  
    } else {
      throw new Exception("MySQL Error: ");
    }
  }
}

handle_json_rpc(new MysqlDemo());
/*$fp = fopen("fichero.txt", "w");
	fputs($fp, "cccc");
	fclose($fp);*/
?>
