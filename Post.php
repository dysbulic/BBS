<?php
require_once( 'db.php' );
require_once( 'User.php' );

class Thread {
  public function getCount() {
    return 0;
  }

  public function getUnreadCount() {
    return 0;
  }
}

class Post {
  protected $id;
  protected $title;
  protected $content;
  protected $author;

  public function __construct( $title = '',
                               $content = '',
                               $author = '',
                               $id = null ) {
    $this->title = $title;
    $this->content = $content;
    $this->setAuthor( $author );
    $this->id = $id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }
  
  public function getContent() {
    return $this->content;
  }

  public function setContent( $content ) {
    $this->content = $content;
  }

  public function getAuthor() {
    return $this->author;
  }

  public function setAuthor( $author ) {
    if( $author instanceof User ) {
      $this->author = $author;
    } elseif( is_string( $author ) ) {
      $this->author = User::fromUsername( $author );
    } else {
      throw new Exception( 'Unknown argument type' );
    }
  }

  public function getThread() {
    return new Thread();
  }

  static public function fromId($id) {
    $result = mysql_magic( 'select id, title, content, author, creation_date from posts where id = ?', $id );
    $topic = new Post( $result['title'],
                       $result['content'],
                       $result['author'],
                       $result['author'] );
    $topic->setIsNew( false );
    return $topic;
  }
  
  static public function getTopics() {
    $result = mysql_magic( 'select id, title, content, author, creation_date from posts where parent is NULL order by creation_date' );
    $topics = array();
    foreach( $result as $row ) {
      $topic = new Post( $row['title'],
                         $row['content'],
                         $row['author'],
                         $row['id'] );
      array_push( $topics, $topic );
    }
    return $topics;
  }

  public function save() {
    if(is_null($this->id)) {
      $result = mysql_magic( 'insert into posts (title, content, author) values (?, ?, ?)',
                             $this->title, $this->content, $this->author->getUsername() );
      $this->id = $result;
    } else {
      $result = mysql_magic( 'update posts set title = ?, content = ?, author = ? where id = ?',
                             $this->title, $this->content, $this->author->getUsername(), $this->id );
    }
  }
}
