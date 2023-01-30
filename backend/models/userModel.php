
<?php

require_once './backend/config/database.php';

class UserModel 
{
         //param de BDD
         public $conn;

    public function __construct(
    //propriétés de Users
    private ?int $user_id = null,
    private ?string $user_email = null,
    private ?string $user_role = null,
    private ?string $user_password = null,
    private ?int $user_phone = null,
    private ?bool $user_gender = null,
    )
    {}

    public function __get($name)
    {
        return match($name){
            "user_id"=>$this->user_id,
            "user_email" => $this->user_email,
            "user_role" => $this->user_role,
            "user_password" => '********',
            "user_phone" => $this->user_phone,
            "user_gender" => (bool) $this->user_gender,
            default =>null
        };
    }

    public function __set($name, $value)
    {
        return match($name){
            "user_id"=>$this->user_id = $value,
            "user_email" => $this->user_email = $value,
            "user_role" => $this->user_role = $value,
            "user_password" => $this->user_password = password_hash($value, PASSWORD_BCRYPT),
            "user_phone" => $this->user_phone = $value,
            "user_gender" => (bool) $this->user_gender = $value,
            default => $this->$name = $value
        };
    }

    public function getDbUsers()
    {
        $req = "SELECT * FROM users";

        $stmt = $this->conn->prepare($req);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
}