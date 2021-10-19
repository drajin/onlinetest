<?php


    namespace onlinetest\classes;
    use PDO;
    use PDOException;


class Answer extends QueryBuilder
{
    public static array $correct = [];
    public static array $answers = [];
    protected static string $table_name = 'answers';

    public static function create_answer($data, $question_id) {

        //extracts checkbox values
        foreach($data->correct as $key) {
            self::$correct[] = $key;
        }

        //makes answers array with answers, question id and correct values
        //adds answer text and question ids to array
        foreach($data->answers as $key => $answer_text) {
            self::$answers[] = [
                "answer_text" => $answer_text,
                "question_id" => $question_id,
            ];
            //adds correct answers values
            foreach(self::$correct as $value) {
                if($key == $value) {
                    self::$answers[$key]['correct'] = true;
                }
                // adds correct value on false
                isset(self::$answers[$key]['correct']) ? : self::$answers[$key]['correct'] = false;
            }
        }

        foreach(self::$answers as $answer) {
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
        return true;
    }

    public static function update_answer($data) {

        //extracts checkbox values
        foreach($data->correct as $key) {
            self::$correct[] = $key;
        }

        //  return $correct;

        foreach($data->answers as $key => $answer) {
            self::$answers[] = [
                "id" => $answer->id,
                "question_id" => $data->question_id,
                "answer_text" => $answer->answer_text,
                "key" => $key,
            ];

//        makes answers array with answers, question id and correct values
//        adds answer text and question ids to array
//
//            adds correct answers values
            foreach(self::$correct as $value) {
                if($key == $value) {
                    self::$answers[$key]['correct'] = true;

                }
                // adds correct value on false
                isset(self::$answers[$key]['correct']) ? : self::$answers[$key]['correct'] = false;
            }
        }


        foreach(self::$answers as $answer) {
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
        return true;
    }

}