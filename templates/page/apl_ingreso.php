<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="CL&Iacute,NICA DE ESPECIALIDADES DEL SUR,Medicina, Tecnologia" />
    <meta name="keywords" content="Clinica, Medicina, Tecnologia, Medicos, Enfermeros"/>
    <meta name="author" content="Tansh" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php  echo $objportal->sys_titulo ?></title>
<?php include($objtemplatep->path_template."/cssjs_reg.php"); ?>

</head>

<body>
		
<?php
					
						$variables_ext["idactv"]=@$idactv;
		                $variables_ext["cj"]=@$cj;
						$variables_ext["tiporeg"]=@$tipo;
						
		                $objcontenido_sistema->despliega_contenido(@$idmen,@$seccapl,@$apl,$objtemplatep->path_template,@$secc,$variables_ext,$DB_gogess);
?>
							
		


	<?php include($objtemplatep->path_template."piejs_reg.php"); ?>


</body>

</html>