<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdateController extends ModelController
{
    public function __construct($model, Request $request)
    {
        parent::__construct($model, $request);
    }

    public function update($update_id){
        $validator = validator($this->request->all(), $this->model->CRU_validator);

        if($validator->fails()){
            return response()->json([
                'status' => 'not ok',
                'errors' => $validator->errors()->all()
            ]);
        }

        $model = $this->model::where('id', '=', $update_id)->first();
        $model->update($this->request->all());
        if(!$model->save()){
            throw new HttpException(500);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $model
        ], 201);
    }
}
