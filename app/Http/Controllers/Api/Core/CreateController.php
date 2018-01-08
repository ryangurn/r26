<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CreateController extends ModelController
{
    public function __construct($model, Request $request)
    {
        parent::__construct($model, $request);
    }

    public function create(){
        // Validation
        $validator = validator($this->request->all(), $this->model->CRU_validator);

        if($validator->fails()){
            return response()->json([
               'status' => 'not ok',
                'errors' => $validator->errors()->all()
            ], 400);
        }
        // End Validation
        // Creation Specific
        $model = new $this->model($this->request->all());
        if(!$model->save()){
            throw new HttpException(500);
        }
        // Response
        return response()->json([
            'status' => 'ok',
            'data' => $model
        ], 200);
    }
}
