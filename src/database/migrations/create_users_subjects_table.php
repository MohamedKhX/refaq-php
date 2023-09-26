<?php

namespace src\database\migrations;

class create_users_subjects_table extends Migration
{

    protected function setTableName(): string
    {
        return "users_subjects";
    }

    public function create(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
                id INT PRIMARY KEY,
                subject_code VARCHAR(255),
                user_id INT,
                FOREIGN KEY (subject_code) REFERENCES subjects (code),
                FOREIGN KEY (user_id) REFERENCES users (id),
                CONSTRAINT uc_subject_user UNIQUE (subject_code, user_id)
            )";
        $this->database->exec($sql);
    }

    public function insertData()
    {
        // TODO: Implement insertData() method.
    }

    public function drop()
    {
        // TODO: Implement drop() method.
    }
}