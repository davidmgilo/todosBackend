<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Permission\Models\Role;

class TaskControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testAuthorizedIndex()
    {
        $user = $this->login();
        Role::create(['name' => 'admin']);
        $user->assignRole('admin');

        $this->get('tasks');

        $this->assertResponseOk();
    }

    /*
     * @group failing
     */
    public function testNotAuthorizedIndex()
    {
        $this->login();

        $this->get('tasks')->dump();

        $this->assertResponseStatus(403);
    }

    protected function login()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user);

        return $user;

    }
}
