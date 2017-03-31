<?php

use Illuminate\Database\Seeder;

/**
 * Class TasksTableSeeder.
 */
class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Davidmgilo\TodosBackend\User::class, 50)->create()->each(function ($user) {
            $user->tasks()->saveMany(
                factory(\Davidmgilo\TodosBackend\Task::class, 5)->create(['user_id' => $user->id])
            );
        });
    }
}
