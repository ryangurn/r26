<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;

class ReadController extends ModelController
{

    public function __construct($model, Request $request)
    {
        parent::__construct($model, $request);
    }

    public function read($read_id){
        // End Validation
        // Creation Specific
        $model = $this->model::where('id', '=', $read_id)->first();

        if($model == null) {
            return response()->json([
                'status' => 'not ok',
                'errors' => ['record not found']
            ], 400);
        }

        // Response
        return response()->json([
            'status' => 'ok',
            'data' => $model
        ], 200);
    }

    public function all(){
        if($this->request->exists('trashed')) {
            $model = $this->model::withTrashed()->get();
        }else{
            $model = $this->model::all();
        }

        if($model == null){
            return response()->json([
                'status' => 'not ok',
                'errors' => ['records not found'],
            ], 400);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $model
        ]);
    }

    public function count(){
        $model = $this->model::all();

        if($model == null){
            return response()->json([
                'status' => 'not ok',
                'errors' => ['records not found'],
            ], 400);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $model->count()
        ]);
    }
}
