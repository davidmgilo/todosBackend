<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class TasksApiTest.
 */
class TasksApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * RESOURCE URL ON API.
     *
     * @var string
     */
    protected $uri = '/api/v1/task';

    /**
     * Default number of tasks created in database.
     */
    const DEFAULT_NUMBER_OF_TASKS = 5;

    /**
     * Seed database with tasks.
     *
     * @param int $numberOfTasks to create
     */
    protected function seedDatabaseWithTasks($numberOfTasks = self::DEFAULT_NUMBER_OF_TASKS)
    {
        factory(App\Task::class, $numberOfTasks)->create(['user_id' => 1]);
    }

    /**
     * Create task.
     *
     * @return mixed
     */
    protected function createTask()
    {
        return factory(App\Task::class)->make(['user_id' => 1]);
    }

    /**
     * Convert task to array.
     *
     * @param $task
     *
     * @return array
     */
    protected function convertTaskToArray($task)
    {
        //        return $task->toArray();
        return [
            'name'     => $task['name'],
            'done'     => (bool) $task['done'],
            'priority' => (int) $task['priority'],
            'user_id'  => (int) $task['user_id'],

        ];
    }

    /**
     * Create and persist task on database.
     *
     * @return mixed
     */
    protected function createAndPersistTask()
    {
        return factory(App\Task::class)->create(['user_id' => 1]);
    }

    /**
     * @group ok
     */
    public function testUserNotAuthenticated()
    {
        //        $this->json('GET', $this->uri)->dump();
        $this->json('GET', $this->uri)
            ->assertResponseStatus(401);
    }

    //NOT AUTHORIZED: $this->assertEquals(301, $response->status());

    protected function login()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user, 'api');

//        return $this;
    }

    /**
     * Test Retrieve all tasks.
     *
     * @group ok
     *
     * @return void
     */
    public function testRetrieveAllTasks()
    {
        //Seed database
        $this->seedDatabaseWithTasks();
//        $tasks = factory(App\Task::class,5)->create();

//      dd($tasks);
//        dd($this->json('GET',$this->uri)->seeJson());
//        dd($this->json('GET', $this->uri)->dump());

//        $user = factory(App\User::class)->create();

        $this->login();
        $this->json('GET', $this->uri)
             ->seeJsonStructure([
//
             'propietari', 'total', 'per_page', 'current_page', 'last_page', 'next_page_url', 'prev_page_url',
                 'data' => [
                     '*' => [
                        'name', 'done', 'priority',
                     ],
                 ],
            ])
            ->assertEquals(
                self::DEFAULT_NUMBER_OF_TASKS,
                count($this->decodeResponseJson()['data'])
            );
//        dd($this->decodeResponseJson());
    }

    /**
     * Test Retrieve one task.
     *
     * @group ok
     *
     * @return void
     */
    public function testRetrieveOneTask()
    {
        //Create task in database
        $task = $this->createAndPersistTask();
        $this->login();
        $this->json('GET', $this->uri.'/'.$task->id)
            ->seeJsonStructure(
                ['name', 'done', 'priority'])
//DONE @see Controller.transform
//  Needs Transformers to work: convert string to booelan and string to integer
            ->seeJsonContains([
                'name'     => $task->name,
                'done'     => $task->done,
                'priority' => $task->priority,
//                "created_at" => $task->created_at,
//                "updated_at" => $task->updated_at,
            ]);
    }

    /**
     * Test Create new task.
     *
     * @group ok
     *
     * @return void
     */
    public function testCreateNewTask()
    {
        $task = $this->createTask();
//        dd($this->convertTaskToArray($task));
        $this->login();
        $this->json('POST', $this->uri, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'created' => true,
            ])
            ->seeInDatabase('tasks', $atask);
//            ->dump();
    }

    /**
     * Test update existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testUpdateExistingTask()
    {
        $task = $this->createAndPersistTask();
        $this->login();
        $task->done = !$task->done;
        $task->name = 'New task name';
        $this->json('PUT', $this->uri.'/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'updated' => true,
            ])
            ->seeInDatabase('tasks', $atask);
    }

    /**
     * Test delete existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testDeleteExistingTask()
    {
        $task = $this->createAndPersistTask();
        $this->login();
        $this->json('DELETE', $this->uri.'/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'deleted' => true,
            ])
            ->notSeeInDatabase('tasks', $atask);
    }

    /**
     * Test not exists.
     *
     * @param $http_method
     */
    protected function atestNotExists($http_method)
    {
        $this->login();
        $this->json($http_method, $this->uri.'/99999999')
            ->seeJson([
                'status' => 404,
            ])
            ->assertEquals(404, $this->response->status());
    }

    /**
     * Test get not existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testGetNotExistingTask()
    {
        $this->atestNotExists('GET');
    }

    /**
     * Test delete not existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testUpdateNotExistingTask()
    {
        $this->atestNotExists('PUT');
    }

    /**
     * Test delete not existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testDeleteNotExistingTask()
    {
        $this->atestNotExists('DELETE');
    }

    /**
     * Test pagination.
     *
     * @return void
     */
    public function testPagination()
    {
        //TODO
    }

    //TODO: Test validation

    /**
     * Test name is required and done is set to false and priority to 1.
     *
     * @return void
     */
    public function testNameIsRequiredAndDefaultValues()
    {
        //TODO
    }

    /**
     * Test priority has to be an integer.
     *
     * @group ok
     *
     * @return void
     */
    public function testPriorityHasToBeAnInteger()
    {
        $task = $this->createAndPersistTask();
        $this->login();

        $this->json('GET', $this->uri.'/'.$task->id);
        $pri = $this->decodeResponseJson()['priority'];

        $this->assertInternalType('int', $pri);
    }

    /**
     * Test done has to be a boolean.
     *
     * @group ok
     *
     * @return void
     */
    public function testDoneHasToBeBoolean()
    {
        $task = $this->createAndPersistTask();
        $this->login();

        $this->json('GET', $this->uri.'/'.$task->id);
        $done = $this->decodeResponseJson()['done'];
//        $this->assertInternalType("int",$done);
        $this->assertInternalType('boolean', $done);
    }
}
