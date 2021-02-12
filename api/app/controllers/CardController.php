<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Entity\Card;
use App\Entity\Score;
use App\Entity\User;

class CardController extends Controller
{

  public function new(Request $request, Response $response, $args)
  {
    $_input = $request->getParsedBody();

    $res = new \stdClass();
    $card = new Card();
    $card->data = json_encode($card->new_game());
    $card->user_id = $_input['user_id'];
    $card->save();
    $user = new User();
    $user->get_user($card->user_id);

    $res->id = $card->id;
    $res->best_score = $user->best_score();
    $res->global_best_score = Score::best_score();
    $res->data = array_map(function($val) { return -1; },json_decode($card->data));
    return $response->withJson($res);
  }

  public function click(Request $request, Response $response, $args)
  {
    $res = new \stdClass();

    $card = Card::where('id',$args['id'])->first();
    $user = new User();
    $user->get_user($card->user_id);
    $_input = $request->getParsedBody();
    $data = json_decode($card->data);
    $paired = is_null(json_decode($card->paired))?[]:json_decode($card->paired);
    if($_input['picked'] != $card->picked && !in_array($data[$_input['picked']],$paired)){
      $card->click += 1;
      if($card->click % 2 == 0){
        if($data[$_input['picked']] == $data[$card->picked]){
          if (is_null($card->paired))
            $paired = [];
          else
            $paired = json_decode($card->paired);
          array_push($paired,$data[$_input['picked']]);
          $card->paired = json_encode($paired);
          if(count($paired)==6){
            $card->completed = 1;
            $user->new_best_score($card->click);
            Score::new_score($card->click,$card->user_id);
          }
        }
        $pre_picked = $card->picked;
        $card->picked = -1;
      }else{
        $card->picked = $_input['picked'];
      }
    }

    $card->save();

    $res->id = $card->id;
    $res->best_score = $user->best_score();
    $res->global_best_score = Score::best_score();
    $res->click = $card->click;
    $res->data = [];
    
    foreach(json_decode($card->data) as $val){
      if (!is_null(json_decode($card->paired)) && in_array($val,json_decode($card->paired)))
        array_push($res->data,$val);
      else
        array_push($res->data,-1);
    }

    $res->data[$_input['picked']] = json_decode($card->data)[$_input['picked']];
    if($card->click % 2 == 0)
      $res->data[$pre_picked] = json_decode($card->data)[$pre_picked];
    return $response->withJson($res);
  }

  public function game(Request $request, Response $response, $args)
  {
    $res = new \stdClass();

    $card = Card::where('id',$args['id'])->first();
    $user = new User();
    $user->get_user($card->user_id);

    $res->id = $card->id;
    $res->user_id = $card->user_id;
    $res->best_score = $user->best_score();
    $res->global_best_score = Score::best_score();
    $res->click = $card->click;
    $res->data = [];
    
    foreach(json_decode($card->data) as $val){
      if (!is_null(json_decode($card->paired)) && in_array($val,json_decode($card->paired)))
        array_push($res->data,$val);
      else
        array_push($res->data,-1);
    }
    if($card->click % 2 != 0)
      $res->data[$card->picked] = json_decode($card->data)[$card->picked];
    return $response->withJson($res);
  }
}