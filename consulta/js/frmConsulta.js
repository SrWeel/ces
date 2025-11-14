	$(document).ready(function(){
            
			$(".cls-g-map").load("imagenes/ecuador-svg-catt.svg", null, function(result){
                //alert(result);
                $(this).find(".cls-ecuador").attr("data-info","ECU");
                $(this).find(".cls-ecuador").css("cursor","pointer");
                //$(this).find(".cls-ecuador").find("#path3478").css("display","none");
                
               /* $(this).find(".cls-ecuador").find("path").on("mouseover", function(){                    
                    $(this).attr("fill","#70A8D2");
                });*/
                /*$(this).find(".cls-ecuador").find("text").on("mouseover", function(){                    
                    $(this).parent().find("path[data-union-label='"+$(this).attr("data-union-label")+"']").css("fill","#08B81C");
                });*/
                
             /*   $(this).find(".cls-ecuador").find("path").on("mouseout", function(){
                    if(!$(this).data("clicked")){
                        $(this).attr("fill","#87B6D9");
                    }
                });*/
                /*$(this).find(".cls-ecuador").find("text").on("mouseout", function(){                    
                    $(this).parent().find("path[data-union-label='"+$(this).attr("data-union-label")+"']").css("fill","#E6E6E6");
                });*/
                
                $(this).find(".cls-ecuador").find("path").on("click", function(){
                    //hidden_regions($(this),$(this).parent());
                    $(this).parent().find("path").data("clicked",false);
                    //$(this).parent().find("path").attr("fill","#87B6D9");
                    $(this).data("clicked",true);
                   // $(this).attr("fill","#70A8D2");
                    ui_busqueda_info({pCodProv:$(this).attr("data-code-prov"),pNombProv:$(this).attr("data-union-label")});
                });
                
            });
            
			
			
			
	});

	//Global
    function ui_mapa(){
            $(".cls-main-form-consulta").aqDialog({Function:"",Title:"Consejo de la Judicatura - Consulta de Catastro - Dependencias Judiciales",
                    File:"../frmConsulta/frmConsulta-map.php",
                    Width:950,
                    Height:630,
                    Resizable:false,
                    onLoadFinish:function($dialog_result){
                        $(".cls-g-map").data("dialog-map-id",$dialog_result);
                    }
            });
     }
        
        
	function frmConsultaget_data_grid($selr){
            if(typeof($selr)=="undefined" || $selr==null || $selr==""){
                    $selr = $("#grid_frmConsultaGrid").jqGrid("getGridParam","selrow");
            }

            var $rows= $("#grid_frmConsultaGrid").jqGrid('getRowData');
            var $row;
            var $xRef;
            var $rowDataGrid = null;
                var $i=0;

            for($i=0;$i<$rows.length;$i++){
                $row=$rows[$i];
                $xRef=$row["codigo_sis"]; //Este campo debe ser dinamico, no estatico id_sis
                if($xRef==$selr){
                    $rowDataGrid = $row;
                    break;
                }
            }
            return $rowDataGrid;
	}

	function frmConsultaGridput_row_data_grid_in_form($selr){
            $data = frmConsultaget_data_grid($selr);
	    $x=null;
            
            $(".cls-info-dep-mat").load("getMateriaPorDep.php",{pDep:$data["codigo_sis"]});
            $(".cls-info-dep-resol").load("getResolPorDep.php",{pDep:$data["codigo_sis"]});
	    //alert($data["codigo_sis"]);
	}
	
	function ui_busqueda_info($datos){
            $(".cls-main-form-consulta").aqDialog({Function:"",Title:"Filtro",
                File:"panel_consulta.php",
                Params:{pCodProv:$datos["pCodProv"],pNombProv:$datos["pNombProv"]},
                Width:990,
                Height:580,
                Resizable:false,
                onLoadFinish:function(){
                    get_materias();
                },
                Buttons:{
                    
                    "Cancelar":function(){
                        $(this).dialog("close");
                    }
                }
            });
        }