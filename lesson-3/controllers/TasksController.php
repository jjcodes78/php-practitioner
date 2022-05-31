<?php

class TasksController
{
    public function index()
    {
        $pdo = DbConnector::make();

        $sql = "SELECT * FROM tasks ORDER BY id DESC ;";
        $statement = $pdo->query($sql);

        $tasks = $statement->fetchAll(PDO::FETCH_CLASS);

        return view('index', [
            'tasks' => $tasks
        ]);
    }

    public function store()
    {
        // conexao com o banco
        $pdo = DbConnector::make();

        // criar uma instrucao SQL pra inserir o dado no banco
        $sql = "INSERT INTO tasks ('task') VALUES (?)";
        $statement = $pdo->prepare($sql);
        $statement->execute([$_POST['task']]);

        Redirect::to('/');
    }
}
