var TickTackToe = (function($){

    var gameArea     = $("#game_area");
    var responseText = $("#responseText");

    return {

        loadGame: function(el)
        {
            var ajaxUrl = $(el).data('ajax-url');
            $.get(ajaxUrl, function(responseHtml) {

                gameArea.html( responseHtml );

                var draggableX = $("#draggable-x");
                var draggableO = $("#draggable-o");
                var receiever = $( ".receiever");

                draggableX.draggable({
                    revert: true,
                    enabled: true
                });

                draggableO.draggable({
                    revert:true,
                    disabled: true
                });

                receiever.droppable({
                    accept: '.tick-tock',
                    classes: {
                        "ui-droppable-active": "ui-state-active",
                        "ui-droppable-hover": "ui-state-hover"
                    },
                    drop: function( event, ui ) {
                        var self = ui.draggable;
                        var selected = '';
                        if (ui.draggable.attr('id') == 'draggable-x') {
                            $( this )
                                .addClass( "ui-state-highlight" )
                                .append( "X" )
                                .find('input[type="hidden"]').val('X');
                            selected = 'X';
                            draggableX.draggable( "disable" );
                            draggableO.draggable( "enable" );
                        } else {
                            $( this )
                                .addClass( "ui-state-highlight" )
                                .append( "O" )
                                .find('input[type="hidden"]').val('O');
                            selected = 'O';
                            draggableX.draggable( "enable" );
                            draggableO.draggable( "disable" );
                        }

                        TickTackToe.saveGameState(selected);
                    }
                });
            });
        } ,

        saveGameState: function(selected)
        {
            var draggableX = $("#draggable-x");
            var draggableO = $("#draggable-o");
            $("#tick_tack_form").ajaxSubmit({
                data: {
                    selected: selected
                },
                success:       function(responseJson, statusText, xhr, $form)  {

                    if (!responseJson.hasWinner) {
                        responseText.html(responseJson.nextPlayer).removeClass("alert-success").addClass("alert").addClass("alert-warning").show()
                    } else {
                        responseText.html(responseJson.winnerText).removeClass('alert-warning').addClass("alert").addClass("alert-success").show()
                        draggableX.draggable("disable");
                        draggableO.draggable("disable");
                    }

                },  // post-submit callback
                dataType: 'json',
                type: 'post'
            })
        }

    }
}(jQuery));


jQuery(function($){

    var draggableX   = $("#draggable-x");
    var draggableO   = $("#draggable-o");

    $("#start_game").on('click', function(e){
        TickTackToe.loadGame($(this));
    });


});