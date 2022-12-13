<?php
	if(is_user_logged_in()){
	    get_header("caja-digital");
?>
<?php
	   get_footer("caja-digital"); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
?>