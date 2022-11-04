<?php
	if(is_user_logged_in()){
	    get_header();
	   get_footer(); 
	}else{
	    ?>
	    <script type="text/javascript">
	        window.location.href = "https://concurvas.com/team/wp-admin/";
	    </script>
	    <?php
	}
	 ?>