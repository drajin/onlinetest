<?php


class Quiz extends QueryBuilder
{

    // ide u question answers
    public  function delete_answers($question_id, $table)
    {
        $sql = "DELETE FROM {$table} WHERE question_id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$question_id]);
    }

    //ide u question answers
    //TODO find_by id function repeating
    public function find_by_question_id($id, $table)
    {
        $sql = "SELECT * FROM {$table} WHERE question_id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //ide u question answers
    public function create_or_update_question($data) {
        if(!$data->question_id) {
            return $this->create_question($data);
        } else {
            return $this->update_question($data);
        };
    }
    //ide u question answers
    private function create_question($data) {
        $question = $data->question;
        $display = $data->display;
        $correct = [];
        $answers = [];

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


        //extracts checkbox values
        foreach($data->correct as $key) {
            $correct[] = $key;
        }


        //makes answers array with answers, question id and correct values
        //adds answer text and question ids to array
        foreach($data->answers as $key => $answer_text) {
            $answers[] = [
                "answer_text" => $answer_text,
                "question_id" => $this->question_id,
            ];
            //adds correct answers values
            foreach($correct as $value) {
                if($key == $value) {
                    $answers[$key]['correct'] = true;
                }
                // adds correct value on false
                isset($answers[$key]['correct']) ? : $answers[$key]['correct'] = false;
            }
        }

        foreach($answers as $answer) {
            try {
                $stmt = self::$db->prepare('INSERT INTO answers VALUES(?, ?, ?, ?)');
                $stmt->bindParam(':question_id', $answer['question_id']);
                $stmt->bindParam(':answer_text', $answer['answer_text']);
                $stmt->bindParam(':correct', $answer['correct']);
                $stmt->execute([NULL, $answer['question_id'],$answer['answer_text'], $answer['correct'] ]);
                self::$session->message('Quiz added successfully', 'success');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        self::$session->message('Quiz added successfully', 'success');
//        redirect_to(URLROOT .'/admin/questions/index.php');


        return 'true';
    }

    //ide u question answers
    private function update_question($data)
    {
        $question_id = $data->question_id;
        $question = $data->question;
        $display = $data->display;
        $correct = [];
        $answers = [];

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


        //extracts checkbox values
        foreach($data->correct as $key) {
            $correct[] = $key;
        }

        //  return $correct;

        foreach($data->answers as $key => $answer) {
            $answers[] = [
                "id" => $answer->id,
                "question_id" => $question_id,
                "answer_text" => $answer->answer_text,
                "key" => $key,
            ];

//        makes answers array with answers, question id and correct values
//        adds answer text and question ids to array
//
//            adds correct answers values
            foreach($correct as $value) {
                if($key == $value) {
                    $answers[$key]['correct'] = true;

                }
                // adds correct value on false
                isset($answers[$key]['correct']) ? : $answers[$key]['correct'] = false;
            }
        }


        foreach($answers as $answer) {
            try {
                $stmt = self::$db->prepare("UPDATE answers SET question_id=:question_id, answer_text=:answer_text, correct=:correct WHERE id=:id");
                $stmt->bindparam(":question_id", $answer['question_id']);
                $stmt->bindparam(":answer_text", $answer['answer_text']);
                $stmt->bindparam(":correct", $answer['correct']);
                $stmt->bindparam(":id", $answer['id']);
                $stmt->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        self::$session->message('Quiz updated successfully', 'success');

        return 'true';

    }



}