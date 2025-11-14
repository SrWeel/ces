<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

//$acfi_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">'; 
$cuentalista=0;

   $busca_paraentrega="SELECT * from dns_cuadrobasicomedicamentos";
   $rs_paraentrega = $DB_gogess->executec($busca_paraentrega,array());
  if($rs_paraentrega)
   {
	  while (!$rs_paraentrega->EOF) {
	  
	      
		  $totlallega=0;
		  $totalsale=0;
	      $busca_variacion="SELECT `moviin_id`,`cuadrobm_id`,
`moviin_totalenunidadconsumo`,
(select sum(moviin_totalenunidadconsumo) from dns_principalmovimientoinventario tbl2 where tbl2.cuadrobm_id=tbl1. cuadrobm_id and `tipom_id` = 2 and tbl2.moviintranscent_id=tbl1.moviin_id) as consumido 
 FROM `dns_principalmovimientoinventario` as tbl1 WHERE  tbl1.`tipom_id` = 1 and cuadrobm_id='".$rs_paraentrega->fields["cuadrobm_id"]."'";
 
          $rs_bvariacion = $DB_gogess->executec($busca_variacion,array());
		  if($rs_bvariacion)
           {
	              while (!$rs_bvariacion->EOF) {
		    
			       $totlallega=$totlallega+$rs_bvariacion->fields["moviin_totalenunidadconsumo"];
				   $totalsale=$totalsale+$rs_bvariacion->fields["consumido"];
			
			       $rs_bvariacion->MoveNext();
                  }
		   }		  
	    $disponible=0;
		$disponible=$totlallega-$totalsale;
		
		$stockac="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual where centro_id='55' and cuadrobm_id='".$rs_paraentrega->fields["cuadrobm_id"]."'";
		
		$rs_stack = $DB_gogess->executec($stockac,array());
		
		if($disponible!=$rs_stack->fields["stactual"])
		{
		$cuentalista++;
	     ?>
		 
  <tr>
    <td><?php echo $cuentalista; ?></td>
	<td><?php echo $rs_paraentrega->fields["cuadrobm_id"]; ?></td>
    <td><?php echo $rs_paraentrega->fields["cuadrobm_codigoatc"]; ?></td>
    <td><?php echo $totlallega; ?></td>
    <td><?php echo $totalsale; ?></td>
	<td><?php echo $disponible; ?></td>
	<td><?php echo $rs_stack->fields["stactual"]; ?></td>
	
  </tr>
		 
		 <?php
		 }
	  
	    $rs_paraentrega->MoveNext();
	  }
	}  


echo '</table>';

}


?>