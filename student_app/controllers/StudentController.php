<?php

require_once "config/database.php";
require_once "models/Student.php";

class StudentController {
    public function index() {
        $database = new Database();
        $db = $database->connect();

        $student = new Student($db);
        $students = $student->getAllStudents();

        require_once "views/students.php";
    }
}