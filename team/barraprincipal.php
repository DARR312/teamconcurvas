<?php $user_info = wp_get_current_user();
        $user_level = $user_info->user_level;
        $user_caps = $user_info->roles;
        $user_name = $user_info->display_name;
        $user_id = $user_info->ID;
        ?>
<div id="barraMenu" class="pc tablet">
        <div class="accesos" id="usuario" name="<?php echo $user_id ?>">
            <!-- <img src="https://concurvas.com/sistema/homeConcurvas/img/avatar.png" alt="Avatar">
             <?php $user_info = wp_get_current_user();
            $user_level = $user_info->user_level;
            ?>
           <p class="letra27pt-pc letra5pt-mv"><?php echo $user_name ; ?></p>-->
        </div>
        <div class="col-lg-12 col-md-12 col-sm-2 col-xs-2">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="letra18pt-pc letra3pt-mv" id="cerrarsesion">
                    <a id="cerrarsesion2" href="https://concurvas.com/team/wp-login.php?action=logout">Cerrar sesión</a>
                </p>
            </div>
        </div>
       
</div>
<div id="barraCelu" class="celular">
    <figure class="logo_pc"><img src="https://concurvas.com/wp-content/themes/mainteam_Concurvas/imagenes/iconos/LOGO.png" alt="Logo Concurvas"></figure>
    <div class="" id="usuarioCell" name="<?php echo $user_level.",".$user_name.",".$user_id; ?>">
    <div class="" id="usuarioLevel" name="<?php echo $user_level; ?>">
        <!-- <img src="https://concurvas.com/sistema/homeConcurvas/img/avatar.png" alt="Avatar">
        <p class="letra27pt-pc letra5pt-mv"><?php echo $user_name ; ?></p>-->
    </div>
</div>