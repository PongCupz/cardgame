<?php

namespace App\Entity;

use \Illuminate\Database\Eloquent\Model;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Score extends Model
{
    public function best_score()
    {
        $score = Score::where('id',1)->first();
        return $score->best_score;
    }

    public function new_score($new_score,$user_id){
        $score = Score::where('id',1)->first();
        if($score->best_score == 0 || $new_score < $score->best_score){
            $score->best_score = $new_score;
            $score->user_id = $user_id;
            $score->save();
            Score::publish_hight_score($new_score);
        }
        return $score->best_score;
    }

    private function publish_hight_score($score)
    {
      $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
      $channel = $connection->channel();
      $routing_key = 'test';
      $msg = new AMQPMessage($score);
      $channel->basic_publish($msg, 'amq.topic', $routing_key);  
      $channel->close();
      $connection->close();
    }
}