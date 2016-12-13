<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class TasksApiTest.
 */
class UsersTasksApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * RESOURCE URL ON API.
     *
     * @var string
     */
    protected $uri = '/api/v1/user';
    protected $uri2= '/task';

    /**
     * Default number of tasks created in database.
     */
    const DEFAULT_NUMBER_OF_USERS = 5;
    const DEFAULT_NUMBER_OF_TASKS = 5;

//    /**
//     * Seed database with tasks.
//     *
//     * @param int $numberOfTasks to create
//     */
//    protected function seedDatabaseWithTasks($numberOfUsers = self::DEFAULT_NUMBER_OF_USERS)
//    {
//        factory(App\User::class, $numberOfUsers)->create()->each(function ($user) {
//            $user->tasks()->saveMany(
//                factory(App\Task::class, self::DEFAULT_NUMBER_OF_TASKS)->create(['user_id' => $user->id])
//            );
//        });
//    }

    /**
     * Create task.
     *
     * @return mixed
     */
    protected function createTask($id)
    {
        return factory(App\Task::class)->make(['user_id' => $id]);
    }

    /**
     * Create user.
     *
     * @return mixed
     */
    protected function createUser()
    {
        return factory(App\User::class)->make();
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
            'id'       => (int) $task['id'],
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
    protected function createAndPersistTask($id)
    {
        return factory(App\Task::class)->create(['user_id' => $id]);
    }

    /**
     * Create and persist user with tasks on database.
     *
     * @return mixed
     */
    protected function createAndPersistUser()
    {
        return factory(App\User::class)->create();
    }


    /**
     * @group fail
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
     * Test Retrieve all tasks from a user.
     *
     * @group fail
     *
     * @return void
     */
    public function testRetrieveAllTasks()
    {
        $user = $this->createAndPersistUser();
        $this->createAndPersistTask($user->id);
        $this->createAndPersistTask($user->id);
        $this->createAndPersistTask($user->id);
        $this->createAndPersistTask($user->id);
        $this->createAndPersistTask($user->id);

        $this->login();
        $this->json('GET', $this->uri . '/'. $user->id . $this->uri2)
             ->seeJsonStructure([
//
             'propietari', 'total', 'per_page', 'current_page', 'last_page', 'next_page_url', 'prev_page_url',
                 'data' => [
                     '*' => [
                        'id', 'name', 'done', 'priority',
                     ],
                 ],
            ])
            ->assertEquals(
                5,
                count($this->decodeResponseJson()['data'])
            );
//        dd($this->decodeResponseJson());
    }

    /**
     * Test Retrieve one task.
     *
     * @group fail
     *
     * @return void
     */
    public function testRetrieveOneTask()
    {
        $user = $this->createAndPersistUser();
        $task = $this->createAndPersistTask($user->id);
        $this->login();
        $this->json('GET', $this->uri. '/'. $user->id . $this->uri2 .'/'.$task->id)
            ->seeJsonStructure(
                ['id', 'name', 'done', 'priority'])
            ->seeJsonContains([
                'id'       => $task->id,
                'name'     => $task->name,
                'done'     => $task->done,
                'priority' => $task->priority,

            ]);
    }

    /**
     * Test Create new task.
     *
     * @group fail
     *
     * @return void
     */
    public function testCreateNewTask()
    {
        $user = $this->createAndPersistUser();
        $task = $this->createTask($user->id);

//        dd($this->convertTaskToArray($task));
        $this->login();
        $this->json('POST', $this->uri . '/'. $user->id . $this->uri2, $atask = $this->convertTaskToArray($task))
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
