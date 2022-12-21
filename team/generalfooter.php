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
<?php if(get_the_title() == "Ventas mayorista"){ ?>
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
           html =html+ "<div class='col-lg-12 col-md-12 col-sm-2 col-xs-2 pc'>"+
                    "<div class='iconosprincipales col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                        "<a id='linkprincipales' href='https://concurvas.com/team/ventas'>"+
                                "<p class='letra18pt-pc letra3pt-mv nombresiconos'>Digital</p>"+
                        "</a></div></div>";
           html =html+ "<div class='col-lg-12 col-md-12 col-sm-2 col-xs-2 pc'>"+
                    "<div class='iconosprincipales col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                        "<a id='linkprincipales' href='https://concurvas.com/team/cambios'>"+
                                "<p class='letra18pt-pc letra3pt-mv nombresiconos'>Cambios</p>"+
                        "</a></div></div>";
       }if(items[i]==4){
           html =html+ "<div class='col-lg-12 col-md-12 col-sm-2 col-xs-2'>"+
                    "<div class='iconosprincipales col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                        "<a id='linkprincipales' href='https://concurvas.com/team/inventario'>"+
                                "<p class='letra18pt-pc letra3pt-mv nombresiconos'>Inventario</p>"+
                        "</a></div></div>";
       }if(items[i]==37){
           html =html+ "<div class='col-lg-12 col-md-12 col-sm-2 col-xs-2'>"+
                    "<div class='iconosprincipales col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                        "<a id='linkprincipales' href='https://concurvas.com/team/ventas-plaza'>"+
                                "<p class='letra18pt-pc letra3pt-mv nombresiconos'>Plaza</p>"+
                        "</a></div></div>";
       }if(items[i]==38){
           html =html+ "<div class='col-lg-12 col-md-12 col-sm-2 col-xs-2'>"+
                    "<div class='iconosprincipales col-lg-6 col-md-6 col-sm-6 col-xs-6'>"+
                        "<a id='linkprincipales' href='https://concurvas.com/team/ventas-mayorista'>"+
                                "<p class='letra18pt-pc letra3pt-mv nombresiconos'>Mayorista</p>"+
                        "</a></div></div>";
       }
   }
    var usuario = $('#usuario');
    var barraCelu = $('#barraCelu');
    usuario.after(html);
    barraCelu.append(html);