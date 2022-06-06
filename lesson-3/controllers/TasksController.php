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
                $tasks = Task::on()->where(['completed' => "0"]);
                break;
            case 'completed':
                $tasks = Task::on()->where(['completed' => "1"]);
                break;
            default:
                $tasks = Task::on()->all();
        }

        return view('index', [
            'tasks' => $tasks
        ]);
    }

    public function store()
    {
        Task::on()->save([
            'task' => Request::getPostValue('task')
        ]);

        Redirect::to('/');
    }

    public function update()
    {
        Task::on()->update([
            'id' => Request::getPostValue('id')
        ], [
            'completed' => intval(! Request::getPostValue('completed'))
        ]);

        Redirect::to('/');
    }

    public function destroy()
    {
        $id = Request::getPostValue('id');
        Task::on()->delete(["id" => $id]);

        Redirect::to("/");
    }

    public function destroyCompleted()
    {
        Task::on()->delete(["completed" => true]);

        Redirect::to("/");
    }
}
