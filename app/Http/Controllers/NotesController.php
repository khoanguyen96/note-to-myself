<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notes;
use App\User;

class NotesController extends Controller {
  public function index(){
      $user = Auth::user();
      $websites_array = explode(',', $user->websites);
    return View::make('notes')->with('user',$user)->with('sites',$websites_array);
  }


  public function update($id) {
    $note = User::find($id);

    if($note) {
      $note->notes = Input::get('notes');
      $websites_array = Input::get('websites');
      $note->websites = implode(',', $websites_array);
      $note->tbd = Input::get('tbd');
      $note->save();
    }
    else {
      $note = new Notes;
      $note->userid = Auth::user()->id;
      $note->email = Auth::user()->email;
      $note->notes = Input::get('notes');
      $note->save();
    }
    return redirect()->back();
  }
}
