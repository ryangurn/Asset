<?php
/**
 * Created by PhpStorm.
 * User: Ryan Gurnick
 * Date: 6/20/2019
 * Time: 7:25 PM
 */

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface Stub
{
    public function __construct(Request $request, Model $model);
    public function validate();
    public function response();
}