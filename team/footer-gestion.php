<?php get_template_part('generalfooter'); ?>
    //<script>
    $('#cajamadrugon').on('click', function(){  
        var fecha_insert = $("#datetimepicker-madrugon").val();
        if(!fecha_insert){alert("Ingresa una fecha para la nueva caja de madrugón");return false;}
        alert("Se inserto el madrugón con fecha: "+fecha_insert);
        var objeto = {};
        objeto.tipo = "date_sinhora";
        objeto.columna = "fecha";
        objeto.valor = fecha_insert;
        var fecha = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_mercancia";
        objeto.valor = 0;
        var valor_mercancia = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_dinero";
        objeto.valor = 0;
        var valor_dinero = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "valor_cambios";
        objeto.valor = 0;
        var valor_cambios = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "madrugon_ok";
        objeto.valor = "No";
        var madrugon_ok = prepararjson(objeto);
        var idmadrugon = insertarfila("con_t_madrugon",fecha,valor_mercancia,valor_dinero,valor_cambios,madrugon_ok,"0","0","0","0","0","0");
    });   
})
</script>
<!-- Propeller textfield js --> 
<script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>

<!-- Datepicker moment with locales -->
<!-- <script type="text/javascript" language="javascript" src="https://opensource.propeller.in/components/datetimepicker/js/moment-with-locales.js"></script> -->

<!-- Cargar Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


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