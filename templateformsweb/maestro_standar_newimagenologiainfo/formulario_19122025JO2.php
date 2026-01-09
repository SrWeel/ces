<style>
  .ui-autocomplete {
    max-height: 400px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 400px;
  }
  </style>
<?php

	        //---ENLACE
			$enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$clie_id;
			
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["atenc_idx"]=$atenc_id;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//asigna medico
			
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
            
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			$objformulario->sendvar["imgag_idx"]=$_POST["pVar7"];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			$objformulario->sendvar["imginfo_horax"]=date("H:i:s");
			 
			$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["imginfo_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			if($id_llega>0)
			{
            $objformulario->subtabla=$id_llega;
			}
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
?>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  echo $rs_atencion->fields["atenc_hc"]; ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto">

      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
	   <?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>

    </td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">TEL&Eacute;FONO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">EDAD (A la fecha de atenci&oacute;n):</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	?></td>
  </tr>
   <tr>
    <td bgcolor="#D3E0EB"><span class="css_paciente">ESTABLECIMIENTO:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,77,$DB_gogess); ?> </td>
    <td bgcolor="#D3E0EB"><span class="css_paciente">PROFESIONAL:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,88,$DB_gogess); ?></td>
  </tr>
</table>


<p>&nbsp;</p>

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
?>
<div class="form-group">
    <?php $objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); ?>
    <div class="text-center mt-2">
        <button type="button" class="btn btn-success ml-2" onclick="document.getElementById('dicomFiles').click()">
            <span class="glyphicon glyphicon-file"></span> DICOM
        </button>
    </div>
    <input type="file" id="dicomFiles" name="dicomFiles[]" webkitdirectory directory multiple style="display:none;" onchange="previewDicomFiles(this.files)">

    <!-- Campo oculto para guardar la ruta de la carpeta DICOM -->
    <input type="hidden" id="dicom_folder_path" name="dicom_folder_path" value="">
    <input type="hidden" id="dicom_files_count" name="dicom_files_count" value="0">
</div>

<!-- Carrusel de miniaturas -->
<div id="dicomPreview" style="margin-top:20px; display:none;">
    <div style="position:relative; max-width:400px; margin:0 auto;">
        <div id="currentDicomContainer" style="text-align:center; position:relative;">
            <div id="currentDicomImage" style="width:300px; height:300px; border:1px solid #ccc; margin:0 auto; cursor:pointer; background:#000;"></div>
            <p id="imageCounter" style="margin-top:10px; font-weight:bold;"></p>
        </div>

        <div style="text-align:center; margin-top:15px;">
            <button id="prevBtn" class="btn btn-primary" onclick="navigateCarousel(-1)" style="margin-right:10px;">
                <span class="glyphicon glyphicon-chevron-left"></span> Anterior
            </button>
            <button id="nextBtn" class="btn btn-primary" onclick="navigateCarousel(1)">
                Siguiente <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
        </div>

        <!-- Progress bar para la carga -->
        <div id="uploadProgress" style="margin-top:15px; display:none;">
            <div class="progress">
                <div id="uploadProgressBar" class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%">
                    <span id="uploadProgressText">0%</span>
                </div>
            </div>
            <p id="uploadStatus" style="text-align:center; margin-top:5px;">Subiendo archivos...</p>
        </div>
    </div>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);

if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input  name='clie_idx'  type='hidden' value='". $clie_id ."'>

<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";
?>
<div id=div_<?php echo $table ?> > </div>


<?php
$bandera_cie=0;
if($objformulario->contenid["imginfo_enlace"])
{
     $busca_diag="select count(*) as total from dns_diagnosticoimagen where imginfo_enlace='".$objformulario->contenid["imginfo_enlace"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
     
	 $bandera_cie=$rs_diag->fields["total"];
}
else
{
     $busca_diag="select count(*) as total from dns_diagnosticoimagen where imginfo_enlace='".$objformulario->sendvar["imginfo_enlacex"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
	 
	 $bandera_cie=$rs_diag->fields["total"];

}
?>


<script>
         $(function() {
            $( "#diagn_ciex<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx<?php echo $objformulario->subtabla; ?>').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#diagn_descripcionx<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagn_ciex<?php echo @$objformulario->subtabla; ?>').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 
		 	  $(function() {
            $( "#prod_codigox<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#prod_descripcionx<?php echo @$objformulario->subtabla; ?>').val(ui.item.descripcion);
				  $('#prod_preciox<?php echo @$objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		  $(function() {
            $( "#prod_descripcionx<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#prod_codigox<?php echo @$objformulario->subtabla; ?>').val(ui.item.codigo);
				  $('#prod_preciox<?php echo @$objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });
		 
		  $(function() {
            $( "#plantrai_codigox<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantrai_nombredispositivox<?php echo @$objformulario->subtabla; ?>').val(ui.item.descripcion);
				  $('#plantrai_preciox<?php echo @$objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantrai_nombredispositivox<?php echo @$objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivotxt.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#plantrai_codigox<?php echo @$objformulario->subtabla; ?>').val(ui.item.codigo);
				  $('#plantrai_preciox<?php echo @$objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 
		   
function genera_cieexterno(codigo,diagn_tipox,idext)
{

$.ajax({
    // la URL para la petici�n
    url : 'templateformsweb/maestro_standar_imagenologiainfo/searchcie.php',
    // la informaci�n a enviar
    // (tambi�n es posible utilizar una cadena de datos)
    data : { term : codigo },
    // especifica si ser� una petici�n POST o GET
    type : 'GET',
    // el tipo de informaci�n que se espera de respuesta
    dataType : 'json',
    // c�digo a ejecutar si la petici�n es satisfactoria;
    // la respuesta es pasada como argumento a la funci�n
    success : function(json) {
        //console.log(json[0]);	
		$('#diagn_ciex'+idext).val(json[0].codigo);
		$('#diagn_descripcionx'+idext).val(json[0].descripcion);
		$('#diagn_tipox'+idext).val(diagn_tipox);
		
    },
    // c�digo a ejecutar si la petici�n falla;
    // son pasados como argumentos a la funci�n
    // el objeto de la petici�n en crudo y c�digo de estatus de la petici�n
    error : function(xhr, status) {
        ///alert('Disculpe, existi� un problema');
    },
    // c�digo a ejecutar sin importar si la petici�n fall� o no
    complete : function(xhr, status) {
        ///alert('Petici�n realizada');
		grid_extras_3987($('#imginfo_enlace').val(),0,1);
    }
});


} 
	
	
	
<?php
if($bandera_cie==0)
{

//busca diagnosticos

//lab_tablaexterno
//imgag_idexterno
$campo_idext='';

//$objformulario->sendvar["imgag_idexternox"]=@$id_llega;
//$objformulario->sendvar["lab_tablaexternox"]=@$tabla_llega;
			 
if($objformulario->sendvar["imgag_idx"]>0)
{
    
	
	$busca_diag="select * from dns_imagenologia where imgag_id='".$objformulario->sendvar["imgag_idx"]."'";
	$rs_budiag = $DB_gogess->executec($busca_diag,array());
	
	//busca datos del diagnostico
	$busca_campodiag="select * from gogess_sisfield where tab_name='dns_imagenologia' and ttbl_id=1 and fie_tablasubgrid!=''";
	$rs_campodiag = $DB_gogess->executec($busca_campodiag,array());
	
	$busca_listadiag="select * from ".$rs_campodiag->fields["fie_tablasubgrid"]." where ".$rs_campodiag->fields["fie_campoenlacesub"]."='".$rs_budiag->fields[$rs_campodiag->fields["fie_campoenlacesub"]]."' order by 1 asc";
	 $rs_listd = $DB_gogess->executec($busca_listadiag,array());
	 if($rs_listd)
     {
	   while (!$rs_listd->EOF) {	
	   
	       echo " genera_cieexterno('".$rs_listd->fields["diagn_cie"]."','".$rs_listd->fields["diagn_tipo"]."','".$id_llega."'); ";
	  
	    $rs_listd->MoveNext();	
	   }	 
	 } 
	
	//busca datos del diagnostico
	
	

}			 

//busca dianosticos

}
?>	
		 
</script>

<script>
    var dicomImages = [];
    var currentIndex = 0;
    var modalElement = null;
    var currentImage = null;
    var modalViewport = null;
    var isInitialized = false;
    var wheelListener = null;
    var dicomFilesArray = [];

    // newsrweel
    var isUploading = false;
    var uploadCompleted = false;
    var scriptsLoaded = 0;
    var scriptsTotal = 3;

    function onScriptLoaded() {
        scriptsLoaded++;
        console.log('✓ Script cargado (' + scriptsLoaded + '/' + scriptsTotal + ')');

        if (scriptsLoaded === scriptsTotal) {
            console.log('🎉 Todas las bibliotecas cargadas, inicializando...');
            initializeCornerstone();
        }
    }

    function loadScript(src, callback) {
        var script = document.createElement('script');
        script.src = src;
        script.onload = callback;
        script.onerror = function() {
            console.error('❌ Error cargando script:', src);
            alert('Error al cargar biblioteca DICOM. Intenta recargar la página o verifica tu conexión.');
        };
        document.head.appendChild(script);
    }

    // Cargar las bibliotecas en orden - USANDO CDNJS (más confiable)
    loadScript('https://cdn.jsdelivr.net/npm/dicom-parser@1.8.9/dist/dicomParser.min.js', function() {
        console.log('dicomParser cargado');
        onScriptLoaded();

        loadScript('https://cdn.jsdelivr.net/npm/cornerstone-core@2.3.0/dist/cornerstone.min.js', function() {
            console.log('cornerstone cargado');
            onScriptLoaded();
            loadScript('https://unpkg.com/cornerstone-wado-image-loader@4.13.2/dist/cornerstoneWADOImageLoader.bundle.min.js', function() {
                console.log('✓ cornerstoneWADOImageLoader cargado');
                onScriptLoaded();
            });
        });
    });

    function initializeCornerstone() {
        if (isInitialized) {
            console.log('⚠️ Ya está inicializado');
            return true;
        }

        if (typeof cornerstone === 'undefined' ||
            typeof dicomParser === 'undefined' ||
            typeof cornerstoneWADOImageLoader === 'undefined') {
            console.error('❌ Librerías no cargadas aún');
            console.log('cornerstone:', typeof cornerstone);
            console.log('dicomParser:', typeof dicomParser);
            console.log('cornerstoneWADOImageLoader:', typeof cornerstoneWADOImageLoader);
            return false;
        }

        try {
            cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
            cornerstoneWADOImageLoader.external.dicomParser = dicomParser;

            cornerstone.registerImageLoader('wadouri', cornerstoneWADOImageLoader.wadouri.loadImage);

            cornerstoneWADOImageLoader.configure({
                beforeSend: function(xhr) {},
                useWebWorkers: true
            });

            var config = {
                maxWebWorkers: navigator.hardwareConcurrency || 1,
                startWebWorkersOnDemand: true,
                taskConfiguration: {
                    decodeTask: {
                        initializeCodecsOnStartup: false,
                        usePDFJS: false,
                        strict: false
                    }
                }
            };

            if (cornerstoneWADOImageLoader.webWorkerManager) {
                cornerstoneWADOImageLoader.webWorkerManager.initialize(config);
            }

            isInitialized = true;
            console.log('✅ Cornerstone inicializado correctamente');
            return true;
        } catch(e) {
            console.error('❌ Error al inicializar:', e);
            alert('Error al inicializar el visor DICOM: ' + e.message);
            return false;
        }
    }

    $(document).ready(function() {
        console.log('🚀 Inicializando formulario DICOM...');

        // Cargar imágenes existentes después de que cargue la página
        setTimeout(function() {
            loadExistingDicomImages();
        }, 1500);

        // Manejar submit del formulario
        $('form').on('submit', function(e) {
            console.log('📤 Form submit detectado');
            console.log('   Archivos nuevos:', dicomFilesArray.length);
            console.log('   Ya subido:', uploadCompleted);
            console.log('   Subiendo:', isUploading);

            if (dicomFilesArray.length > 0 && !uploadCompleted && !isUploading) {
                e.preventDefault();
                console.log('🛑 Subiendo DICOM primero...');
                uploadDicomFiles($(this));
                return false;
            }
        });

        console.log('✅ Formulario inicializado');
    });

    function previewDicomFiles(files) {
        // Verificar que las bibliotecas estén cargadas
        if (!isInitialized) {
            if (!initializeCornerstone()) {
                alert('Por favor espera a que se carguen las bibliotecas DICOM e intenta de nuevo.');
                return;
            }
        }
        uploadCompleted = false;
        isUploading = false;
        dicomImages = [];
        dicomFilesArray = [];
        currentIndex = 0;

        var dicomFiles = Array.from(files).filter(function(file) {
            return file.name.toLowerCase().endsWith('.dcm');
        });

        if (dicomFiles.length === 0) {
            alert('No se encontraron archivos DICOM (.dcm)');
            return;
        }

        document.getElementById('dicomPreview').style.display = 'block';

        dicomFiles.forEach(function(file) {
            try {
                var imageId = cornerstoneWADOImageLoader.wadouri.fileManager.add(file);
                dicomImages.push({
                    imageId: imageId,
                    name: file.name
                });
                dicomFilesArray.push(file);
            } catch(e) {
                console.error('Error agregando archivo:', file.name, e);
            }
        });

        document.getElementById('dicom_files_count').value = dicomFilesArray.length;

        if (dicomImages.length > 0) {
            showCurrentImage();
        } else {
            alert('No se pudieron cargar los archivos DICOM');
        }
    }

    // ... resto de tus funciones (uploadDicomFiles, showCurrentImage, etc.)
    function uploadDicomFiles(form) {
        if (isUploading) {
            console.warn('⚠️ Ya se está subiendo, ignorando...');
            return;
        }

        if (uploadCompleted) {
            console.warn('⚠️ Ya se subió anteriormente, ignorando...');
            return;
        }

        isUploading = true;
        console.log('🚀 Iniciando subida de archivos DICOM...');
        var formData = new FormData();

        // Agregar todos los campos del formulario original
        form.find('input, select, textarea').not('#dicomFiles').each(function() {
            var $field = $(this);
            var fieldName = $field.attr('name');

            if (!fieldName) return;

            if ($field.attr('type') === 'file' && $field.attr('id') !== 'dicomFiles') {
                if ($field[0].files.length > 0) {
                    formData.append(fieldName, $field[0].files[0]);
                }
            } else if ($field.attr('type') === 'checkbox') {
                formData.append(fieldName, $field.is(':checked') ? 1 : 0);
            } else if ($field.attr('type') === 'radio') {
                if ($field.is(':checked')) {
                    formData.append(fieldName, $field.val());
                }
            } else {
                formData.append(fieldName, $field.val() || '');
            }
        });

        // CRÍTICO: Asegurar que se envíen los IDs necesarios con nombres correctos
        // clie_idx - ID del paciente
        if (!formData.has('clie_idx')) {
            var clieId = $('input[name="clie_idx"]').val();
            formData.append('clie_idx', clieId);
            console.log('📌 Agregando clie_idx:', clieId);

        }

        // atenc_idx - ID de la atención
        if (!formData.has('atenc_idx')) {
            var atencId = $('input[name="atenc_idx"]').val() ||
                    $('input[name="atenc_id"]').val() ||
                    <?php echo isset($atenc_id) ? $atenc_id : 0; ?>;
            formData.append('atenc_idx', atencId);
            console.log('📌 Agregando atenc_idx:', atencId);
        }

        // imginfo_enlacex (equivalente a imgag_enlace) - Enlace único del registro
        if (!formData.has('imginfo_enlacex')) {
            var enlace = $('input[name="imginfo_enlacex"]').val() ||
                $('input[name="codex"]').val() ||
                $('#imginfo_enlace').val() ||
                $('input[name="imgag_enlace"]').val();
            formData.append('imginfo_enlacex', enlace);
            console.log('📌 Agregando imginfo_enlacex:', enlace);
        }

        // imgag_id - Si estamos editando un registro existente
        var imgag_id = $('input[name="imgag_id"]').val();
        if (imgag_id && imgag_id > 0) {
            formData.append('imgag_id', imgag_id);
            console.log('📌 Modo EDICIÓN - imgag_id:', imgag_id);
        } else {
            console.log('📌 Modo NUEVO REGISTRO');
        }

        // Agregar archivos DICOM
        dicomFilesArray.forEach(function(file, index) {
            formData.append('dicom_files[]', file);
        });

        // Debug: Mostrar todos los datos que se van a enviar
        console.log('📦 Resumen de datos a enviar:');
        console.log('   - Total archivos DICOM:', dicomFilesArray.length);
        for (var pair of formData.entries()) {
            if (pair[1] instanceof File) {
                console.log('   -', pair[0] + ': FILE -', pair[1].name);
            } else {
                console.log('   -', pair[0] + ':', pair[1]);
            }
        }

        // Mostrar barra de progreso
        $('#uploadProgress').show();
        $('#uploadProgressBar').css('width', '0%');
        $('#uploadProgressText').text('0%');
        $('#uploadStatus').text('Preparando subida...');

        // Enviar con AJAX
        $.ajax({
            url: 'upload_dicom.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $('#uploadProgressBar').css('width', percentComplete + '%');
                        $('#uploadProgressText').text(percentComplete + '%');
                        $('#uploadStatus').text('Subiendo archivos DICOM... ' + percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                console.log('✅ Respuesta del servidor:', response);

                try {
                    var result = typeof response === 'string' ? JSON.parse(response) : response;

                    if (result.success) {
                        $('#uploadStatus').text('¡Archivos subidos exitosamente!');
                        $('#uploadProgressBar').removeClass('active').addClass('progress-bar-success');

                        // Actualizar campos ocultos
                        $('#dicom_folder_path').val(result.folder_path);

                        // Actualizar imgag_id si es nuevo registro
                        if (result.estudio_id && (!imgag_id || imgag_id == 0)) {
                            $('input[name="imgag_id"]').val(result.estudio_id);
                            console.log('✅ imgag_id actualizado a:', result.estudio_id);
                        }

                        uploadCompleted = true;
                        isUploading = false;

                        alert('✅ ' + result.files_count + ' archivos DICOM guardados exitosamente');

                        // Ocultar barra después de 3 segundos
                        setTimeout(function() {
                            $('#uploadProgress').fadeOut();
                        }, 3000);

                        // Recargar si es necesario
                        if (result.redirect) {
                            window.location.href = result.redirect;
                        }
                    } else {
                        var errorMsg = result.message || 'Error desconocido';
                        alert('❌ Error al guardar: ' + errorMsg);

                        // Mostrar debug info si está disponible
                        if (result.debug_info) {
                            console.error('🔍 Debug Info:', result.debug_info);
                        }

                        $('#uploadProgress').hide();
                        isUploading = false;
                    }
                } catch(e) {
                    console.error('❌ Error parseando respuesta:', e);
                    console.error('Respuesta raw:', response);
                    alert('Error en la respuesta del servidor. Revisa la consola.');
                    $('#uploadProgress').hide();
                    isUploading = false;
                }
            },
            error: function(xhr, status, error) {
                console.error('❌ Error en la carga:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);

                alert('❌ Error al subir los archivos: ' + error + '\nRevisa la consola para más detalles.');
                $('#uploadProgress').hide();
                isUploading = false;
            }
        });
    }
    function loadExistingDicomImages() {
        console.log('🔍 Cargando imágenes DICOM existentes...');

        // Buscar imgag_id en múltiples lugares
        var imgag_id = $('#imgag_id').val() ||
            $('input[name="imgag_id"]').val() ||
            $('input[type="hidden"][name*="imgag"]').filter(function() {
                return $(this).val() > 0;
            }).val() || 0;

        console.log('   imgag_id encontrado:', imgag_id);

        // Si no hay imgag_id válido, es un nuevo registro
        if (!imgag_id || imgag_id == '0' || imgag_id == '') {
            console.log('ℹ️ Nuevo registro - no hay DICOM para cargar');
            return;
        }

        // Hacer petición AJAX
        $.ajax({
            url: 'load_dicom_images.php',
            type: 'POST',
            data: {
                imgag_id: imgag_id
            },
            dataType: 'json',
            success: function(result) {
                console.log('📦 Respuesta recibida:', result);

                if (result.success && result.files && result.files.length > 0) {
                    console.log('✅ ' + result.files.length + ' archivos DICOM encontrados');

                    // Marcar como ya cargado
                    uploadCompleted = true;

                    // Actualizar campos ocultos
                    $('#dicom_files_count').val(result.count);
                    $('#dicom_folder_path').val(result.folder_path);

                    // Actualizar campos de base de datos si existen
                    if ($('#imginfo_cantarchivos').length) {
                        $('#imginfo_cantarchivos').val(result.count);
                    }
                    if ($('#imginfo_rutadicom').length) {
                        $('#imginfo_rutadicom').val(result.folder_path);
                    }

                    // Cargar preview
                    loadDicomPreviewFromServer(result.files);

                    // Mostrar mensaje
                    $('#uploadStatus').text('✅ ' + result.count + ' imágenes DICOM cargadas');
                    $('#uploadStatus').css('color', '#5cb85c');
                    $('#uploadStatus').show();

                } else {
                    console.log('ℹ️ No se encontraron archivos DICOM');
                    if (result.message) {
                        console.log('   Mensaje:', result.message);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('❌ Error cargando imágenes:', error);
                console.error('Response:', xhr.responseText);
            }
        });
    }
    function loadDicomPreviewFromServer(files) {
        if (!isInitialized) {
            if (!initializeCornerstone()) {
                console.error('❌ No se pudo inicializar Cornerstone');
                return;
            }
        }

        dicomImages = [];
        currentIndex = 0;

        files.forEach(function(filePath) {
            try {
                // Cornerstone necesita el prefijo wadouri:
                var imageId = 'wadouri:' + filePath;
                dicomImages.push({
                    imageId: imageId,
                    name: filePath.split('/').pop()
                });
            } catch(e) {
                console.error('Error cargando:', filePath, e);
            }
        });

        if (dicomImages.length > 0) {
            document.getElementById('dicomPreview').style.display = 'block';
            showCurrentImage();
            console.log('✅ Preview cargado con', dicomImages.length, 'imágenes');
        }
    }
    function showCurrentImage() {
        if (dicomImages.length === 0) return;

        var element = document.getElementById('currentDicomImage');
        var counter = document.getElementById('imageCounter');

        counter.textContent = 'Imagen ' + (currentIndex + 1) + ' de ' + dicomImages.length;

        var enabled = false;
        try {
            cornerstone.getEnabledElement(element);
            enabled = true;
        } catch(e) {
            enabled = false;
        }

        if (!enabled) {
            try {
                cornerstone.enable(element);
            } catch(e) {
                console.error('Error habilitando elemento:', e);
                return;
            }
        }

        var imageId = dicomImages[currentIndex].imageId;

        cornerstone.loadImage(imageId)
            .then(function(image) {
                currentImage = image;
                cornerstone.displayImage(element, image);

                element.onclick = function() {
                    openModal();
                };
            })
            .catch(function(err) {
                console.error("Error cargando DICOM:", err);
                alert('Error al cargar imagen DICOM: ' + err.message);
            });

        document.getElementById('prevBtn').disabled = (currentIndex === 0);
        document.getElementById('nextBtn').disabled = (currentIndex === dicomImages.length - 1);
    }

    function navigateCarousel(direction) {
        currentIndex += direction;
        if (currentIndex < 0) currentIndex = 0;
        if (currentIndex >= dicomImages.length) currentIndex = dicomImages.length - 1;
        showCurrentImage();
    }

    function openModal() {
        $('#dicomModal').remove();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');

        var backdrop = $('<div class="modal-backdrop fade in"></div>');
        backdrop.css({
            'position': 'fixed',
            'top': '0',
            'right': '0',
            'bottom': '0',
            'left': '0',
            'z-index': '999999',
            'background-color': '#000',
            'opacity': '0.5'
        });

        var modal = $('<div id="dicomModal" class="modal fade in" tabindex="-1" role="dialog"></div>');
        modal.css({
            'position': 'fixed',
            'top': '0',
            'right': '0',
            'bottom': '0',
            'left': '0',
            'z-index': '9999999',
            'overflow': 'auto',
            'display': 'block'
        });

        var modalDialog = $('<div class="modal-dialog modal-lg"></div>');
        modalDialog.css({
            'max-width': '90%',
            'height': '90vh',
            'margin': '30px auto',
            'position': 'relative',
            'z-index': '9999999'
        });

        var modalContent = $('<div class="modal-content"></div>');
        modalContent.css({
            'height': '100%',
            'position': 'relative',
            'z-index': '9999999',
            'background-color': '#fff',
            'border': '1px solid rgba(0,0,0,.2)',
            'border-radius': '6px',
            'box-shadow': '0 5px 15px rgba(0,0,0,.5)'
        });

        var modalHeader = $('<div class="modal-header"></div>');
        modalHeader.html(
            '<button type="button" class="close" onclick="closeDicomModal()" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '<h4 class="modal-title">Visor DICOM - <span id="modalImageName">' + dicomImages[currentIndex].name + '</span></h4>'
        );

        var modalBody = $('<div class="modal-body"></div>');
        modalBody.css({
            'height': 'calc(100% - 120px)',
            'padding': '20px'
        });
        modalBody.html('<div id="modalDicomViewer" style="width:100%; height:100%; border:1px solid #ccc; background:#000;"></div>');

        var modalFooter = $('<div class="modal-footer"></div>');
        modalFooter.html(
            '<div class="btn-group" role="group">' +
            '<button type="button" class="btn btn-info active" id="zoomBtn" onclick="activateTool(\'zoom\')">' +
            '<span class="glyphicon glyphicon-search"></span> Zoom' +
            '</button>' +
            '<button type="button" class="btn btn-info" id="panBtn" onclick="activateTool(\'pan\')">' +
            '<span class="glyphicon glyphicon-move"></span> Mover' +
            '</button>' +
            '<button type="button" class="btn btn-info" id="wwwcBtn" onclick="activateTool(\'wwwc\')">' +
            '<span class="glyphicon glyphicon-adjust"></span> Ventana/Nivel' +
            '</button>' +
            '<button type="button" class="btn btn-warning" onclick="resetViewer()">' +
            '<span class="glyphicon glyphicon-refresh"></span> Restaurar' +
            '</button>' +
            '</div>' +
            '<button type="button" class="btn btn-default" onclick="closeDicomModal()">Cerrar</button>'
        );

        modalContent.append(modalHeader);
        modalContent.append(modalBody);
        modalContent.append(modalFooter);
        modalDialog.append(modalContent);
        modal.append(modalDialog);

        $('body').append(backdrop);
        $('body').append(modal);
        $('body').addClass('modal-open');

        backdrop.on('click', function() {
            closeDicomModal();
        });

        setTimeout(function() {
            modalElement = document.getElementById('modalDicomViewer');

            if (!modalElement) {
                console.error('Elemento modalDicomViewer no encontrado');
                return;
            }

            var enabled = false;
            try {
                cornerstone.getEnabledElement(modalElement);
                enabled = true;
            } catch(e) {
                enabled = false;
            }

            if (!enabled) {
                cornerstone.enable(modalElement);
            }

            cornerstone.loadImage(dicomImages[currentIndex].imageId)
                .then(function(image) {
                    cornerstone.displayImage(modalElement, image);
                    modalViewport = cornerstone.getViewport(modalElement);
                    setupZoomTool();
                })
                .catch(function(err) {
                    console.error("Error cargando imagen en modal:", err);
                    alert('Error al mostrar imagen en modal: ' + err.message);
                });
        }, 400);
    }

    function closeDicomModal() {
        cleanupModalEvents();

        if (modalElement) {
            try {
                cornerstone.disable(modalElement);
            } catch(e) {
                console.error('Error al deshabilitar:', e);
            }
            modalElement = null;
            modalViewport = null;
        }

        $('#dicomModal').remove();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    }

    var currentTool = null;
    var isDragging = false;
    var startPoint = null;

    function cleanupModalEvents() {
        if (!modalElement) return;

        modalElement.onmousedown = null;
        modalElement.onmousemove = null;
        modalElement.onmouseup = null;
        modalElement.onmouseleave = null;

        if (wheelListener) {
            modalElement.removeEventListener('wheel', wheelListener);
            wheelListener = null;
        }
    }

    function activateTool(toolName) {
        if (!modalElement) return;

        currentTool = toolName;

        cleanupModalEvents();

        $('#zoomBtn').removeClass('active');
        $('#panBtn').removeClass('active');
        $('#wwwcBtn').removeClass('active');

        switch(toolName) {
            case 'zoom':
                $('#zoomBtn').addClass('active');
                setupZoomTool();
                break;
            case 'pan':
                $('#panBtn').addClass('active');
                setupPanTool();
                break;
            case 'wwwc':
                $('#wwwcBtn').addClass('active');
                setupWwwcTool();
                break;
        }
    }

    function setupZoomTool() {
        if (!modalElement) return;
        modalElement.style.cursor = 'zoom-in';

        wheelListener = function(e) {
            e.preventDefault();
            var viewport = cornerstone.getViewport(modalElement);
            var delta = e.deltaY < 0 ? 0.15 : -0.15;
            viewport.scale += delta;
            if (viewport.scale < 0.1) viewport.scale = 0.1;
            if (viewport.scale > 10) viewport.scale = 10;
            cornerstone.setViewport(modalElement, viewport);
        };

        modalElement.addEventListener('wheel', wheelListener, { passive: false });

        modalElement.onmousedown = function(e) {
            isDragging = true;
            startPoint = { x: e.clientX, y: e.clientY };
        };

        modalElement.onmousemove = function(e) {
            if (!isDragging) return;
            var viewport = cornerstone.getViewport(modalElement);
            var deltaY = startPoint.y - e.clientY;
            viewport.scale += deltaY * 0.01;
            if (viewport.scale < 0.1) viewport.scale = 0.1;
            if (viewport.scale > 10) viewport.scale = 10;
            cornerstone.setViewport(modalElement, viewport);
            startPoint = { x: e.clientX, y: e.clientY };
        };

        modalElement.onmouseup = function() {
            isDragging = false;
        };

        modalElement.onmouseleave = function() {
            isDragging = false;
        };
    }

    function setupPanTool() {
        if (!modalElement) return;
        modalElement.style.cursor = 'move';

        modalElement.onmousedown = function(e) {
            isDragging = true;
            startPoint = { x: e.clientX, y: e.clientY };
            modalElement.style.cursor = 'grabbing';
        };

        modalElement.onmousemove = function(e) {
            if (!isDragging) return;
            var viewport = cornerstone.getViewport(modalElement);
            var deltaX = e.clientX - startPoint.x;
            var deltaY = e.clientY - startPoint.y;
            viewport.translation.x += deltaX;
            viewport.translation.y += deltaY;
            cornerstone.setViewport(modalElement, viewport);
            startPoint = { x: e.clientX, y: e.clientY };
        };

        modalElement.onmouseup = function() {
            isDragging = false;
            modalElement.style.cursor = 'move';
        };

        modalElement.onmouseleave = function() {
            isDragging = false;
        };
    }

    function setupWwwcTool() {
        if (!modalElement) return;
        modalElement.style.cursor = 'crosshair';

        modalElement.onmousedown = function(e) {
            isDragging = true;
            startPoint = { x: e.clientX, y: e.clientY };
        };

        modalElement.onmousemove = function(e) {
            if (!isDragging) return;
            var viewport = cornerstone.getViewport(modalElement);
            var deltaX = e.clientX - startPoint.x;
            var deltaY = e.clientY - startPoint.y;

            if (!viewport.voi) {
                viewport.voi = { windowWidth: 255, windowCenter: 128 };
            }

            viewport.voi.windowWidth += deltaX * 4;
            viewport.voi.windowCenter += deltaY * 4;

            if (viewport.voi.windowWidth < 1) viewport.voi.windowWidth = 1;

            cornerstone.setViewport(modalElement, viewport);
            startPoint = { x: e.clientX, y: e.clientY };
        };

        modalElement.onmouseup = function() {
            isDragging = false;
        };

        modalElement.onmouseleave = function() {
            isDragging = false;
        };
    }

    function resetViewer() {
        if (!modalElement) return;
        cornerstone.reset(modalElement);
    }
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>