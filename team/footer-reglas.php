<?php get_template_part('generalfooter'); ?>
    //<script>
    var segundo = $('#segundo');
    segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal' type='button' id='reglaNueva'>+ Agregar regla nueva </button></div>");
    impresionreglas();
    $('#close').on('click', function(){         
        $('#popup').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');      
        $('.reinicia').remove(); 
        $('.regla').remove(); 
        $('.reiniciaregla').css('display', 'none');
        return false;     
    });
    $('#reglaNueva').on('click', function(){     
        $('#popup').fadeIn('slow'); 
       $('.popup-overlay').fadeIn('slow');   
       $('.popup-overlay').height($(window).height()); 
       $('.reiniciarreglas').remove();
       $('#por_numero').css('display', 'block');
        var html = "";
        var tipos_de_reglas = obtenerDatajson("ID,nombre,descripcion","con_t_tipodereglas","variasfilasunicas","0","0");
        var tipos_de_reglasJSON = JSON.parse(tipos_de_reglas);
        for(i=0;i<tipos_de_reglasJSON.length;i++){
            html=html+"<option value='"+tipos_de_reglasJSON[i].descripcion+"' name='"+tipos_de_reglasJSON[i].ID+"' class='reiniciarreglas'>"+tipos_de_reglasJSON[i].nombre+"</option>";
        }
        var tipor = $('#tipor');
        tipor.append(html);
        $('#descripcionregla').text(tipos_de_reglasJSON[0].descripcion);
        return false;     
    }); 
    $('#agregarReglaNueva').on('click', function(){     
        var tipo = $('#tipor option:selected').attr("name");
        console.log(tipo);        
        var nombre_reglas = $("#nombre_regla").val()
        if(!nombre_reglas){
            alert("¿Cómo se va a llamar tu nueva regla? 0.o");
            return false;
        }
        var descripcion_reglas = $("#descripcion_regla").val()
        if(!descripcion_reglas){
            alert("Describe la nueva regla ;)");
            return false;
        }
        var nombre_regla = nombre_reglas.replaceAll("%","por ciento"); 
        var descripcion_regla = descripcion_reglas.replaceAll("%","por ciento"); 
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "nombre_regla";
        objeto.valor = nombre_regla;
        nombre_regla = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "descripcion";
        objeto.valor = descripcion_regla;
        descripcion = prepararjson(objeto);
        if(tipo == 1){
            var prendas_condicion = $("#prendas_condicion").val()
            if(!prendas_condicion){
                alert("Por favor agrega un número de prendas para la condición :)");
                return false;
            }            
            var porcentaje_descuento = $("#porcentaje_descuento").val()
            if(!porcentaje_descuento){
                alert("Por favor agrega un porcentaje de descuento :)");
                return false;
            }           
            var prendas_descuento = $("#prendas_descuento").val()
            if(!prendas_descuento){
                alert("Por favor agrega un número de prendas que aplicarían al descuento :)");
                return false;
            }
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "tipo_regla";
            objeto.valor = tipo;
            var tipo_regla = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "prendas_condicion";
            objeto.valor = prendas_condicion;
            var prendas_condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "prendas_descuento";
            objeto.valor = prendas_descuento;
            var prendas_descuento = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "referencias";
            objeto.valor = "-";
            var referencias = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "porcentaje_descuento";
            objeto.valor = porcentaje_descuento;
            var porcentaje_descuento = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "regla_activa";
            objeto.valor = 0;
            var regla_activa = prepararjson(objeto);
            var idregla = insertarfila("con_t_reglasdescuentos",nombre_regla,descripcion,tipo_regla,prendas_condicion,prendas_descuento,referencias,porcentaje_descuento,regla_activa,"0","0","0");
            console.log(idregla);
            $('#popup').fadeOut('slow');         
            $('.popup-overlay').fadeOut('slow');      
            $('.reinicia').remove(); 
            $('.regla').remove(); 
            $('.reiniciaregla').css('display', 'none');
            $(".removiendoreglas").remove();
            impresionreglas();
        }
        if(tipo == 2){
            var todas_porcentaje = $("#todas_porcentaje").val()
            if(!todas_porcentaje){
                alert("Por favor agrega un porcentaje de descuento :)");
                return false;
            }
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "tipo_regla";
            objeto.valor = tipo;
            var tipo_regla = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "prendas_condicion";
            objeto.valor = 0;
            var prendas_condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "prendas_descuento";
            objeto.valor = 0;
            var prendas_descuento = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "string";
            objeto.columna = "referencias";
            objeto.valor = "-";
            var referencias = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "porcentaje_descuento";
            objeto.valor = todas_porcentaje;
            var todas_porcentaje = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "regla_activa";
            objeto.valor = 0;
            var regla_activa = prepararjson(objeto);
            var idregla = insertarfila("con_t_reglasdescuentos",nombre_regla,descripcion,tipo_regla,prendas_condicion,prendas_descuento,referencias,todas_porcentaje,regla_activa,"0","0","0");
            console.log(idregla);
            $('#popup').fadeOut('slow');         
            $('.popup-overlay').fadeOut('slow');      
            $('.reinicia').remove(); 
            $('.regla').remove(); 
            $('.reiniciaregla').css('display', 'none');
            $(".removiendoreglas").remove();
            impresionreglas();
        }
        if(tipo == 3){
            var cantidadSelect = $("#referencia select");
            var objetoReferencias = [];
            var regla_activa = prepararjson(objeto);
            for (let i = 0; i < cantidadSelect.length; i++) {
                if(cantidadSelect[i].value == "NA"){continue;}
                objetoReferencias.push(cantidadSelect[i].value);
            }
            if(objetoReferencias.length == 0){
                alert("Ingresa al menos una referefencia a la regla");
                return false;
            }   
            const jsonString = JSON.stringify(Object.assign({}, objetoReferencias));
            console.log(jsonString); 
            var referencias = prepararjson(jsonString);     
            console.log(referencias);  
            var referencia_porcentaje = $("#referencia_porcentaje").val()
            if(!referencia_porcentaje){
                alert("Por favor agrega un porcentaje de descuento :)");
                return false;
            }
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "tipo_regla";
            objeto.valor = tipo;
            var tipo_regla = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "prendas_condicion";
            objeto.valor = 0;
            var prendas_condicion = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "prendas_descuento";
            objeto.valor = 0;
            var prendas_descuento = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "json";
            objeto.columna = "referencias";
            objeto.valor = objetoReferencias;
            console.log(objeto);
            var stringJson1=JSON.stringify(objeto);
            console.log(stringJson1);
            var stringJson2 = stringJson1.replaceAll("{","<"); 
            var referenciias = stringJson2.replaceAll("}",">");
            console.log(referenciias);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "porcentaje_descuento";
            objeto.valor = referencia_porcentaje;
            var referencia_porcentaje = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "regla_activa";
            objeto.valor = 0;
            var regla_activa = prepararjson(objeto);
            var idregla = insertarfila("con_t_reglasdescuentos",nombre_regla,descripcion,tipo_regla,prendas_condicion,prendas_descuento,referenciias,referencia_porcentaje,regla_activa,"0","0","0");
            console.log(idregla);
            $('#popup').fadeOut('slow');         
            $('.popup-overlay').fadeOut('slow');      
            $('.reinicia').remove(); 
            $('.regla').remove(); 
            $('.reiniciaregla').css('display', 'none');
            $(".removiendoreglas").remove();
            impresionreglas();
        }
        
        return false;     
    });  
})
</script>
<script>
function seleccionTiporegla() {
        var valor = $('#tipor').val();
        $('#descripcionregla').text(valor);
        var id = $('#tipor option:selected').attr("name");
        console.log(id);
        $('.reiniciaregla').css('display', 'none');
        if(id==1){$('#por_numero').css('display', 'block');}
        if(id==2){$('#todas').css('display', 'block');}
        if(id==3){$('#referencia').css('display', 'block');}
        var referencias = obtenerDatajson("nombre","con_t_resumen","filasunicas","0","0");
        var referenciasJSON = JSON.parse(referencias);
        var html = "<option value='NA' class='reiniciarreglas'>NA</option>";
        console.log(referenciasJSON);
        for(i=0;i<referenciasJSON.length;i++){
            html=html+"<option value='"+referenciasJSON[i].nombre+"' class='reiniciarreglas'>"+referenciasJSON[i].nombre+"</option>";
        }
        var referenciaselect = $('.referenciaselect');
        referenciaselect.append(html);
    }
    function seleccionRefere(id) {    
        var idnueva = parseInt(id) + 1;  
        var html = "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 reiniciarreglas' id='refere"+idnueva+"'><div class='form-group pmd-textfield pmd-textfield-floating-label'><label class='control-label letra18pt-pc' for='referencias'>Referencias</label><select class='form-control letra18pt-pc referenciaselect' type='select' id='referencias"+idnueva+"' name='referencias' form='referencias' onchange='seleccionRefere("+idnueva+")'>";
        var referencias = obtenerDatajson("nombre","con_t_resumen","filasunicas","0","0");
        var referenciasJSON = JSON.parse(referencias);
        console.log(referenciasJSON);
        html=html+"<option value='NA' >NA</option>";
        for(i=0;i<referenciasJSON.length;i++){
            html=html+"<option value='"+referenciasJSON[i].nombre+"' class='reiniciarreglas'>"+referenciasJSON[i].nombre+"</option>";
        }
        html = html+"</select><span class='pmd-textfield-focused'></span></div></div>";
        $("#refere"+id).after(html);
        return false;  
    }
    
    function impresionreglas() {  
        var reglas_totales = obtenerDatajson("ID,descripcion,prendas_condicion,prendas_descuento,referencias,porcentaje_descuento,regla_activa","con_t_reglasdescuentos","variasfilasunicas","0","0");
        var reglas_totalesJSON = JSON.parse(reglas_totales);
        console.log(reglas_totalesJSON);
        var claseactiva = "activa";  
        var textoactiva = "Desactivar";  
        if(reglas_totalesJSON[0].regla_activa == 0){claseactiva = "desactiva";textoactiva = "Activar";    }
        var html = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removiendoreglas' id='primeraregla'><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno'>"+reglas_totalesJSON[0].descripcion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+reglas_totalesJSON[0].prendas_condicion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+reglas_totalesJSON[0].prendas_descuento+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+reglas_totalesJSON[0].porcentaje_descuento+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><button class='botonmodal letra18pt-pc "+claseactiva+"' type='button' id='"+reglas_totalesJSON[0].ID+"' onclick=\"activarRegla("+reglas_totalesJSON[0].ID+",\'"+claseactiva+"\')\">"+textoactiva+"</button></div></div>";
        for(i=1;i<reglas_totalesJSON.length;i++){
            var claseactiva = "activa";  
            var textoactiva = "Desactivar";  
            if(reglas_totalesJSON[i].regla_activa == 0){claseactiva = "desactiva";textoactiva = "Activar";    }
            html=html+"<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 removiendoreglas'><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><p class='letra18pt-pc negrillaUno'>"+reglas_totalesJSON[i].descripcion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+reglas_totalesJSON[i].prendas_condicion+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+reglas_totalesJSON[i].prendas_descuento+"</p></div><div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><p class='letra18pt-pc negrillaUno'>"+reglas_totalesJSON[i].porcentaje_descuento+"</p></div><div class='col-lg-3 col-md-3 col-sm-3 col-xs-3'><button class='botonmodal letra18pt-pc "+claseactiva+"' type='button' id='"+reglas_totalesJSON[i].ID+"' onclick=\"activarRegla("+reglas_totalesJSON[i].ID+",\'"+claseactiva+"\')\">"+textoactiva+"</button></div></div>";
        }
        console.log(html);
        $("#primeraFila").after(html);
        return false;  
    }

    function activarRegla(id,claseactiva) {
        console.log(id); 
        var objeto = {};
        objeto.columna = "ID";
        objeto.valor = id;
        var condicion = prepararjson(objeto);
        var regla_activa = "";
        if(claseactiva == "activa"){
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "regla_activa";
            objeto.valor = 0;
            regla_activa = prepararjson(objeto);
        }else{
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "regla_activa";
            objeto.valor = 1;
            regla_activa = prepararjson(objeto);
        }        
        actualizarregistros("con_t_reglasdescuentos",condicion,regla_activa,"0","0","0","0","0","0","0","0","0","0");
        $(".removiendoreglas").remove();
        impresionreglas();
     }
</script>
<!-- Propeller textfield js --> 
<script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>

<!-- Datepicker moment with locales -->
<script type="text/javascript" language="javascript" src="https://opensource.propeller.in/components/datetimepicker/js/moment-with-locales.js"></script>

<!-- Propeller Bootstrap datetimepicker -->
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datetimepicker.js"></script>

<script>
	// Default date and time picker
	$('#datetimepicker-default').datetimepicker({
		format: 'L'
	});
	$('#datetimepicker-defaultFiltro').datetimepicker({
		format: 'L'
	});
	$('#datetimepicker-update').datetimepicker({
		format: 'L'
	});
</script>
</body>
</html>