<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class TasksApiTest
 */
class TasksApiTest extends TestCase
{

    protected $uri = '/api/task';
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowAllTasks()
    {
        $this->json('GET',$this->uri)
//            ->dump();
                ->seeJson();
//         ->assertCount(30)
        $this->assertCount(30,$this->json('GET',$this->uri)->decodeResponseJson());
//        $this->assertCount(19,$this->json('GET',$this->uri)->decodeResponseJson());
//        echo count($this->json('GET',$this->uri)->decodeResponseJson());
    }

    /**
     * @group failing
     */
    public function testShowOneTask()
    {
        $task = factory(App\Task::class)->create();
        $this->json('GET', $this->uri . '/' . $task->id)
//            ->dump();
            ->seeJsonStructure(
                    [ "id", "name", "done", "priority" ]
            )
            ->seeJsonContains([
                "name" => $task->name,
//                "done" => $task->done,
//                "priority" => $task->priority,
            ]);
    }
}
