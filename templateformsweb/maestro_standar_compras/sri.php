<?php
$compretcab_id=$_POST["pVar1"];

?>
<div class="row" align="center" >
   <div id="div_firma" class="col-sm-3"> 
	<div id="firma_btn" ><div onClick="firma_directaret('<?php echo $compretcab_id; ?>')" style="cursor:pointer" ><img src="images/firma.png"></div></div>
  </div> 

  <div id="div_srienviar" class="col-sm-3">
	<div id="sri_btn" ><div onClick="enviar_sriret('<?php echo $compretcab_id; ?>')" style="cursor:pointer" ><img src="images/sri.png"></div></div>
  </div>
  
  <div id="div_sriobtener" class="col-sm-3">
	<div onClick="obtener_sriret('<?php echo $compretcab_id; ?>')" style="cursor:pointer" ><img src="images/srirecibir.png"></div>
  </div>
  
  <div id="div_sriemail" class="col-xs-3">
	<div onClick="enviar_correoret('<?php echo $compretcab_id; ?>')" style="cursor:pointer" ><img src="images/sriemail.png"></div>
  </div> 
  
</div>   
<div id="area_retsri"></div>