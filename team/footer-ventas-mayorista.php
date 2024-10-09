<?php get_template_part('generalfooter'); ?>
    //<script>
    var html = "";
    var permisoVentas = permisosVentas();
    var items = permisoVentas.split(',');
    var pedidoUpdate = "";
    var usuarioUpdate = "";
    var notasUpdate = "";
    var verPedidos = 0;
    var botonrevisar ="";
    var segundo = $('#segundo');
    var confirmarvalor = "";
    for(var k = (items.length-1); k>0;k--){
        if(items[k]==5){
            segundo.append("<div class='col-lg-2 col-md-2 col-sm-2 col-xs-12' id='accion'><button class='botonmodal' type='button' id='agregarVenta'>+ Agregar venta </button></div>");
            botonrevisar = "botonrevisar";
        }
        if(items[k]==6){
            pedidoUpdate = "pedidoUpdate"; 
        }
        if(items[k]==7){
            notasUpdate = "notasUpdate";
        }
        if(items[k]==26){
            usuarioUpdate = "usuarioUpdate"; 
        }
        if(items[k]==27){
            confirmarvalor = "confirmarvalor"; 
        }
        if(items[k]==9){
           verPedidos = 1;
        }
    }
    $("#popup").attr("name",confirmarvalor);
    var ventasmayoristas = obtenerDatajson("*","con_t_mayorista","variasfilasunicas","0","0");
    var jsonVenta = JSON.parse(ventasmayoristas); 
    console.log(jsonVenta);
    var html = imprimirVentasMayoristajson(jsonVenta);
    var primeraFila = $('#primeraFila');
    primeraFila.after(html);
    mayoristafunciones();
    
    // /*************************** Enviar para venta (CELULAR) *******************************/
    // $('#empezarEscaner').on('click', function() {
    //     $('#escaneados').css('display', 'block');
    //     $('#inicialEscaner').css('display', 'block');
    //     $('#escanerInvInicial').css('display', 'block');
    //     $('#botonesEscaner').css('display', 'none');
    //     var html5QrcodeScanner = new Html5QrcodeScanner(
    // 	"inicialReader", { fps: 10, qrbox: 250 });
    //     html5QrcodeScanner.render(enviarVentamayorista);//principal.js
    // });
    // $('#enviarParaventa').on('click', function() {
    //     var prendasCantidad = ($('#escaneados p').length);
    //     var pr = "";
    //     for(var i = 0;i<prendasCantidad;i++){
    //         var prenda = $("#escaneados p:eq("+i+")").text();
    //         pr = pr+prenda+"°";
    //     }//C1145RB4D13S64°C1145RB7D13S64°
    //     enviarparaventamayorista(pr);
    //     $('.remover').remove();
    // });           
})
</script>
<script>
function seleccionCliente(id) {
        $('#nombreVenta').val($('#nombre'+id).text());
        $('#dirVenta').val($('#direccion'+id).text());
        $('#telVenta').val($('#tele').val());
        $('#idCliente').val($('#clienteid'+id).text());
        $('#complementoCliente').val($('#complemento'+id).text());
        $('#ciudadCliente').val($('#clienteCiudad'+id).text());
        $('#popup3').fadeOut('slow');      
        $('#popup').fadeIn('slow');
        $('.cliente').remove();
        $('.remover').remove();
        return false;  
    }
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