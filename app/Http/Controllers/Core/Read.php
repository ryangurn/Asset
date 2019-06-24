<?php
/**
 * Created by PhpStorm.
 * User: Ryan Gurnick
 * Date: 6/20/2019
 * Time: 7:24 PM
 */

namespace App\Http\Controllers\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;



class Read extends CRUD
{
    public function validate()
    {
        # confirm that the model given by the user is the same as the model provided by the application
        if(ucfirst(strtolower($this->requestData['model'])) != class_basename($this->model))
        {
            $this->response->push("The model you are attempting to access is not allowed");
        }

        $validator = validator()->make($this->requestData['parameters'], $this->model->readValidator);
        if($validator->fails())
        {
            $this->response->push("There are validation errors please check the documentation");
        }
    }

    public function response()
    {
        if ( $this->response->isNotEmpty() )
        {
            return parent::response();
        }

        $class = "\App\\".class_basename($this->model);
        return $class::where('id', '=', $this->requestData['parameters']['id'])->first();
    }
}