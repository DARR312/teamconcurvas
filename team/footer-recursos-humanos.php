<?php get_template_part('generalfooter'); ?>   
//<script>
var userlevel = $('#usuarioCell').attr('name');
var permisosj = obtenerDatajson("permiso_id","con_t_rolespermisos","valoresconcondicion","level","'"+userlevel+"'");
var permisos = JSON.parse(permisosj);     
var segundo = $('#segundo');    
var coloresCombinacion = [];
var referenciaParaProyecto = 0;

const funcionesRH = () => {
    //******************************************************************************++Nuevo empleado   
    $('#agregarEmpleado').on('click', function() {
        const nuevoEmpleado = $('#nuevoEmpleado');
        nuevoEmpleado.removeClass('oculto').addClass('mostrar');
        setTimeout(() => {
            nuevoEmpleado.removeClass('oculto').addClass('mostrar');
        }, 5000);
        // Agrego las tipos de empleado a cargoEmpleado
        let html = `<option class='remover'  value='selecciona'>Selecciona</option>
                    <option class='remover'  value='nuevo'>Nuevo</option>`;
        let cargoj = obtenerDatajson("ID,nombre_tipo_empleado","con_t_tipoempleados","variasfilasunicas","0","0");
        let cargos = JSON.parse(cargoj);
        for(i=0;i<cargos.length;i++){
            html=html+"<option class='remover' value='"+cargos[i].ID+"'>"+cargos[i].nombre_tipo_empleado+"</option>";
        }
        let cargoEmpleado = $('#cargoEmpleado');
        cargoEmpleado.append(html);
        
    }); guardarNuevoEmpleado
    $('#guardarNuevoEmpleado').on('click', function() {
        var datetimepickerfechacontratacion = $('#datetimepicker-fecha-contratacion').val(); 
        var telefono = $('#telefono').val(); 
        var correo = $('#correo').val(); 
        var direccion = $('#direccion').val(); 
        var identificacion = $('#identificacion').val(); 
        var tipoId = $('#tipoId').val(); 
        var datetimepickerfechanacimiento = $('#datetimepicker-fecha-nacimiento').val(); 
        var cargoEmpleado = $('#cargoEmpleado').val(); 
        var nombreEmpleado = $('#nombreEmpleado').val(); 
        console.log(`datetimepickerfechacontratacion: ${datetimepickerfechacontratacion}
        telefono: ${telefono}
        correo: ${correo}
        direccion: ${direccion}
        identificacion: ${identificacion}
        datetimepickerfechanacimiento: ${datetimepickerfechanacimiento}
        cargoEmpleado: ${cargoEmpleado}
        nombreEmpleado: ${nombreEmpleado}
        `);
        if(cargoEmpleado == 'selecciona'){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona un cargo para el nuevo empleado.`); 
            return false;
        }
        if(cargoEmpleado == 'nuevo'){
            cargoEmpleado = $('#nuevoCargo').val(); 
        }
        if(!datetimepickerfechacontratacion || !telefono || !correo || !direccion || !identificacion || !tipoId || !datetimepickerfechanacimiento || !cargoEmpleado || !nombreEmpleado){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor rectifica los datos ingresados.`); 
            return false;
        }
        const nuevoEmpleado = $('#nuevoEmpleado');
        const empleadoCreadoOk = $('#empleadoCreadoOk');

        nuevoEmpleado.addClass('oculto');
        empleadoCreadoOk.removeClass('oculto').addClass('mostrar');
        setTimeout(() => {
            empleadoCreadoOk.removeClass('mostrar').addClass('oculto');
            nuevoEmpleado.removeClass('oculto').addClass('mostrar');
        }, 5000);
        $('#datetimepicker-fecha-contratacion').val('');
        $('#telefono').val(''); 
        $('#correo').val(''); 
        $('#direccion').val(''); 
        $('#identificacion').val(''); 
        $('#tipoId').val(''); 
        $('#datetimepicker-fecha-nacimiento').val(''); 
        $('#cargoEmpleado').val(''); 
        $('#nombreEmpleado').val(''); 
        $('#nuevoCargo').val('');
    }); 
    
    
    
    
}
for(i=30;i<permisos.length;i++){
    if(permisos[i].permiso_id==48){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion1'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='verEmpleados'>Ver Empleados </button></div>");
    }
    if(permisos[i].permiso_id==49){
        var segundo = $('#segundo');
        segundo.append("<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12' id='accion2'><button class='botonmodal botonesMenuPaginaIndividual' type='button' id='agregarEmpleado'>Agregar nuevo Empleado </button></div>");
    }   
    
    
}
funcionesRH();
})
</script>

<!-- Propeller textfield js --> 
<script type="text/javascript" src="https://opensource.propeller.in/components/textfield/js/textfield.js"></script>

<!-- Datepicker moment with locales -->
<script type="text/javascript" language="javascript" src="https://opensource.propeller.in/components/datetimepicker/js/moment-with-locales.js"></script>

<!-- Propeller Bootstrap datetimepicker -->
<script type="text/javascript" language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datetimepicker.js"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
    // Default date and time picker
	$('#datetimepicker-fecha-nacimiento').datetimepicker({
        format: 'MM/DD/YYYY'
	});
	$('#datetimepicker-fecha-contratacion').datetimepicker({
        format: 'MM/DD/YYYY'
	});
</script>
<!-- https://sheetjs.com/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script defer src="<?php echo get_template_directory_uri(); ?>/js/3a-read-array.js"></script>
</body>
</html>