<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444454000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$comillasimple="'"; 

/*

 * DataTables example server-side processing script.

 *

 * Please note that this script is intentionally extremely simply to show how

 * server-side processing can be implemented, and probably shouldn't be used as

 * the basis for a large complex system. It is suitable for simple use cases as

 * for learning.

 *

 * See http://datatables.net/usage/server-side for full details on the server-

 * side processing requirements of DataTables.

 *

 * @license MIT - http://datatables.net/license_mit

 */



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * Easy set variables

 */



// DB table to use

$table = $_POST['tabla'];





// Table's primary key

$primaryKey =  $_POST['id'];

$lista_campos= $_POST['lista'];



//$file = fopen("archivo.txt", "w");

//fwrite($file, $lista_campos. PHP_EOL);

//fclose($file);



// Array of database columns which should be read and sent back to DataTables.

// The `db` parameter represents the column name in the database, while the `dt`

// parameter represents the DataTables column identifier. In this case object

// parameter names

/*$columns = array(

	array( 'db' => 'first_name', 'dt' => 'first_name' ),

	array( 'db' => 'last_name',  'dt' => 'last_name' ),

	array( 'db' => 'position',   'dt' => 'position' ),

	array( 'db' => 'office',     'dt' => 'office' ),

	array(

		'db'        => 'start_date',

		'dt'        => 'start_date',

		'formatter' => function( $d, $row ) {

			return date( 'jS M y', strtotime($d));

		}

	),

	array(

		'db'        => 'salary',

		'dt'        => 'salary',

		'formatter' => function( $d, $row ) {

			return '$'.number_format($d);

		}

	)

);

*/

//-------------------------------------------------------

$lista_data=explode(",",$lista_campos);

//print_r($lista_data);

for($ib=0;$ib<count($lista_data);$ib++)

{

  if($lista_data[$ib])

  {

  $campos_data[$ib]['db']=$lista_data[$ib];

  $campos_data[$ib]['dt']=$lista_data[$ib]; 

  }

}

$columns=$campos_data;

//-------------------------------------------------------



// SQL server connection information

$sql_details = array(

	'user' => $user,

	'pass' => $pass,

	'db'   => $dbname,

	'host' => $host

);





/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

 * If you just want to use the basic configuration for DataTables with PHP

 * server-side, there is no need to edit below this line.

 */



require( 'ssp.class.php' );

$where = base64_decode($_POST["filtro"]);

/*$file = fopen("archivo.txt", "w");
fwrite($file,$consulta);
fclose($file);*/
$valor='';
$valor=json_encode(

	SSP::complex( $_POST, $sql_details, $table, $primaryKey, $columns,$where,$where)

);

echo $valor;
/*
$file = fopen("archivo.txt", "w");
fwrite($file,$valor);
fclose($file);*/
?>