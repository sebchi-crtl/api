<?php
  class Comments {
    // DB Stuff
    private $conn;
    private $table = 'comments';

    // Properties
    public $id;
    public $Text;

    public $movieName;
    public $created_at;

    // Constructor with DB
    function __construct($db) {
       $this->conn = $db;
    }

    // Get comments
    public function reads() {
      // Create query
      $query = 'SELECT *
      FROM
        ' . $this->table . '
      ORDER BY
        created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    // Get comments Group By Books
    public function readCommentGroupedByBook() {
      // Create query
      $query = 'SELECT *, COUNT(*) as GroupBookName
      FROM
        ' . $this->table . '
      Group BY
        CommentsId';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }


    public function read_single(){
        // Create query
        $query = 'SELECT
            CommentsId,
            Text,
            MovieName
            FROM
            ' . $this->table . '
        WHERE id = ?
        LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->id = $row['CommentsID'];
        $this->Text = $row['Text'];
        $this->movieName = $row['MovieName'];
    }

    // Create Category
    public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      Text = :text';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->Text = htmlspecialchars(strip_tags($this->Text));

  // Bind data
  $stmt-> bindParam(':name', $this->Text);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $stmt.\n", $stmt->error);

  return false;
    }
}
  