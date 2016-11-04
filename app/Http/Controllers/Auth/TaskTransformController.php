<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 04/11/16
 * Time: 13:06
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

class TaskTransformController extends Controller
{
    protected function transform($resource)
    {
        return [
            'name' => $resource['name'],
            'done' => (boolean)$resource['done'],
            'priority' => (integer)$resource['priority'],

        ];
    }


}