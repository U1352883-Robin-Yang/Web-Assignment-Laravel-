<?php

namespace App\Http\Controllers;
use App\AnimeNote;
use App\Anime;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class AnimeController extends Controller
{
  public static function show(){

    $animes = Anime ::orderBy('created_at', 'desc')->take(5)->get();
    return view('page.forumHome', compact('animes')); // get anime from DB and show 5 most recent data
  }

  public function animeInformation(Anime $anime){

  $anime->load('note'); // gets the note belong to anime

  return view('page.forumInformation', compact('anime'));
  }

  public function addAnimeInformation(Request $request, Anime $anime, User $user){

  $this->validate($request,['body'=>'required']); // validation for empty body (field)
  $animeNote = new AnimeNote($request->all()); // get all passed request
  $user = Auth::user()->id;
  $anime->addAnimeNote($animeNote, $user); //takes user id 1 (for testing)
  return back(); // refresh and update page
}

  public function searchAnime(Request $request){

    $this->validate($request,['anime'=>'required']); // validation for body
    $search = $request['anime']; // get request from search box (name)
    $result = Anime::where('name','LIKE',"%$search%")->get(); // compare with database
    return view('page.forumHome')->with('result', $result); // send information to view
  }

}
