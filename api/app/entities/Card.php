<?php

namespace App\Entity;

use \Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function new_game(){
        $cards = [];
        $cards= array_merge(range(1, 6),range(1, 6));
        shuffle($cards);
        return $cards;
    }
}