<style type="text/css">
<!--
.Estilo2 {	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.borde_cssbarra {	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #999999;
}
-->
</style>
  <?php
	  
							if($_SESSION['ces1313777_sessid_inicio'])
								  {
							?>
<table width="100%" height="40" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="81%" bgcolor="#F3F3F3"><div class="Estilo2"> <?php
						
						 //$objcontenido->objetos_seccion(1,'t',$varsend,$system,$DB_gogess);
						  $objcontenido->despliega_menuapl($idvalor_opcion,$apl,$DB_gogess);
						  
						 
						?></div></td>
    <td width="19%" bgcolor="#F3F3F3"><div align="center" class="Estilo2">
      <?php
								
								  if($_SESSION['ces1313777_sessid_inicio'])
								  {
								  						   						
									echo '<table border="0" cellpadding="0" cellspacing="0">
										  <tr>
											<td>&nbsp;</td>
											<td onclick="salir_sistema()" style="cursor:pointer" ><img src="images/salir.png" width="25" height="25" align="middle"  /> Salir</td>
										  </tr>
										</table>';
								  }
								  ?>
    </div></td>
  </tr>
</table>

<?php
							  }
							  ?>