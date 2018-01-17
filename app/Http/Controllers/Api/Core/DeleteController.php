<?php

namespace App\Http\Controllers\Api\Core;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeleteController extends ModelController
{
    public function __construct($model, Request $request)
    {
        parent::__construct($model, $request);
    }

    public function delete($delete_id){
        $this->injectData(['delete_id' => $delete_id]);
        // Validation
        $validator = validator($this->request->all(), $this->model->D_validator);

        if($validator->fails()){
            return response()->json([
               'status' => 'not ok',
                'errors' => $validator->errors()->all()
            ], 400);
        }
        // End Validation
        // Creation Specific
        $model = $this->model::where('id', '=', $delete_id);
        if(!$model->delete()){
            throw new HttpException(500);
        }
        // Response
        return response()->json([
            'status' => 'ok',
        ], 200);
    }
}
