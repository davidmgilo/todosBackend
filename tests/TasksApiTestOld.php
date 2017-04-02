<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class TasksApiTest.
 */
class TasksApiTestOld extends TestCase
{
    protected $uri = '/api/v1/task';
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowAllTasks()
    {
        factory(Davidmgilo\TodosBackend\Task::class, 10)->create();
        $this->json('GET', $this->uri)
//            ->dump();
                ->seeJson();
//         ->assertCount(30)
        $this->assertCount(10, $this->decodeResponseJson());
//        $this->assertCount(19,$this->json('GET',$this->uri)->decodeResponseJson());
//        echo count($this->json('GET',$this->uri)->decodeResponseJson());
        $this->seeJsonStructure([
            '*' => ['id', 'name', 'done', 'priority'],
        ]);
        //You may use the * to assert that the returned JSON structure has a list where each list item contains at least the attributes found in the set of values:
    }

    /**
     * @group hh
     */
    public function testShowOneTask()
    {
        $task = factory(Davidmgilo\TodosBackend\Task::class)->create();
        $this->json('GET', $this->uri.'/'.$task->id)
//            ->dump();
            ->seeJsonStructure(
                    ['id', 'name', 'done', 'priority']
            )
            ->seeJsonContains([
                'name' => $task->name,
//                "done" => $task->done,
//                "priority" => $task->priority,
            ]);
    }
}
