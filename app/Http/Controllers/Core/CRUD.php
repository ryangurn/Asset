<?php
/**
 * Created by PhpStorm.
 * User: Ryan Gurnick
 * Date: 6/23/2019
 * Time: 10:10 AM
 */

namespace App\Http\Controllers\Core;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CRUD implements Stub
{
    public $request;

    public $requestData = [];

    public $validate;
    public $response;
    public $model;

    public function __construct(Request $request, Model $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->response = collect();
        $this->processRequest();
    }

    public function validate()
    {
        throw new \Exception("CRUD `validate` method is not implemented in the child class!");
    }

    public function response()
    {
        return $this->response;
    }

    public function processRequest()
    {
        // generate basic information using request
        $explodedPath = explode("/", $this->request->getPathInfo());
        unset($explodedPath[0], $explodedPath[1]);

        $this->requestData['method'] = $this->request->getMethod();
        $this->requestData['parameters'] = $this->request->all();
        $this->requestData['model'] = $explodedPath[2];
    }
}