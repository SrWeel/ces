 <script language="javascript">
<!--


//referencia
</script>
 
 <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=1;	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["sisu_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			 $objformulario->sendvar["usr_tpingx"]=0;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
	 $valoralet=mt_rand(1,500);

			 $aletorioid='01'.@$_SESSION['ces1313777_usua_id'].date("Ymdhis").$valoralet;

			 $objformulario->sendvar["clie_tokenx"]=$aletorioid;				 


$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?><?php       
if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";

?>
<div id=div_<?php echo $table ?> > </div>


<script language="javascript">
<!--



//-->

</script>