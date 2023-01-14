<?php get_template_part('generalfooter'); ?>
    //<script>
    $('#cajamadrugon').on('click', function(){  
        var fecha = $("#datetimepicker-madrugon").val();
        alert(fecha);
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
        
    });   
})
</script>
<!-- Propeller textfield js --> 
<script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>

<!-- Datepicker moment with locales -->
<script type="text/javascript" language="javascript" src="https://opensource.propeller.in/components/datetimepicker/js/moment-with-locales.js"></script>

<!-- Propeller Bootstrap datetimepicker -->
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datetimepicker.js"></script>

<script>
	// Default date and time picker
	$('#datetimepicker-madrugon').datetimepicker({
		format: 'L'
	});
</script>
</body>
</html>