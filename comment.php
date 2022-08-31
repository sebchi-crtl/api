<?php
    // Headers
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    header('Content-Type: application/json;charset=utf-8');

    include_once 'config/ConnectDb.php';
    include_once 'model/comments/Comments.php';
    include_once 'config/Helper.php';

    $database = new ConnectDb();
    $db = $database->connect();
    class Comment extends Comments{

        public function __construct($db) {
            parent::__construct($db);
        }

    //       public function books(){
    //     $books = Book::with('author')->withCount('comment')->oldest()->get();
    //     return response()->json($books, 200);
    // }

        public function readComments($db)
        {

            // Comment extension
            $comm =  new Comments($db);
            $result = $comm->reads();

            $combs = array();
            foreach ($result as $arr2) {
                $comb = array(
                    'Id' => $arr2['CommentsId'],
                    'BookName' => $arr2['MovieName'],
                    'CommentText' => $arr2['Text'],
                    'DateCreated' => $arr2['created_at']
                );
                $combs[] = $comb;
            }
            echo json_encode($combs);
        }
        
    }
    
    $objDb = new Comment($db);
    $objDb->readComments($db);
