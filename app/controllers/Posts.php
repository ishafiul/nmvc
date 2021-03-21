<?php
class Posts extends Controller{
   public function __construct(){
       /* if(!isLoggedIn()){
            redirect('users/login');
        }*/
        $this->postModel =$this->model('Post');
        $this->userModel =$this->model('User');
    }
   public function index(){
       //get posts
       $posts = $this->postModel->getPosts();
       $data =[
           'page_title' => 'All Post',
           'description' => 'All post here ',
           'posts'=>$posts,
       ];
       $this->view('posts/index',$data);
   }
   public function show($id){
       //get post
       $posts = $this->postModel->getPostsById($id);
       $user = $this->userModel->getUserById($posts->userid);
       $comments = $this->postModel->getComments($id);
       $data =[
           'page_title' => 'Post',
           'description' => 'All post here ',
           'post'=>$posts,
           'user'=>$user,
           'comments'=>$comments,
       ];
       $this->view('posts/show', $data);
   }
/*   public function addComment($id){
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
           flush('comment','submit');
           // Sanitize POST data
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           $data =[
               'comments'=>trim($_POST['name']),
               'comments_err'=>'',
               'user_id'=>$_SESSION['user_id'],
               'post_id'=>$id
           ];
           if(empty($data['comments'])){
               $data['comments_err'] = 'Please enter comment';
           }
           if(empty($data['email_err']) ){
              if ( $this->postModel->addComments($data)){
                  flush('comment','ok');
              }
           }
           else{
               $this->view('posts/show/'.$id, $data);
           }

       }
   }*/
    public function addcomments($id){
        $data =[
            'post_id'=>$id
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //flush('comment','submit');
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'comments'=>trim($_POST['comment']),
                'comments_err'=>'',
                'user_id'=>$_SESSION['user_id'],
                'post_id'=>$id
            ];
            if(empty($data['comments'])){
                $data['comments_err'] = 'Please enter comment';
            }
            if(empty($data['email_err']) ){
                if ( $this->postModel->addComments($data)){
                    redirect('posts/show/'.$id);
                }
            }

        }
        else{
            $this->view('posts/addcomments',$data);
        }
    }
    public function editcomments($id){
        $comment = $this->postModel->getCommentsById($id);
        $data =[
            'comments'=>$comment
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //flush('comment','submit');
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'id'=>$id,
                'comment'=>trim($_POST['comment'])
            ];

            if ($this->postModel->editComment($data)){
                redirect('posts');
            }

            }

            $this->view('posts/editcomments',$data);

    }
    public function addpost(){


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'title' => trim($_POST['title']),
                'details' => trim($_POST['details']),
                'title_err' => '',
                'details_err' => '',
            ];
            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['details'])){
                $data['details_err'] = 'Please enter blog description ';
            }
            if(empty($data['title_err']) && empty($data['details_err'])){
                if($this->postModel->addPost($data)){
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            }
        }
        $this->view('posts/addpost');
    }
    public function editpost($id){
        $posts = $this->postModel->getPostsById($id);
        $data =[
            'post' => $posts,
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'title' => trim($_POST['title']),
                'details' => trim($_POST['details']),
                'post' => $posts,
                'title_err' => '',
                'details_err' => '',
            ];
            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['details'])){
                $data['details_err'] = 'Please enter blog description ';
            }
            if(empty($data['title_err']) && empty($data['details_err'])){
                if($this->postModel->editPost($data)){
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            }
        }
        $this->view('posts/editpost',$data);
    }
    public function deletepost($id){
        $this->postModel->deletePost($id);
        redirect('posts');
    }
    public function deletecomment($id){
        $this->postModel->deleteComment($id);
        redirect('posts');
    }

}
