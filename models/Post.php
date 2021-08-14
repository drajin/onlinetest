<?php


namespace app\models;
use app\core\Database;
use app\core\Application;
use app\core\Session;


class Post extends Model
{

    public string $id;
    public string $title;
    public string $body;
    public string $title_err;
    public string $body_err;


    public function getPosts()
    {
        Application::$app->db->query('SELECT *,
                                posts.id as postId,
                                users.id as userId,
                                posts.created_at as postCreated,
                                users.created_at as userCreated
                                FROM posts
                                INNER JOIN users
                                ON posts.user_id = users.id
                                ORDER BY posts.created_at DESC
                                ');

        //returns more then one row
        return Application::$app->db->resultSet();

    }

    public function create()
    {
        Application::$app->db->query('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
        Application::$app->db->bind('user_id', $_SESSION['user_id']);
        Application::$app->db->bind(':title', $this->title);
        Application::$app->db->bind(':body', $this->body);


        if(Application::$app->db->execute()) {
            return true;
        } else {
            return false;
        }


    }


    public function edit()
    {
        Application::$app->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        Application::$app->db->bind(':title', $this->title);
        Application::$app->db->bind(':body', $this->body);
        Application::$app->db->bind(':id', $this->id);


        if(Application::$app->db->execute()) {
            return true;
        } else {
            return false;
        }


    }

    public function validatePost()
    {
        if(!isset($this->title) || trim($this->title) === '') {
            $this->title_err = 'Please add a title';
        }
        // Validate Body
        if(!isset($this->body) || trim($this->body) === '') {
            $this->body_err = 'Post can\'t be empty.';
        } elseif(str_word_count($this->body) < 2) {
            $this->body_err = 'Come on, write at least one sentence!';
        }

        // Make sure there are no errors
        if(empty($this->title_err) && empty($this->body_err)) {
            return true;
        } else {
            return false;
        }

    }

    public function delete($id)
    {
        Application::$app->db->query('DELETE FROM posts WHERE id = :id');
        Application::$app->db->bind(':id', $id);

        if(Application::$app->db->execute()) {
            return true;
        } else {
            return false;
        }

    }








}