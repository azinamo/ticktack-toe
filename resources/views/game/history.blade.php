@extends('layouts.app')

@section('content')
    <main role="main" class="container">
        <h3>Stats</h3>
        <table class="table table-bordered">
            <tr>
                <th>Played</th>
                <td>{!! $stats['played'] !!}</td>
            </tr>
            <tr>
                <th>Won</th>
                <td>{!! $stats['won'] !!}</td>
            </tr>
            <tr>
                <th>Draws</th>
                <td>{!! $stats['draws'] !!}</td>
            </tr>
            <tr>
                <th>Lost</th>
                <td>{!! $stats['lost'] !!}</td>
            </tr>
        </table>

        <h3>History</h3>
        <table class="table  table-bordered">
            <tr>
                <th>Game</th>
                <th>Status</th>
                <th>Winner</th>
                <th></th>
            </tr>
            @if (count($games) > 0)
                @foreach($games as $game)
                    <tr>
                        <td>{!! $game->id !!}</td>
                        <td>
                            {!! $game->getStatusName() !!}
                        </td>
                        <td>
                            {!! $game->winner !!}
                        </td>
                        <td>
                            @if ($game->status == 'in_play')
                                <a href="{!! route('continue_game', ['game_id' => $game->id] ) !!}">Continue</a>
                            @else
                                --
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No games played</td>
                </tr>
            @endif
        </table>
    </main>
@endsection
@section('javascript')
@endsection