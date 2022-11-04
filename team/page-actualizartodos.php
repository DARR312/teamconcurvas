<style type="text/css">
    #barraMenu{display: none;}
    #barrasuperior{display: none;}
    .funcionamiento{margin-top:10px !important;}
</style>
<?php
function is_admin_user() {
    return current_user_can( 'manage_options' );
}
	if(is_user_logged_in()){
	    
	    get_header("inventario");
?>
<div id="informeDine"  class="funcionamiento" style='display: none;'>
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='cargarormeDinero'>
        <input type="file" id="demo" accept=".xls,.xlsx" class='col-lg-6 col-md-6 col-sm-6 col-xs-12'/>
    </div>
</div>
<div id="informeDiro"  class="funcionamiento" style='display: none;'>
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='cargarInformeDro'>
        <input type="file" id="dinero" accept=".xls,.xlsx" class='col-lg-6 col-md-6 col-sm-6 col-xs-12'/>
    </div>
</div>
<div id="informeDinero"  class="funcionamiento">
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='cargarInformeDinero'>
        <input type="file" id="todosinforme" accept=".xls,.xlsx" class='col-lg-6 col-md-6 col-sm-6 col-xs-12'/>
        <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12'>
            <button class='botonmodal botonesInventario' type='button' id='cargarInformeBb'  onclick="funcioncargartodo()">>Cargar informe</button>
        </div>
    </div>
</div>
<script type="text/javascript">
        function funcioncargartodo() {
            var cantidadInfo = $("#informeD p").length;
            var usuarioCell = $('#usuarioCell').attr("name");
            console.log(cantidadInfo);
            var j=0;
            for (let i = 1; i < cantidadInfo; i++) {
                var id = $("#informeD p:eq("+i+")").text();
                if(id[0]=="C" || id[0]=="c"){
                    actualizar("cambio_estado","Entregado",id.slice(1),usuarioCell,"-");
                    actualizar("cambioitem_estado_idcambio",id.slice(1),'Entregado',0,"-");
                    actualizar("estado_prenda",id,'Entregado','cual',"-");
                    j++;
                }  
                if(id[0]=="V" || id[0]=="v"){
                    actualizar("venta_estado","Entregado",id.slice(1),usuarioCell,"-");
                    actualizar("ventaitem_estado_idcambio",id.slice(1),'Entregado',0,"-");
                    actualizar("estado_prenda",id,'Entregado','cual',"-");
                    j++;
                }  
                if(id[0]=="K" || id[0]=="k"){
                    actualizar("estado_prenda",id,'Entregado','cual',"-");
                    j++;
                }     
                if(id[0]=="P" || id[0]=="p"){
                    actualizar("estado_prenda",id,'Entregado','cual',"-");
                    j++;
                }                              
                console.log(i-j); 
                console.log(j); 
            }
                     
            console.log(j); 
         }
    </script>
<?php
    get_footer("inventario"); 
    }else{
    ?>
    <script type="text/javascript">
        window.location.href = "https://concurvas.com/team/wp-admin/";
    </script>
<?php
}
?>
