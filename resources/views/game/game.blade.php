<h4>You play -> X</h4>
<form class="form-horizontal" role="form" method="POST" action="{!! route('save_game', array('game_id' => $game->id)) !!}" id="tick_tack_form">
    <input type="hidden"
           name="_token"
           value="{{ csrf_token() }}">

    <div class="container">
        <div class="row">
            <div class="text-center" id="tick_tock_board">
                @for($row = 0; $row < $board->getRows(); $row++)
                    <div class="col-lg-12">
                        @for($col = 0; $col < $board->getCols(); $col++)
                            @if (isset($moves[$row]) and isset($moves[$row][$col]))
                                <div class="board-tick-tock receiever text-center col-lg-4 ui-droppable ui-state-highlight" id="droppable-<?php echo $col; ?>" data-row-col="{!! $row !!},{!! $col !!}">
                                    {{ $moves[$row][$col] }}
                                    <input type="hidden" value="{{ $moves[$row][$col] }}" name="tick_tack[{!! $row !!}][{!! $col !!}]" id="tick_tack_{!! $row !!}_{!! $col !!}">
                                </div>
                            @else
                                <div class="board-tick-tock receiever text-center col-lg-4" id="droppable-<?php echo $col; ?>" data-row-col="{!! $row !!},{!! $col !!}">
                                    <input type="hidden" value="" name="tick_tack[{!! $row !!}][{!! $col !!}]" id="tick_tack_{!! $row !!}_{!! $col !!}">
                                </div>
                            @endif
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
        <div class="ui vertical segment">
            <div class="tick-tock text-center" id="draggable-x">X</div>
            <div class="tick-tock text-center" id="draggable-o">O</div>
        </div>
    </div>

</form>