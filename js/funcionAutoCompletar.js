$(function(){
			  var patentes = [ 

			   {value: "asd345" , data: " 2015-09-16 00:51:17 " }, 
 {value: "cfr245" , data: " 2018-04-14 21:54:57 " }, 
 {value: "ytu548" , data: " 2018-04-14 22:03:36 " }, 

			   
			  ];
			  
			  // setup autocomplete function pulling from patentes[] array
			  $('#autocomplete').autocomplete({
			    lookup: patentes,
			    onSelect: function (suggestion) {
			      var thehtml = '<strong>patente: </strong> ' + suggestion.value + ' <br> <strong>ingreso: </strong> ' + suggestion.data;
			      $('#outputcontent').html(thehtml);
			         $('#botonIngreso').css('display','none');
      						console.log('aca llego');
			    }
			  });
			  

			});