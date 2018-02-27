@extends('layouts.app')

@section('content')
    <main role="main" class="container">

        <div class="panel panel-primary">
            <div class="panel-heading clearfix">
                <h5 class="panel-title pull-left" style="padding-top: 7.5px; padding-right: 30px;">Tick Tack Toe</h5>
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger" role="button" id="start_game" data-ajax-url="{!! route('load_game') !!}">
                         Start
                    </a>
                </div>
            </div>
            <div class="panel-body">

                <div class="alert" id="responseText" style="display: none;"></div>
                <div id="game_area">
                    Click start to start the game
                </div>

            </div>
        </div>
    </main>
@endsection
@section('javascript')
    <script type="text/javascript" src="{!! url('js') !!}/tick_tack.js"></script>
@endsection