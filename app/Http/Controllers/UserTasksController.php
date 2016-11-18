<?php

namespace App\Http\Controllers;

use App\Task;
use App\Transformers\TaskTransformer;
use App\User;
use Illuminate\Http\Request;

/**
 * Class UserTasksController.
 */
class UserTasksController extends Controller
{
    /**
     * UserTasksController constructor.
     *
     * @param TaskTransformer $transformer
     */
    public function __construct(TaskTransformer $transformer)
    {
        parent::__construct($transformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        //        dd($id);
        $user = User::findOrFail($id);

        $tasks = $user->tasks()->paginate(5);

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'David Martinez']);
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
     * @param $iduser
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $iduser)
    {
        $user = User::findOrFail($iduser);
        Task::create($request->only(['name', 'done', 'priority', $user->id]));

        return response([
            'error'   => false,
            'created' => true,
            'message' => 'Task from user created successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $iduser
     * @param $idtask
     * @return \Illuminate\Http\Response
     *
     */
    public function show($iduser, $idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);
        return $this->transformer->transform($task);
//        $task = $user->tasks()->findOrFail($idtask)->paginate(1);
//        return $this->generatePaginatedResponse($task, ['propietari' => 'David Martinez']);
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
     * @param $iduser
     * @param $idtask
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function update(Request $request, $iduser, $idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);
        $task->update($request->only(['name', 'done', 'priority', 'user_id']));

        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Task from user updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $iduser
     * @param $idtask
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function destroy($iduser, $idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);
        $task->delete();

        return response([
            'error'   => false,
            'deleted' => true,
            'message' => 'Task from user deleted successfully',
        ], 200);
    }
}
