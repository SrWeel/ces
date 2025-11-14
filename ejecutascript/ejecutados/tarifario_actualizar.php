<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");



$cuenta_alerta=0;
$lista_tablas="select * from efacsistema_producto order by prod_codigo asc";
$rs_tablas = $DB_gogess->executec($lista_tablas,array());
if($rs_tablas)
	{
		while (!$rs_tablas->EOF) {
		
		$precioac='';
		$precioac1='';
		$precio_val=0;
		
		$precioac=$rs_tablas->fields["prod_codigo"]." Nivel:".$rs_tablas->fields["prod_nivel"]." Precio:".$rs_tablas->fields["prod_precio"]."<br>";
		
		$busca_migrar="select * from cesdb_arextension.dns_tarifariomigrar where tarif_codigo='".trim($rs_tablas->fields["prod_codigo"])."'";		
		$rs_migrar = $DB_gogess->executec($busca_migrar,array());
		
		if($rs_tablas->fields["prod_nivel"]==1)
		{	    
		    $precioac1="Precio Nivel 1:".$rs_migrar->fields["tarif_valor1"]."<br>";
			$precio_val=$rs_migrar->fields["tarif_valor1"];
		}
		
		
		if($rs_tablas->fields["prod_nivel"]==2)
		{	    
		    $precioac1="Precio Nivel 2:".$rs_migrar->fields["tarif_valor2"]."<br>";
			$precio_val=$rs_migrar->fields["tarif_valor2"];
		}
		
		if($rs_tablas->fields["prod_precio"]!=$precio_val)
		{
		    echo $precioac.$precioac1;
			if($precio_val>0)
			{
			$actualiza_precio="update efacsistema_producto set prod_actualizado='1',prod_precio='".$precio_val."' where prod_id='".$rs_tablas->fields["prod_id"]."'";
			$rs_acprecio = $DB_gogess->executec($actualiza_precio,array());
			}
		}
		echo "<hr>";
		
		
		$rs_tablas->MoveNext();
		}
		
	}	
?>