<?php

class CommentModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

