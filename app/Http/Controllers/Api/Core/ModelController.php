<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ModelController extends Controller
{
    protected $model;
    protected $validator;
    protected $fillable;
    protected $request;

    public function __construct($model, Request $request)
    {
        $this->model = new $model;

        $this->validator = $this->model->validator;
        $this->fillable = $this->model->fillable;
        $this->request = $request;

    }

    /**
     * @param $array array
     *
     * This function will allow the developer to inject information into the request for the specific purpose of
     * removing user inputted data and replace that with specific values.
     */
    public function injectData($array){
        $this->request->merge($array);
    }

    public function injectAuth(){
        $user = JWTAuth::parseToken()->authenticate();
        $this->request->merge(['user_id' => $user->id]);
    }
}
