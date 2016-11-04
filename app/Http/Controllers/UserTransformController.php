<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 04/11/16
 * Time: 13:06
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

class UserTransformController extends Controller
{
    protected function transform($resource)
    {
        return [
            'name' => $resource['name'],
            'email' => $resource['email'],

        ];
    }


}