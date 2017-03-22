<?php

namespace Davidmgilo\TodosBackend\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class BoxmodelController extends BaseController
{
    //
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        return view('boxmodel',$data);
    }

}
