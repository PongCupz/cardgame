<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Entity\User;
use App\Entity\Card;
use App\Entity\Score;

class UserController extends Controller
{

  public function new(Request $request, Response $response, $args)
  {
    $res = new \stdClass();
    $user = new User();
    $user->save();
    $card = new Card();
    $card->data = json_encode($card->new_game());
    $card->user_id = $user->id;
    $card->save();
    $res->user_id = $user->id;
    $res->id = $card->id;
    $res->global_best_score = Score::best_score();
    $res->data = array_map(function($val) { return -1; },json_decode($card->data));
    return $response->withJson($res);
  }

}