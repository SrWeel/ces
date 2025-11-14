<?php
if($_SESSION['ces1313777_sessid_inicio'])
 {
  //--------------------------------------
 $objcontenido_apl=new contenido_apl();	 
	 
 $buscaopcionapl="select * from gogess_opcionaplicativo where ap_id=? and opap_activo='?'";

 $rs_aplopciones = $DB_gogess->executec($buscaopcionapl,array($apl,1));
  if($rs_aplopciones)
  {
     	while (!$rs_aplopciones->EOF) {
		
		
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["ejecuta"]=$rs_aplopciones->fields["opap_ejecuta"];
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["id"]=$rs_aplopciones->fields["opap_id"];
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["nombre"]=$rs_aplopciones->fields["opap_nombre"];
		
		if($rs_aplopciones->fields["opap_intro"]==1)
		{
		 $opcioninical=$rs_aplopciones->fields["opap_ejecuta"];
		 $idopcioninical=$rs_aplopciones->fields["opap_id"];
		}
		
		$rs_aplopciones->MoveNext(); 
		}
  }
  
 //print_r($arrayopciones);
  $idvalor_opcion=0;
?>
	<!-- INICIO de Menudero -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="menumargen" style="font-family:Arial, Helvetica, sans-serif; font-size:10px">
		<!-- DESDE ESTA L&Iacute;NEA ESTRUCTURA DE SOLO MEN&Uacute; -->
		<nav class="navbar navbar-default" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">DOMOHS</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		<!-- &lt;h:form onsubmit="return false;"&gt; -->
		<label>
		<ul class="nav navbar-nav">
		
		<?php 
  if(!(@$seccapl))
  {
	  
	  $idvalor_opcion=@$idopcioninical;
	 
	 //--------------------------------------
	  $objcontenido_apl->despliega_menuapl_li(@$idvalor_opcion,$apl,$DB_gogess);

						  
  }
  else
  {
	   $idvalor_opcion=$arrayopciones[$seccapl]["id"];
	   $pantalla_nombre=$arrayopciones[$seccapl]["nombre"];
	   $objcontenido_apl->despliega_menuapl_li(@$idvalor_opcion,$apl,$DB_gogess);
	  
  }
?>
	
		</ul>
		</label>
		
		
		<!-- &lt;/h:form&gt; -->
		<!-- DESDE ESTA L&Iacute;NEA INICIA ITEMS DE MENUDERO RIGHT -->
		<ul >
			<!-- DESDE LA L&Iacute;NEA DE ABAJO QUEDA OCULTO, PARA USAR LUEGO 
              ======
              &lt;li&gt;&lt;a href="#"&gt;&amp;nbsp;&lt;/a&gt;&lt;/li&gt;
              ====== 
              HASTA LA L&Iacute;NEA DE ARRIBA, QUEDA PARA USAR BUSCADOR
              -->
			  <?php
			   $busca_usuario="select * from app_usuario where usua_id=".$_SESSION['ces1313777_sessid_inicio'];
			   $result_usuario=$DB_gogess->executec($busca_usuario,array());
			   ?>
			<li><p id="txtmediomenu"><?php
				  echo $result_usuario->fields["usua_nombre"];
				  ?></p></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Mi Perfil<b class="caret"></b></a>
				<ul >
					<li><p id="txtmediomenu"><?php
				  echo $result_usuario->fields["usua_nombre"];
				  ?></p></li>
					<li>
 <a href="#" class="btn btn-default btn-flat" onclick="salir_sistema()" >Salir</a></li>
					<li><a href="http://www.todoenkargo.com/beko" target="_blank">Ir al Portal</a></li>
				</ul></li>
		</ul>
		<!-- DESDE ESTA L&Iacute;NEA FINALIZA ITEMS DE MENUDERO RIGHT -->
			</div>
			<!-- /.navbar-collapse -->
		</nav>
	</div>
	<!-- FIN de Menudero -->
<?php
}
?>