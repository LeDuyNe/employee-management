<?php
class Employee {
    private $conn;
    private $table_name = "employees";

    public $id;
    public $employee_code;
    public $full_name;
    public $phone_number;
    public $email;
    public $introduction;
    public $hire_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
            SET
                employee_code = :employee_code,
                full_name = :full_name,
                phone_number = :phone_number,
                email = :email,
                introduction = :introduction,
                hire_date = :hire_date";

        $stmt = $this->conn->prepare($query);

        $this->employee_code = htmlspecialchars(strip_tags($this->employee_code));
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->introduction = htmlspecialchars(strip_tags($this->introduction));
        $this->hire_date = htmlspecialchars(strip_tags($this->hire_date));

        $stmt->bindParam(":employee_code", $this->employee_code);
        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":phone_number", $this->phone_number);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":introduction", $this->introduction);
        $stmt->bindParam(":hire_date", $this->hire_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
            SET
                employee_code = :employee_code,
                full_name = :full_name,
                phone_number = :phone_number,
                email = :email,
                introduction = :introduction,
                hire_date = :hire_date
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->employee_code = htmlspecialchars(strip_tags($this->employee_code));
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->introduction = htmlspecialchars(strip_tags($this->introduction));
        $this->hire_date = htmlspecialchars(strip_tags($this->hire_date));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":employee_code", $this->employee_code);
        $stmt->bindParam(":full_name", $this->full_name);
        $stmt->bindParam(":phone_number", $this->phone_number);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":introduction", $this->introduction);
        $stmt->bindParam(":hire_date", $this->hire_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
