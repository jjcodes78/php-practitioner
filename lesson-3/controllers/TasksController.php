<?php

namespace App\Controllers;

use App\Core\Http\Request;
use App\Core\Http\Redirect;
use App\Models\Task;

class TasksController
{
    public function index()
    {

        switch (Request::queryString('filter')) {
            case 'active':
                $tasks = Task::where(['completed' => "0"]);
                break;
            case 'completed':
                $tasks = Task::where(['completed' => "1"]);
                break;
            default:
                $tasks = Task::all();
        }

        return view('index', [
            'tasks' => $tasks
        ]);
    }

    public function store()
    {
        Task::save([
            'task' => Request::getPostValue('task')
        ]);

        Redirect::to('/');
    }

    public function update()
    {
        Task::update([
            'id' => Request::getPostValue('id')
        ], [
            'completed' => intval(! Request::getPostValue('completed'))
        ]);

        Redirect::to('/');
    }

    public function destroy()
    {
        $id = Request::getPostValue('id');
        Task::delete(["id" => $id]);

        Redirect::to("/");
    }

    public function destroyCompleted()
    {
        Task::delete(["completed" => true]);

        Redirect::to("/");
    }
}
