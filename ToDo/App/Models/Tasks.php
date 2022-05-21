<?php

class Tasks {
    private string $title;
    private string $description;

    public function __construct(string $title, string $description) {
        $this->title = $title;
        $this->description = $description;
    }

    public function save(string $email):void {
        $stmt = (new Database)->get()->query("SELECT id FROM users WHERE email='$email'");
        $userId = $stmt->fetch()['id'];

        $sqlSave = "INSERT INTO tasks (user_id, title, description) VALUES ('$userId', '$this->title','$this->description')";
        (new Database)->get()->exec($sqlSave);
    }

    public static function output($email):void {
        $stmtUser = (new Database)->get()->query("SELECT id FROM users WHERE email='$email'");
        $userId = $stmtUser->fetch()['id'];

        $stmtTasks = (new Database)->get()->query("SELECT title, description FROM tasks WHERE user_id='$userId'");
        $tasks = $stmtTasks->fetchAll();
        $tasksCount = $stmtTasks->rowCount();

        for ($i = 0; $i < $tasksCount; $i++) {
            if ($tasksCount <= 0) {break;}
            echo '
            <div class="tasks">
                <div class="tasks-title">
                    <h3>'. $tasks[$i]['title'] .'</h3>
                </div>
                <div class="description">
                    <h3>'. $tasks[$i]["description"] .'</h3>
                </div>
            </div>';
        }
    }
}