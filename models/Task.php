<?php 

class Task extends Database{
    // Atributos de la clase Task
    private $task_name;
    private $task_description;
    private $task_date;
    private $created_at;

    // Metodo Constructor de la clase Task
    public function __construct($task_name, $task_description, $task_date){
        parent::__construct();
        $this->task_name = $task_name;
        $this->task_description = $task_description;
        $this->task_date = $task_date;
        $this->created_at = date('Y-m-d', strtotime('now'));
    }

    // Metodo estatico(Se puede usar sin instanciar) que devuelve una instancia de la misma clase
    // a traves de un array asociativo con los datos especificados por el constructor
    static function newTask($data){
        $task = new Task($data['taskName'], $data['taskDescription'], $data['taskDate']);
        return $task;
    }

    // Obtiene todas las tareas pendientes
    static function getAllTasks($user_id){
        try{
            $database = new Database();
            $pdo = $database->connect();
            $sql = 'SELECT * FROM tasks WHERE user_id = :user_id ORDER BY task_date';
            $query = $pdo->prepare($sql);
            $query->execute([':user_id'=>$user_id]);
            $tasks = $query->fetchAll();
            $pdo = null;
            return $tasks;
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
        }
    }

    // Obtiene todas las tareas correspondientes a la fecha del dia actual
    static function getTodayTasks($user_id){
        try{
            $database = new Database();
            $pdo = $database->connect();
            $sql = 'SELECT * FROM tasks WHERE user_id = :user_id AND task_date = :today';
            $query = $pdo->prepare($sql);
            $query->execute([':user_id'=>$user_id, ':today'=>date('Y-m-d', strtotime('now'))]);
            $tasks = $query->fetchAll();
            $pdo = null;
            return $tasks;
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
        }
    }
    // Obtiene todas las tareas pendientes a partir del dia siguiente al actual(mañana)
    static function getNextTasks($user_id){
        try{
            $database = new Database();
            $pdo = $database->connect();
            $sql = 'SELECT * FROM tasks WHERE user_id = :user_id AND task_date > :today ORDER BY task_date';
            $query = $pdo->prepare($sql);
            $query->execute([':user_id'=>$user_id, 'today'=>date('Y-m-d', strtotime('now'))]);
            $tasks = $query->fetchAll();
            $pdo = null;
            return $tasks;
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
        }
    }

    // Elimina un registro correspondiente a una tarea pendiente o realizada
    static function deleteTask($task_id){
        try{
            $database = new Database();
            $pdo = $database->connect();
            $sql = 'DELETE FROM tasks WHERE id = :task_id';
            $query = $pdo->prepare($sql);
            $query->execute([':task_id'=>$task_id]);
            $pdo = null;
            return true;
        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
        }
    }

    // Crea una nueva tarea a partir de los atributos del objeto mismo
    public function createTask(){
        try {
            $pdo = $this->connect();
            $sql = "INSERT INTO tasks(task_name, task_description, task_date, created_at, user_id) VALUES(:task_name, :task_description, :task_date, :created_at, :user_id)";
            $query = $pdo->prepare($sql);
            $query->execute([':task_name'=>$this->getTaskName(), ':task_description'=>$this->getTaskDescription(), ':task_date'=>$this->getTaskDate(), ':created_at'=>$this->getCreatedAt(), ':user_id'=>User::getUserId($_SESSION['user'])]);
            $pdo = null;
            return true;
        } catch (PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
        }
    }

    // Actualiza una tarea a partir de los atributos del objeto mismo
    public function updateTask($taskId) {
        try {
            $pdo = $this->connect();
            $sql = "UPDATE tasks SET task_name = :task_name, task_description = :task_description, task_date = :task_date, created_at = :created_at WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->execute([':task_name'=>$this->getTaskName(), ':task_description'=>$this->getTaskDescription(), ':task_date'=>$this->getTaskDate(), ':created_at'=>$this->getCreatedAt(), ':id'=>$taskId]);
            $pdo = null;
            return true;
        } catch (PDOException $e){
            echo 'Error: '.$e->getMessage();
            return false;
        }
    }

    // Getters and Setters

    public function setTaskName($task_name){
        $this->task_name = $task_name;
    }

    public function getTaskName(){
        return $this->task_name;
    }

    public function setTaskDescription($task_description){
        $this->task_description = $task_description;
    }

    public function getTaskDescription(){
        return $this->task_description;
    }

    public function setTaskDate($task_date){
        $this->task_date = $task_date;
    }

    public function getTaskDate(){
        return $this->task_date;
    }

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

}


?>