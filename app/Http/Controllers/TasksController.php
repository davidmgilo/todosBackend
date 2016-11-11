<?php

namespace App\Http\Controllers;

use App\Respositories\TaskRepository;
use App\Task;
use App\Transformers\TaskTransformer;
use Illuminate\Http\Request;
use Response;

class TasksController extends Controller
{
    protected $repository;

    /**
     * TasksController constructor.
     */
    public function __construct(TaskTransformer $transformer, TaskRepository $repository)
    {
        parent::__construct($transformer);

        $this->repository = $repository;
    }

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

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'David Martinez']);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        $request->input('name')
        Task::create($request->all());

        return response([
            'error'   => false,
            'created' => true,
            'message' => 'Task created successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $task = $this->repository->find($id);

        return $this->transformer->transform($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Task::findOrFail($id)->update($request->all());

        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Task updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return response([
            'error'   => false,
            'deleted' => true,
            'message' => 'Task deleted successfully',
        ], 200);
    }
}
