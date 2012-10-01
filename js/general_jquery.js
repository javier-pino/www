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
    
    
    new_datatable($('table.paginated'), true);    
    new_datatable($('table.no_paginated'), false);    
    
    $( "input:submit, button").button();
    
    $( "input:submit.delete, button.delete").click(function () {
        var agree = confirm("¿Está seguro que desea eliminar el registro?");
        if (agree)
            return true ;
        else
            return false ;        
    });
    
    var last_selected_value = $('#selected_value_hidden').val();
    var last_selected_id = $('#selected_id_hidden').val();
    $( ".selectable" ).selectable({
        selecting: function(event, ui) {            
            
            //Se guarda el ultimo
            last_selected_value = ui.selecting.value;
            last_selected_id = ui.selecting.id;
        },
        stop: function(event, ui) {                                   
            $(event.target).children('.ui-selected').not("#" + last_selected_id).removeClass('ui-selected');           
            $( '#selected_value_hidden' ).val(last_selected_value);                        
            $( '#selected_id_hidden' ).val(last_selected_id);                        
        }        
    });

    //Se coloca como seleccionado, aquellos que vienen de un post anterior
    $("#" + last_selected_id, ".selectable" ).addClass('ui-selected');
    
    $(document).delegate('div.message', 'click', function () {
        $(this).hide();        
    }) ;
    
});			


/** 
* Ya que todas las tablas generadas tendrán el formato de las data tables 
* se usa esta función para setear los valores por defecto
*/
function new_datatable($selector, paginate) {

    if ($selector.size() == 0) 
        return;
    
    $selector.dataTable({         
        "bJQueryUI": true,        
        "bPaginate": paginate,        
        "sScrollX": "100%",
        "bScrollCollapse": false,
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


