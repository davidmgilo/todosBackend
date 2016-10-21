<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksApiTest extends TestCase
{
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

    public function testShowOneTask()
    {
        $id=1;
        $this->json('GET','/api/task' . '/' . $id)
//            ->dump();
            ->seeJson();
    }
}
