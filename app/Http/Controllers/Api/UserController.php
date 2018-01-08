<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Core\CreateController;
use App\Http\Controllers\Api\Core\DeleteController;
use App\Http\Controllers\Api\Core\ReadController;
use App\Http\Controllers\Api\Core\UpdateController;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function create(Request $request){
        $create = new CreateController('App\User', $request);
        return $create->create();
    }

    public function read($user_id, Request $request){
        $read = new ReadController('App\User', $request);
        return $read->read($user_id);
    }

    public function all(Request $request){
        $all = new ReadController('App\User', $request);
        return $all->all();
    }

    public function count(Request $request){
        $read = new ReadController('App\User', $request);
        return $read->count();
    }

    public function update($user_id, Request $request){
        $update = new UpdateController('App\User', $request);
        return $update->update($user_id);
    }

    public function delete($user_id, Request $request){
        $delete = new DeleteController('App\User', $request);
        return $delete->delete($user_id);
    }
}
