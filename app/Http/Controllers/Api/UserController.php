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
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        $create = new CreateController('App\User', $request);
        return $create->create();
    }

    /**
     * @param $user_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function read($user_id, Request $request){
        $read = new ReadController('App\User', $request);
        return $read->read($user_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(Request $request){
        $all = new ReadController('App\User', $request);
        return $all->all();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function count(Request $request){
        $read = new ReadController('App\User', $request);
        return $read->count();
    }

    /**
     * @param $user_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($user_id, Request $request){
        $update = new UpdateController('App\User', $request);
        return $update->update($user_id);
    }

    /**
     * @param $user_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($user_id, Request $request){
        $delete = new DeleteController('App\User', $request);
        return $delete->delete($user_id);
    }

    /**
     * @param $user_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function availabilityCreate(Request $request){
        $create = new CreateController('App\UserAvailability', $request);
        return $create->create();
    }

    /**
     * @param $user_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function availabilityRead($availability_id, Request $request){
        $read = new ReadController('App\UserAvailability', $request);
        return $read->read($availability_id);
    }

    /**
     * @param $availability_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function availabilityUpdate($availability_id, Request $request){
        $update = new UpdateController('App\UserAvailability', $request);
        return $update->update($availability_id);
    }

    /**
     * @param $availability_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function availabilityDelete($availability_id, Request $request){
        $delete = new DeleteController('App\UserAvailability', $request);
        return $delete->delete($availability_id);
    }
}
