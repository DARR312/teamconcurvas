<?php get_template_part('generalfooter'); ?>
})
//<script>
	
$('#bscar').on('change',function(){
	$('.removersatelite').remove();
	var enviar = "funcion=consultarsatelite&valor="+$('#bscar').val();
    var html = "no";
    $.ajax({
    	url: urlhost,
    	headers: {'Access-Control-Allow-Origin': urlhost},
    	type: "GET",
    	async: false,
    	data: enviar,
    	success: function(data){
    		html = data;
    	}						
    });
	$('#barrasuperior').after(html);
	satelites();
});
function satelites(){
	
	$('.cantidad').on('change',function(){
		if($(this).val() == $(this).attr("name")){
			$(this).css('background', '#00ff0075');
			var ok ="#ok"+this.id; 
			$(ok).attr("name","ok");
			return false;
		}
		$(this).css('background', '#ff5a5a75');
		var ok ="#ok"+this.id; 
		$(ok).attr("name","no");
	});

	$('#confirmarsatelite').on('click',function(){
		var referencias = $("#bloquesatelite p");
		for (let i = 0; i < referencias.length; i++) {
			console.log(referencias[i].attributes[2]);
			console.log(referencias[i]);
			if(referencias[i].attributes[2].nodeValue == 'ok'){continue;}	
			return false;		//const ook = array[i];				
		}
		alert('function call actualizarfechas '+$('#bscar').val());
		actualizar("actualizar_satelite",$('#bscar').val(),0,0,"-");//	
	});

};
</script>
<!-------------------Calendario---------------->
<link rel="stylesheet" href="http://localhost/wordpress/wp-content/themes/teamconcurvas/team/css/calendar.css" async>
	<!-------------------Calendario---------------->
</body>
</html>