<style type="text/css">
<!--
.temare {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo3 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>      
<SCRIPT LANGUAGE=javascript>
<!--

function imprimir() {
window.open('<?php echo $objtemplatep->path_template; ?>imp.php?ar=<?php echo $ar; ?>&system=<?php echo $system ?>','ventana1','width=600,height=600,scrollbars=YES');

}
//-->
</SCRIPT>
<table width="930"  border="0" cellpadding="0" cellspacing="0">
  <tr class="linkart">
    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="48%"><?php //$objtweb->paginararticulo('izquierda',$ar,$system,$sessid); ?></td>
        <td width="52%"><div align="right">
          <?php //$objtweb->paginararticulo('derecha',$ar,$system,$sessid); ?>
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><?php
		//$objcontenido->temas_rlista($ar,$system,$sessid);
         $objcontenido->temas_rlistamenu($ar,$system,$sessid,'menutop2','');
      ?></td>
      </tr>
      <tr>
        <td colspan="2">
          <?php          
		  if ($objcontenido->con_menu)
		  {
            $objcontenido->display_menu($objcontenido->con_menu,$varsend,$system,$sessid);
			}
           ?>        </td>
      </tr>
    </table>
      <table width="930" border="0" cellpadding="4">
        <tr valign="top" >
          <td width="88%" >
		  <div class="txtar">
            <?php         
			
			    if ($objcontenido->foto_grande)
                        {            

							 echo "<center><img src='".$objcontenido->foto_grande."'></center><br><br>";
                         } 
				?>
				<div id="quijote1-1">
				
				<?php		           
                       if ($objcontenido->con_contenido)
                        {
                             echo $objcontenido->con_contenido;
                         }
           ?>
		   
		  <?php
		
		  if ($objcontenido->catf_id>0)
		  {
		  ?> 
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#DDE7EC" class="titulod"><div align="center" class="tituloar">GALERIA DE FOTOS </div></td>
                  </tr>
                  <tr>
                    <td>
                      <?php
	$salfotos="select * from cone_categfoto where catf_activo=1 and catf_id=".$objcontenido->catf_id;
	$resultado = mysql_query($salfotos);
  	while($rowfot = mysql_fetch_array($resultado)) 
			{	
			
			$nombre=$rowfot["catf_nombre"];
			$detalle=$rowfot["catf_detalle"];
			$fecha=$rowfot["catf_fecha"];
			$catf_id=$rowfot["catf_id"];
			include($objtemplatep->path_template."fotoslista.php");		
			
			}
	
	
	?>                    </td>
                  </tr>
                </table>		
				<?php
				}
				?>
		   </div>
	      </div>          </td>
        </tr>
    </table></td>
  </tr>
  <tr class="linkart">
    <td width="384" valign="top"><?php //$objtweb->paginararticulo('izquierda',$ar,$system,$sessid); ?></td>
    <td width="416" valign="top"><div align="right">
      <?php //$objtweb->paginararticulo('derecha',$ar,$system,$sessid); ?>
    </div>
    <div align="right"></div></td>
  </tr>
  <tr class="linkart">
    <td colspan="2" valign="top">&nbsp;</td>
  </tr>
</table>
