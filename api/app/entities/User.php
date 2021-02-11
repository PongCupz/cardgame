<?php

namespace App\Entity;

use \Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $_user;

    public function get_user($user_id){
        $this->_user = User::where('id',$user_id)->first();
    }

    public function new_best_score($new_score){
        if($new_score < $this->_user->best_score || $this->_user->best_score == 0){
            $this->_user->best_score = $new_score;
            $this->_user->save();
        }
        return $this->_user->best_score;
    }

    public function best_score(){
        return $this->_user->best_score;
    }
}