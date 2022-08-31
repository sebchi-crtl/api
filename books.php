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
    class Books extends Comments{

        public function __construct($db) {
            parent::__construct($db);
        }

    //       public function books(){
    //     $books = Book::with('author')->withCount('comment')->oldest()->get();
    //     return response()->json($books, 200);
    // }

        public function readBooks($db)
        {

            $url = "https://anapioficeandfire.com/api/books?page=1&pageSize=1000";
            //Get curl
            $curl = new Helper();
            $data = $curl->get_curl($url);
            // Comment extension
            $comm =  new Comments($db);
            $result = $comm->readCommentGroupedByBook();

            $count = 1;

            //Combine the comment count from database and books from api
            $combined = array();
            foreach ($data as $arr) {
                $comb = array(
                    'ID' => $count++, 
                    'url' => $arr["url"],
                    'Name' => $arr['name'], 
                    'CommentCount' => 0,
                    'authors' => $arr["authors"]
                );
                foreach ($result as $arr2) {
                    if ($arr2['MovieName'] == $arr['name']) {
                        $comb['CommentCount'] = $arr2['GroupBookName'];
                        break;
                    }
                }
                $combined[] = $comb;
            }echo json_encode($combined);
            
        }
        
    }
    
    $objDb = new Books($db);
    $objDb->readBooks($db);
