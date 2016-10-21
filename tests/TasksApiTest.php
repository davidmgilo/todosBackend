<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class TasksApiTest
 */
class TasksApiTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowAllTasks()
    {
        $this->json('GET','/api/task')
//            ->dump();
            ->seeJson();
    }

    /**
     * @group failing
     */
    public function testShowOneTask()
    {
        $task = factory(App\Task::class)->create();
        $id=1;
        $this->json('GET','/api/task' . '/' . $id)
//            ->dump();
            ->seeJson();
    }
}
