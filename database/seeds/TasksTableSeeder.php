<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function($user) {
            $user->tasks()->saveMany(
                factory(App\Task::class, 5)->create(["user_id" => $user->id])
            );
        });
    }
}
