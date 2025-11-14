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
?>

 <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#section1">Antecedentes 1</a></li>
        <li><a data-toggle="tab" href="#section2">Antecedentes 2</a></li>
        <li><a data-toggle="tab" href="#section3">Antecedentes 3</a></li>
        <li><a data-toggle="tab" href="#section4">Antecedentes 4</a></li>
        
        
    </ul>
    <div class="tab-content">
        <div id="section1" class="tab-pane fade in active">
            <h3>Antecedentes 1</h3>
            <p>
			<table><?php 
			$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
			
			?></table></p>
        </div>
        <div id="section2" class="tab-pane fade">
            <h3>Antecedentes 2</h3>
            <p><table><?php 
			$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
			
			?></table></p>
        </div>
        <div id="section3" class="tab-pane fade">
            <h3>Antecedentes 3</h3>
            <p><table><?php 
			$objformulario->generar_formulario(@$submit,$table,4,$DB_gogess); 
			
			?></table></p>
        </div>
        <div id="section4" class="tab-pane fade">
            <h3>Antecedentes 4</h3>
            <p><table><?php 
			$objformulario->generar_formulario(@$submit,$table,5,$DB_gogess); 
			
			?></table>
            <?php $objformulario->generar_formulario(@$submit,$table,6,$DB_gogess); ?></p>
        </div>
        
    </div>


<?php       
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