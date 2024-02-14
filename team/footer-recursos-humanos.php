<?php get_template_part('generalfooter'); ?>   
//<script>
var userlevel = $('#usuarioCell').attr('name');
var permisosj = obtenerDatajson("permiso_id","con_t_rolespermisos","valoresconcondicion","level","'"+userlevel+"'");
var permisos = JSON.parse(permisosj);     
var segundo = $('#segundo');    
var coloresCombinacion = [];
var referenciaParaProyecto = 0;
var horarioDiaActual;
var permisoActual;
const funcionesRH = () => {
    const agregarVistaHorarios = () => { 
        
        $('.horaUpdate').on('click', function() {
            $('#modalHorarios').modal("show"); 
            let diaText = '';
            horarioDiaActual = $(this).attr('name');
            switch (parseInt(horarioDiaActual)) {
            case 1:
                diaText='Lunes';
                break;
            case 2:
                diaText='Martes';
                break;
            case 3:
                diaText='Miercoles';
                break;
            case 4:
                diaText='Jueves';
                break;
            case 5:
                diaText='Viernes';
                break;
            case 6:
                diaText='Sábado';
                break;
            default:
                diaText='Domingo';
                break;
            }
            $('#tituloHorarios').text(`Selecciona hora de entrada y salida para el día ${diaText}`);
            
        }); 
        var horariosSemanaj = obtenerDatajson("dia_semana,hora_inicio,hora_fin","con_t_horarios_empleados","valoresconcondicion","id_empleado",empleadoSelect);
        var horariosSemana = JSON.parse(horariosSemanaj);   
        if(horariosSemana.length == 0 ){return false;}
        for (let i = 0; i < horariosSemana.length; i++) {
            $(`#hEntrada${horariosSemana[i].dia_semana}`).text(`${horariosSemana[i].hora_inicio}`);
            $(`#hSalida${horariosSemana[i].dia_semana}`).text(`${horariosSemana[i].hora_fin}`);
        }
    }

    const agregarVistaPermisos = () => {
        $('.divAusenciasPermisos').remove();
        diaDomingoDiv = $('#diaDomingoDiv');
        html = `<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divAusenciasPermisos'>
                        <button class='botonmodal' type='button' id='verPermisos'>Ver permisos y ausencias</button>
                </div>`;
        var permisosAusenciasj = obtenerDatajson("ID,fecha_hora_inicio,fecha_hora_fin,tipo_permiso,motivo","con_t_permisos_ausencias","valoresconcondicion","id_empleado",empleadoSelect);
        var permisosAusencias = JSON.parse(permisosAusenciasj);   
        if(permisosAusencias.length == 0 ){
            html = `${html} <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Trabajador no tiene ningún permiso o ausencia </p> `;
        }else{
            html = `${html} 
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divAusenciasPermisos' id='titulosdivAusenciasPermisos'>
                        <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc'> Fecha y hora de inicio </p>                    
                        <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc'> Fecha y hora de fin de permiso </p>                    
                        <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc'> Tipo de permiso </p>                    
                        <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc'> Motivo de permiso </p>                    
                    </div>`;
        }

        for (let j = (permisosAusencias.length-1); j >= 0; j--) {
            html = `${html} 
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divAusenciasPermisos' name='${permisosAusencias[j].ID}'>
                        <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc ausenciaUpdate'> ${permisosAusencias[j].fecha_hora_inicio} </p>                    
                        <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc ausenciaUpdate'> ${permisosAusencias[j].fecha_hora_fin} </p>                    
                        <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc ausenciaUpdate'> ${permisosAusencias[j].tipo_permiso} </p>                    
                        <p class='col-lg-3 col-md-3 col-sm-3 col-xs-3 letra18pt-pc ausenciaUpdate'> ${permisosAusencias[j].motivo} </p>                    
                    </div>`;
             
            
        }
        
        diaDomingoDiv.append(html);

        $('#verPermisos').on('click', function() {
            $('#modalPermisos').modal("show"); 
            permisoActual = 0;
        });
        $('.ausenciaUpdate').on('click', function() {
            $('#modalPermisos').modal("show"); 
            permisoActual = $(this).parent().attr('name');
            $('#tituloPermisos').text('Selecciona fecha y hora de inicio y fin de la ausencia, junto con su tipo y motivos para modificar esta ausencia o permiso');
        });
    }
    $('#ingresarAusencia').on('click', function() {
        if(!$('#datetimepicker-ausencia-inicio').val()){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona una hora y fecha de inicio del permiso o ausencia.`); 
            return false;
        }
        if(!$('#datetimepicker-ausencia-fin').val()){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona una hora  y fecha del fin del permiso o ausencia`); 
            return false;
        }
        if(!$('#tipoAusenciaSelect').val()){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona un tipo de ausencia`); 
            return false;
        }

        if($('#datetimepicker-ausencia-inicio').val() > $('#datetimepicker-ausencia-fin').val()){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Revisa la fecha de inicio, ya que esta no puede ser mayor a la fecha del final del permiso o ausencia`); 
            return false;
        }
 	
        
        var objeto = {}; 	 	 	
        objeto.tipo = "int";
        objeto.columna = "id_empleado";
        objeto.valor = empleadoSelect;
        var id_empleado = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "fecha_hora_inicio";
        objeto.valor = `${$('#datetimepicker-ausencia-inicio').val()}:00`;
        var fecha_hora_inicio = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "fecha_hora_fin";
        objeto.valor = `${$('#datetimepicker-ausencia-fin').val()}:00`;
        var fecha_hora_fin = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "tipo_permiso";
        objeto.valor = `${$('#tipoAusenciaSelect').val()}`;
        var tipo_permiso = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "motivo";
        objeto.valor = `${$('#motivoAusencia').val()}`;
        var motivo = prepararjson(objeto);
        
        var permisoId = 0;
        if (permisoActual > 0) {
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = permisoActual;
            var condicion = prepararjson(objeto);
            actualizarregistros("con_t_permisos_ausencias",condicion,id_empleado,fecha_hora_inicio,fecha_hora_fin,tipo_permiso,motivo,"0","0","0","0","0","0");
        } else {
            permisoId = insertarfila("con_t_permisos_ausencias",id_empleado,fecha_hora_inicio,fecha_hora_fin,tipo_permiso,motivo,"0","0","0","0","0","0");
        }

        permisoActual = 0;
        $('#tituloPermisos').text('Selecciona fecha y hora de inicio y fin de la ausencia, junto con su tipo y motivos');

        agregarVistaPermisos();
        $('#modalPermisos').modal("hide");
    });
    const changeEmpleado = () => {
        $('#empleadoSelect').on('change', function() {
            empleadoSelect = $('#empleadoSelect').val();
            if(empleadoSelect == 'seleccona'){return false;}
            $('.divHorariosPordias').remove();
            html = `<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias' id='titulosdivHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Día </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Hora entrada </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Hora salida </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Lunes </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada1' name='1'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida1' name='1'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Martes </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada2' name='2'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida2' name='2'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Miercoles </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada3' name='3'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida3' name='3'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Jueves </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada4' name='4'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida4' name='4'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Viernes </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada5' name='5'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida5' name='5'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Sábado </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada6' name='6'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida6' name='6'> 00:00:00 </p>                    
                    </div>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 divHorariosPordias' id='diaDomingoDiv'>
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc'> Domingo </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hEntrada7' name='7'> 00:00:00 </p>                    
                        <p class='col-lg-4 col-md-4 col-sm-4 col-xs-4 letra18pt-pc horaUpdate' id='hSalida7' name='7'> 00:00:00 </p>                    
                    </div>
                    `;
            let verEmpleadosDiv = $(`#verEmpleadosDiv`);
            verEmpleadosDiv.after(html);       
            agregarVistaHorarios(); 
            agregarVistaPermisos();
        }); 
    }
    //******************************************************************************++Nuevo empleado   
    $('#agregarEmpleado').on('click', function() {
        $('.divHorariosPordias').remove();
        const nuevoEmpleado = $('#nuevoEmpleado');
        nuevoEmpleado.removeClass('oculto').addClass('mostrar');
        const verEmpleadosDiv = $('#verEmpleadosDiv');
        verEmpleadosDiv.removeClass('mostrar').addClass('oculto');
        setTimeout(() => {
            nuevoEmpleado.css('display', 'block');
            verEmpleadosDiv.css('display', 'none');
        }, 1000);
        // Agrego las tipos de empleado a cargoEmpleado
        $(".removerTipos").remove();
        let html = `<option class='removerTipos'  value='selecciona'>Selecciona</option>
                    <option class='removerTipos'  value='nuevo'>Nuevo</option>`;
        let cargoj = obtenerDatajson("ID,nombre_tipo_empleado","con_t_tipoempleados","variasfilasunicas","0","0");
        let cargos = JSON.parse(cargoj);
        for(i=0;i<cargos.length;i++){
            html=html+"<option class='removerTipos' value='"+cargos[i].ID+"'>"+cargos[i].nombre_tipo_empleado+"</option>";
        }
        let cargoEmpleado = $('#cargoEmpleado');
        cargoEmpleado.append(html);
        
    }); 
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
        var idTipoempleado = $('#cargoEmpleado').val();
        
        if(cargoEmpleado == 'selecciona'){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona un cargo para el nuevo empleado.`); 
            return false;
        }
        if(cargoEmpleado == 'nuevo'){
            cargoEmpleado = $('#nuevoCargo').val(); 
            var objeto = {}; 	 	 	
            objeto.tipo = "string";
            objeto.columna = "nombre_tipo_empleado";
            objeto.valor = cargoEmpleado;
            var nombre_tipo_empleado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "numero_empleados";
            objeto.valor = 1;
            var numero_empleados = prepararjson(objeto);
            idTipoempleado = insertarfila("con_t_tipoempleados",nombre_tipo_empleado,numero_empleados,"0","0","0","0","0","0","0","0","0");
        }
        if(!datetimepickerfechacontratacion || !telefono || !correo || !direccion || !identificacion || !tipoId || !datetimepickerfechanacimiento || !cargoEmpleado || !nombreEmpleado){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor rectifica los datos ingresados.`); 
            return false;
        }
        if(cargoEmpleado != 'nuevo'){
            var cantidadEmpleados = obtenerDatajson("numero_empleados","con_t_tipoempleados","valoresconcondicion","ID",idTipoempleado);
            var jsonCantidadEmpleados = JSON.parse(cantidadEmpleados); 
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = idTipoempleado;
            var condicion = prepararjson(objeto);
            var nombre_tipo_empleado = prepararjson(objeto);
            var objeto = {};
            objeto.tipo = "int";
            objeto.columna = "numero_empleados";
            objeto.valor = parseInt(jsonCantidadEmpleados[0].numero_empleados)+1;
            var numero_empleados = prepararjson(objeto);
            actualizarregistros("con_t_tipoempleados",condicion,numero_empleados,"0","0","0","0","0","0","0","0","0","0");
        }
        var objeto = {}; 	 	 	
        objeto.tipo = "string";
        objeto.columna = "nombre_empleado";
        objeto.valor = nombreEmpleado;
        var nombre_empleado = prepararjson(objeto);
        var objeto = {}; 	 	 	
        objeto.tipo = "int";
        objeto.columna = "id_tipo_empleado";
        objeto.valor = idTipoempleado;
        var id_tipo_empleado = prepararjson(objeto);
        var objeto = {};
        objeto.tipo = "date_sinhora";
        objeto.columna = "fecha_nacimiento";
        objeto.valor = datetimepickerfechanacimiento;
        var fecha_nacimiento = prepararjson(objeto);
        var objeto = {}; 	 	 	
        objeto.tipo = "string";
        objeto.columna = "tipo_identificacion";
        objeto.valor = tipoId;
        var tipo_identificacion = prepararjson(objeto);
        var objeto = {}; 	 	 	
        objeto.tipo = "int";
        objeto.columna = "numero_identificacion";
        objeto.valor = identificacion;
        var numero_identificacion = prepararjson(objeto);
        var objeto = {}; 	 	 	
        objeto.tipo = "string";
        objeto.columna = "direccion";
        objeto.valor = direccion;
        var direccion = prepararjson(objeto);
        var objeto = {}; 	 	 	
        objeto.tipo = "string";
        objeto.columna = "telefono";
        objeto.valor = telefono;
        var telefono = prepararjson(objeto);
        var objeto = {}; 	 	 	
        objeto.tipo = "string";
        objeto.columna = "correo_electronico";
        objeto.valor = correo;
        var correo_electronico = prepararjson(objeto);
        var objeto = {}; 	 	 	
        objeto.tipo = "date_sinhora";
        objeto.columna = "fecha_contratacion";
        objeto.valor = datetimepickerfechacontratacion;
        var fecha_contratacion = prepararjson(objeto);
        var objeto = {}; 	 	 	
        objeto.tipo = "int";
        objeto.columna = "salario";
        objeto.valor = 0;
        var salario = prepararjson(objeto);
        // idEmpleado = insertarfila("con_t_empleados",nombre_empleado,id_tipo_empleado,fecha_nacimiento,tipo_identificacion,numero_identificacion,direccion,telefono,correo_electronico,fecha_contratacion,salario,"0");
        idEmpleado = insertarfila("con_t_empleados",nombre_empleado,id_tipo_empleado,fecha_nacimiento,tipo_identificacion,numero_identificacion,direccion,"0",correo_electronico,fecha_contratacion,"0","0");
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
        // Agrego las tipos de empleado a cargoEmpleado
        $(".removerTipos").remove();
        let html = `<option class='removerTipos'  value='selecciona'>Selecciona</option>
                    <option class='removerTipos'  value='nuevo'>Nuevo</option>`;
        let cargoj = obtenerDatajson("ID,nombre_tipo_empleado","con_t_tipoempleados","variasfilasunicas","0","0");
        let cargos = JSON.parse(cargoj);
        for(i=0;i<cargos.length;i++){
            html=html+"<option class='removerTipos' value='"+cargos[i].ID+"'>"+cargos[i].nombre_tipo_empleado+"</option>";
        }
        let cargoEmpleados = $('#cargoEmpleado');
        cargoEmpleados.append(html);
    }); 

    //******************************************************************************++Asignación de horarios 
    $('#verEmpleados').on('click', function() {
        $('.divHorariosPordias').remove();
        const verEmpleadosDiv = $('#verEmpleadosDiv');
        verEmpleadosDiv.removeClass('oculto').addClass('mostrar').css('display', 'block');
        const nuevoEmpleado = $('#nuevoEmpleado');
        nuevoEmpleado.removeClass('mostrar').addClass('oculto');
        setTimeout(() => {
            nuevoEmpleado.css('display', 'none');
            verEmpleadosDiv.css('display', 'block');
        }, 1000);
        // Agrego las empleados a empleadoSelect
        $(".removerempleadoSelect").remove();
        let html = `<option class='removerempleadoSelect'  value='selecciona'>Selecciona</option>`;
        let empleadoj = obtenerDatajson("id_empleado,nombre_empleado","con_t_empleados","variasfilasunicas","0","0");
        let empleados = JSON.parse(empleadoj);
        for(i=0;i<empleados.length;i++){
            html=html+"<option class='removerempleadoSelect' value='"+empleados[i].id_empleado+"'>"+empleados[i].nombre_empleado+"</option>";
        }
        let empleadoSelect = $('#empleadoSelect');
        empleadoSelect.append(html);
        changeEmpleado();
    }); 

    $('#cambiarHorario').on('click', function() {
        var horariosSemanaj = obtenerDatajson("ID,dia_semana,hora_inicio,hora_fin","con_t_horarios_empleados","valoresconcondicion","id_empleado",empleadoSelect);
        var horariosSemana = JSON.parse(horariosSemanaj);   
        var objetosConValor = horariosSemana.filter(function(objeto) {
            return objeto.dia_semana === horarioDiaActual;
        });

        if(!$('#datetimepicker-horariode-salida').val()){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona una hora de salida.`); 
            return false;
        }
        if(!$('#datetimepicker-horariode-entrada').val()){
            $('#modalAlertas').modal("show"); 
            $('#tituloAlertas').text(`Por favor selecciona una hora de entrada.`); 
            return false;
        }

        var objeto = {}; 	 	 	
        objeto.tipo = "int";
        objeto.columna = "id_empleado";
        objeto.valor = empleadoSelect;
        var id_empleado = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "int";
        objeto.columna = "dia_semana";
        objeto.valor = horarioDiaActual;
        var dia_semana = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "hora_inicio";
        objeto.valor = `${$('#datetimepicker-horariode-entrada').val()}:00`;
        var hora_inicio = prepararjson(objeto);

        var objeto = {};
        objeto.tipo = "string";
        objeto.columna = "hora_fin";
        objeto.valor = `${$('#datetimepicker-horariode-salida').val()}:00`;
        var hora_fin = prepararjson(objeto);

        if (objetosConValor.length > 0) {
            console.log(objetosConValor);
            var objeto = {};
            objeto.columna = "ID";
            objeto.valor = objetosConValor[0].ID;
            var condicion = prepararjson(objeto);
            actualizarregistros("con_t_horarios_empleados",condicion,id_empleado,dia_semana,hora_inicio,hora_fin,"0","0","0","0","0","0","0");
        } else {
            idHorarioAgregado = insertarfila("con_t_horarios_empleados",id_empleado,dia_semana,hora_inicio,hora_fin,"0","0","0","0","0","0","0");
        }
        
        agregarVistaHorarios();
        $('#modalHorarios').modal("hide");
        
    }); 
    
}
for(i=0;i<permisos.length;i++){
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
	$('#datetimepicker-horariode-entrada').datetimepicker({
        format: 'HH:mm'
	});
	$('#datetimepicker-horariode-salida').datetimepicker({
        format: 'HH:mm'
	});

    $('#datetimepicker-ausencia-inicio').datetimepicker({
        format: 'YYYY-MM-DD HH:mm'
	});

    $('#datetimepicker-ausencia-fin').datetimepicker({
        format: 'YYYY-MM-DD HH:mm'
	});

</script>
<!-- https://sheetjs.com/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script defer src="<?php echo get_template_directory_uri(); ?>/js/3a-read-array.js"></script>
</body>
</html>