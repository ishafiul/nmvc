<?php
class Post{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function getPosts(){
        $this->db->query("SELECT *,post.id as postId,users.id AS user_id FROM post INNER join users on post.userid = users.id order by post.created_at desc ");
        $results = $this->db->resultSet();
        return $results;
    }
    public function getComments($id){
        $this->db->query("SELECT *,comments.id as commentId,users.id as userID  FROM comments join users on comments.user_id = users.id where comments.post_id=:id");
        $this->db->bind(':id',$id);
        $results = $this->db->resultSet();
        return $results;
    }
    public function getPostsById($id){
        $this->db->query("SELECT * FROM post  WHERE id =:id");
        $this->db->bind(':id',$id);
        $results = $this->db->single();
        return $results;
    }
    public function addComments($data){
        $this->db->query("INSERT INTO comments (user_id, post_id, comment) VALUES(:user_id, :post_id, :comment)");
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':post_id',$data['post_id']);
        $this->db->bind(':comment',$data['comments']);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
    public function addPost($data){
        $this->db->query("INSERT INTO post (userid, title, description) VALUES(:user_id, :title, :details)");
        $this->db->bind(':user_id',$_SESSION['user_id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':details',$data['details']);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
    public function editPost($data){
        $this->db->query("UPDATE post SET userid = :user_id, title= :title , description =  :details where id = :id");
        $this->db->bind(':user_id',$data['post']->userid);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':details',$data['details']);
        $this->db->bind(':id',$data['post']->id);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
    public function deletePost($id){
        $this->db->query("DELETE FROM post where id = :id");
        $this->db->query("DELETE FROM comments where post_id = :id");
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function deleteComment($id){
        $this->db->query("DELETE FROM comments where id = :id");
        $this->db->bind(':id',$id);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function getCommentsById($id){
        $this->db->query("SELECT * FROM comments where id = :id");
        $this->db->bind(':id',$id);
        $results = $this->db->single();
        return $results;
    }
    public function editComment($data){
        $this->db->query("UPDATE comments SET comment=:comment where id = :id");

        $this->db->bind(':comment',$data['comment']);
        $this->db->bind(':id',$data['id']);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}