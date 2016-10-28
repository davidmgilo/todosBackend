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
    public function index()
    {
        //No metadata
        //Pagination
        //No error message
        //Transformations: hem de transformar el que ensenyem
        $tasks = Task::paginate(15);
        return $this->generatePaginatedResponse($tasks, ['propietari' => 'David Martinez',]);
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
//        try {
            return Task::findOrFail($id);
//        } catch (\Exception $e) {
//            return Response::json([
//               'error' => 'Hi ha hagut una excepció',
//               'code'  => 10
//            ],404);
//        }

//        $task = Task::find($id);
//
//        if($task != null){
//            return $task;
//        }
//
//        return Response::json([
//               'error' => 'Hi ha hagut una excepció',
//               'code'  => 10
//            ],404);
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

    /**
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    protected function generatePaginatedResponse($resource, array $metadata = [])
    {
        $paginationData = $this->generatePaginationData($resource);
        $data = [
            'data' => $resource->toArray()
        ];

        return Response::json(array_merge($metadata,$paginationData,$data), 200);
    }

    /**
     * @param $resource
     * @return array
     */
    protected function generatePaginationData($resource)
    {
        $paginationData = [
            'total' => $resource->total(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'last_page' => $resource->lastPage(),
            'next_page_url' => $resource->nextPageUrl(),
            'prev_page_url' => $resource->previousPageUrl(),
        ];
        return $paginationData;
    }
}
