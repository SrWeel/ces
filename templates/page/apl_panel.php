<!DOCTYPE html>
<html translate="no" >

<head>
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="CL&Iacute,NICA DE ESPECIALIDADES DEL SUR,Medicina, Tecnologia" />
    <meta name="keywords" content="Clinica, Medicina, Tecnologia, Medicos, Enfermeros"/>
    <meta name="author" content="Tansh" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php  echo $objportal->sys_titulo ?></title>
<?php include($objtemplatep->path_template."/cssjs_apl.php"); ?>
<?php
$busca_datosus="select usua_archivo,usua_nombre,usua_apellido,usua_esusuario,usua_esproveedor from app_usuario where usua_id=?";
$rs_usuarios = $DB_gogess->executec($busca_datosus,array(@$_SESSION['ces1313777_sessid_inicio']));

function xencrypt($text) {
           
			return base64_encode($text);
   }

	

function xsacaaleat()
	{
						$clave='';
						$max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres
						$chars = array();
						for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
						$chars[] = "z";
						for ($i=0; $i<$max_chars; $i++) {
							$clave .= round(rand(0, 9));
						}
								
					   return  $clave; 
	}
	
	function xvariables_segura($linksvar)
	{
		 $valorext=xsacaaleat();
		 $valoresencriptados=xencrypt($linksvar);																						
		 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);
		 return $linksvarencri;
	}

?>

</head>

<body hoe-navigation-type="vertical" hoe-nav-placement="left" theme-layout="wide-layout" theme-bg="bg1"  >
<div id="site">
        <!--==========================-->
		<!--=        Header          =-->
		<!--==========================-->
<?php
$homeactual='';

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$linksvar="";
$linksvarencri="";
$linksvar="apl=17&secc=7&tipo=".@$tipo;	
$linksvarencri=xvariables_segura($linksvar);
$homeactual='index.php?snp='.$linksvarencri;
}
else
{
$homeactual='index.php';
}


					
						$variables_ext["idactv"]=@$idactv;
		                $variables_ext["cj"]=@$cj;
						$variables_ext["tiporeg"]=@$tipo;
						
		                $objcontenido_sistema->despliega_contenido(@$idmen,@$seccapl,@$apl,$objtemplatep->path_template,@$secc,$variables_ext,$DB_gogess);
						

?>
		

</div>

<?php include($objtemplatep->path_template."piejs_apl.php"); ?>


</body>

</html>