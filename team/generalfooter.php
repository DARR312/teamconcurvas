<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/principal.js" async></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/form.js" async></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scanner.js"></script>
<?php if(get_the_title() == "Ventas"){ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/ventas.js"></script>
<?php } ?>
<?php if(get_the_title() == "Cambios"){ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/cambios.js"></script>
<?php } ?>
<?php if(get_the_title() == "Inventario"){ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/inventario.js"></script>
<?php } ?>
<?php if(get_the_title() == "Ventas plaza"){ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/ventas-mayorista.js"></script>
<?php } ?>
<script>
$(window).load(function(){
   var permisos = permisosPrincipales();//principal.js
   var items = permisos.split(',');
   //alert(items.length);
   var html = ""; 
   for(i=1;i<items.length;i++){
       if(items[i]==1){
           //html =html+ "<a href='https://concurvas.com/team/usuarios'><div class='accesos'><img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/usuarios.png' alt='Avatar'></div></a>";
       }if(items[i]==2){
           //html =html+ " <a href='https://concurvas.com/team/clientes'><div class='accesos' > <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/clientes.png' alt='Avatar'></div></a>";
       }if(items[i]==3){
           html =html+ " <a href='https://concurvas.com/team/ventas'><div class='accesos' > <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/ventas.png' alt='Avatar'></div></a>";
           html =html+ " <a href='https://concurvas.com/team/cambios'><div class='accesos' > <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/cambios.png' alt='Avatar'></div></a>";
       }if(items[i]==4){
           html =html+ " <a href='https://concurvas.com/team/inventario'><div class='accesos' > <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/inventario.png' alt='Avatar'></div></a>";
       }if(items[i]==37){
           //html =html+ " <a href='https://concurvas.com/team/ventas-plaza'><div class='accesos' > <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/ventas.png' alt='Avatar'></div></a>";
       }if(items[i]==38){
           //html =html+ " <a href='https://concurvas.com/team/ventas-mayorista'><div class='accesos' > <img src='<?php echo get_template_directory_uri(); ?>/imagenes/iconos/ventas.png' alt='Avatar'></div></a>";
       }
   }
    var usuario = $('#usuario');
    var barraCelu = $('#barraCelu');
    usuario.after(html);
    barraCelu.append(html);