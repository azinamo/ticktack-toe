<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
    //
    protected $table = 'user_games';

    public $timestamps = true;

    protected $fillable = ['user_id', 'moves', 'status', 'winner', 'start_date', 'end_date'];

    public function getStatusName()
    {
        if ($this->status == 'completed') {
            return 'Completed';
        } elseif( $this->status == 'in_play') {
          return 'In-Play';
        } elseif($this->status == 'draw') {
            return 'Draw';
        }

    }


}
