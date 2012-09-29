$(function() {    
    
    $("#nav ul li a").mouseover(function() {
		
        $(this).parent().find("div.dropdown").fadeIn(100);

        $(this).parent().hover(function() {
            }, function(){	
                $(this).parent().find("div.dropdown").hide();
            });

    //Following events are applied to the trigger (Hover events for the trigger)
    }).hover(function() { 
        $(this).addClass("subhover"); //On hover over, add class "subhover"
    }, function(){	//On Hover Out
        $(this).removeClass("subhover"); //On hover out, remove class "subhover"
    });
    
    new_datatable($('table'));    
    
    $( "input:submit, button").button();
    
    $(document).delegate('div.message', 'click', function () {
        $(this).hide();        
    }) ;
    
});			


/** 
* Ya que todas las tablas generadas tendrán el formato de las data tables 
* se usa esta función para setear los valores por defecto
*/
function new_datatable($selector, $column_info) {

    $selector.dataTable({         
        "bJQueryUI": true,        
        "bPaginate": false,        
        "sPaginationType": "full_numbers",                 
        "oLanguage": { 
            "oPaginate": { 
                "sPrevious": "Anterior", 
                "sNext": "Siguiente", 
                "sLast": "Última", 
                "sFirst": "Primera" 
        },         
        "sLengthMenu": 'Mostrar <select>'+ 
        '<option value="10">10</option>'+ 
        '<option value="20">20</option>'+ 
        '<option value="30">30</option>'+ 
        '<option value="40">40</option>'+ 
        '<option value="50">50</option>'+ 
        '<option value="-1">Todos</option>'+ 
        '</select> registros',

        "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 
        "sInfoFiltered": " - filtrados de _MAX_ registros", 
        "sInfoEmpty": "No hay resultados de búsqueda", 
        "sZeroRecords": "No hay registros a mostrar", 
        "sProcessing": "Espere, por favor...", 
        "sSearch": "Buscar:"    
        }         
    });        
}


