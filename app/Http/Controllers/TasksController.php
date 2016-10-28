<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //No metadata
        //Pagination
        //No error message
        //Transformations: hem de transformar el que ensenyem
        $tasks = Task::paginate(15);
        return Response::json([
            'propietari'    => 'David Martinez',
            'total'         => $tasks->total(),
            'per_page'      => $tasks->perPage(),
            'current_page'  => $tasks->currentPage(),
            'last_page'     => $tasks->lastPage(),
            'next_page_url' => $tasks->nextPageUrl(),
            'prev_page_url' => $tasks->previousPageUrl(),
            'data' => $tasks->toArray()
            ],200);
//        return Task::paginate($request->input('per_page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->input('name')
        Task::create($request->all());
        return response(array(
            'error' => false,
            'message' =>'Task created successfully',
        ),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Task::findOrFail($id);
        } catch (\Exception $e) {
            return Response::json([
               'error' => 'Hi ha hagut una excepció',
               'code'  => 10
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return Task::findOrFail($id)->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return Task::findOrFail($id)->delete();
    }
}
