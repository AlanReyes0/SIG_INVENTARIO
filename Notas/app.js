$(function() {
	
	load(1);
	
		
		
		
   
 
   
})
 
 
function load(page){
			var q= "";
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'notas_ajax.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('Cargando...');
			  },
				success:function(data){
					$(".tab-content").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
		
		
 function eliminar_nota(id) {
		if (confirm('Realmente deseas eliminar esta nota?')){
			page=1;
			var q= "";
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'notas_ajax.php?action=ajax&page='+page+'&q='+q+'&delete='+id,
				 beforeSend: function(objeto){
				 $('#loader').html('Cargando...');
			  },
				success:function(data){
					$(".tab-content").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
			
		}
       
    }
	
	$('#add-notes').on('click', function(event) {
        $('#addnotesmodal').modal('show');
        $('#btn-n-add').show();
    })	
	
	$( "#guardar_nota" ).submit(function( event ) {
		var parametros = $(this).serialize();
		
		$.ajax({
				type: "POST",
				url: "agregar_nota.php",
				data: parametros,
				 beforeSend: function(objeto){
					$("#loader").html("Mensaje: Cargando...");
				  },
				success: function(datos){
				$("#resultados_ajax").html(datos);
				$('#loader').html('');
				 $('#addnotesmodal').modal('hide');
				
				load(1);
			  }
		});
	
		event.preventDefault();
	})	
	
	function actualizar_categoria(id,value){
			page=1;
			var q= "";
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'notas_ajax.php?action=ajax&page='+page+'&q='+q+'&actualizar='+id+'&value='+value,
				 beforeSend: function(objeto){
				 $('#loader').html('Cargando...');
			  },
				success:function(data){
					$(".tab-content").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
			
	}
	
	
	
	
	 var $btns = $('.note-link').click(function() {
        if (this.id == 'all-category') {
          var $el = $('.' + this.id).fadeIn();
          $('#note-full-container > div').not($el).hide();
        } if (this.id == 'important') {
          var $el = $('.' + this.id).fadeIn();
          $('#note-full-container > div').not($el).hide();
        } else {
          var $el = $('.' + this.id).fadeIn();
          $('#note-full-container > div').not($el).hide();
        }
        $btns.removeClass('active');
        $(this).addClass('active');  
    })