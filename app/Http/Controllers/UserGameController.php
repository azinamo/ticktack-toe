<?php

namespace App\Http\Controllers;

use App\Lib\TickTockBoard;
use App\UserGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $board = new TickTockBoard();
        return view('game.index')->with(['board' => $board]);
    }

    /**
     * Save the state of the current game bieng played
     *
     * @return \Illuminate\Http\Response
     */
    public function saveGame(Request $request, $game_id)
    {
        //
        $game = UserGame::findOrFail($game_id);

        $playState = $request->get('tick_tack');

        $board = new TickTockBoard();

        $playerLines = [$board->getTick() => [], $board->getTock() => []];
        $counter = 0;
        $countPlayed = 0;
        foreach ($playState as $row => $cols) {
            foreach ($cols as $index => $val) {
                if ($val == $board->getTick()) {
                  $playerLines[$board->getTick()][] = $counter;
                  $countPlayed++;
                } elseif($val == $board->getTock()) {
                  $playerLines[$board->getTock()][] = $counter;
                  $countPlayed++;
                }
                $counter++;
            }
        }
        $isDraw = false;
        $winner =  $board->calculateGameWinner($playerLines);
        if (!$winner && $countPlayed == 9) {
            $isDraw = true;
        } else {
            $game->status = 'in_play';
        }

        $response = ['nextPlayer' => 'Next player: '.($request->get('selected') == 'X' ? 'O' : 'X'), 'hasWinner' => ($winner ? true : $isDraw)];
        if ($winner) {
            $response['winnerText'] = 'Winner: '.$winner;
            $game->winner = $winner;
            $game->status = 'completed';
        }
        if ($isDraw) {
            $response['winnerText'] = 'Draw';
            $game->status = 'draw';
        }
        $game->moves = json_encode($playState);
        $game->end_date = date('Y-m-d H:i:s');
        $game->save();

        return response()->json($response);
    }

    /**
     * Show game history
    */
    public function history(Request $request)
    {
        //
        $games = UserGame::where('user_id', Auth::user()->id)->get();

        $stats = ['played' => 0, 'won' => 0, 'lost' => 0, 'draws' => 0];

        $played = 0;
        foreach ($games as $game)
        {
            if ($game->winner == 'X') {
                $stats['won'] += 1;
            } elseif ($game->winner == 'O') {
                $stats['lost'] += 1;
            } elseif ($game->status == 'draw') {
                $stats['draws'] += 1;
            }
            $played++;
        }
        $stats['played'] = $played;
        return view('game.history')->with(['games' => $games, 'stats' => $stats]);
    }

    /**
     * Display game board
     */
    public function game(Request $request)
    {
        $playerMoves = [];
        if ($request->get('game_id')) {
            $game = UserGame::findOrFail($request->get('game_id'));
            $playerMoves = json_decode($game->moves, 1);
        } else {
            $game = new UserGame();
            $game->user_id = Auth::user()->id;
            $game->start_date = date('Y-m-d');
            $game->end_date = date('Y-m-d');
            $game->moves = json_encode(array());
            $game->save();
        }

        $board = new TickTockBoard();
        return view('game.game')->with(['board' => $board, 'game' => $game, 'moves' => $playerMoves]);
    }

    /**
     * Continue game
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function continueGame($game_id)
    {
        //
        $game = UserGame::findOrFail($game_id);

        return view('game.continue_game')->with(['game' => $game]);
    }

}
