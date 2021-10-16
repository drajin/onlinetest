<?php

namespace app\classes;
use PDO;

class Question extends QueryBuilder
{

    protected static string $table_name = 'questions';


    //TODO find_by id function repeating
    public function find_by_question_id($id, $table)
    {
        $sql = "SELECT * FROM {$table} WHERE question_id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function create_or_update_question($data) {
        if(!$data->question_id) {
            return $this->create_question($data);
        } else {
            return $this->update_question($data);
        };
    }

    //create quiz
    private function create_question($data) {
        $question = $data->question;
        $display = $data->display;

        // inserts question in DB
        try {
            $stmt = self::$db->prepare('INSERT INTO questions VALUES(?, ?, ?)');
            $stmt->bindParam(':question_text', $question);
            $stmt->bindParam(':display', $display);
            //return $stmt->execute([NULL, $question]);
            $stmt->execute([NULL, $question, $display]);
            $this->question_id = self::$db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        //create answer
        if(Answer::create_answer($data, $this->question_id)) {
            self::$session->message('Quiz question added successfully', 'success');
            return 'true';
        }


    }

    private function update_question($data)
    {
        $question_id = $data->question_id;
        $question = $data->question;
        $display = $data->display;

        //update question
        try {
            $stmt = self::$db->prepare("UPDATE questions SET question_text=:question_text, display=:display WHERE id=:id");
            $stmt->bindparam(":question_text", $question);
            $stmt->bindparam(":display", $display);
            $stmt->bindparam(":id", $question_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        //update answer
        if(Answer::update_answer($data)) {
            self::$session->message('Quiz updated successfully', 'success');
            return 'true';
        }



    }



}