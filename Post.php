<?php
require_once( 'db.php' );
require_once( 'User.php' );

function countNodes( $root ) {
  $count = 1;
  foreach( $root->getReplies() as $child ) {
    $count = $count + $child->getThread()->getCount();
  }
  return $count;
}

class Thread {
  protected $root;

  public function __construct( $root ) {
    $this->root = $root;
  }

  public function getCount() {
    return countNodes( $this->root );
  }

  public function getUnreadCount() {
    return $this->getCount();
  }
}

function strip_tags_attributes($sSource, $aAllowedTags = array(), $aDisabledAttributes = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavaible', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragdrop', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterupdate', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmoveout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'))
    {
      if( empty($aDisabledAttributes ) )
       return strip_tags( $sSource, $aAllowedTags );
     return preg_replace('/<(.*?)>/ie', "'<' . preg_replace(array('/javascript:[^\"\']*/i', '/(" . implode('|', $aDisabledAttributes) . ")[ \\t\\n]*=[ \\t\\n]*[\"\'][^\"\']*[\"\']/i', '/\s+/'), array('', '', ' '), stripslashes('\\1')) . '>'", strip_tags( $sSource, $aAllowedTags ) );
    }

class Post {
  protected $id;
  protected $title;
  protected $content;
  protected $author;
  protected $parent;
  protected $creationTime;

  public function __construct( $title = '',
                               $content = '',
                               $author = '',
                               $id = null ) {
    $this->setTitle( $title );
    $this->setContent( $content );
    $this->setAuthor( $author );
    $this->id = $id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle( $title ) {
    $this->title = htmlspecialchars( $title );
  }
  
  public function getContent() {
    return $this->content;
  }

  public function setContent( $content ) {
    // From: 
    $this->content = strip_tags_attributes( $content, '<p><a><ol><li><ul><blockquote><pre><code><acronym><img><strong><em><b><i>' );
  }

  public function getAuthor() {
    return $this->author;
  }

  public function setAuthor( $author ) {
    if( $author instanceof User ) {
      $this->author = $author;
    } else if( is_string( $author ) ) {
      $this->author = User::fromUsername( $author );
    } else {
      throw new Exception( 'Unknown argument type' );
    }
  }

  public function setParent( $parent ) {
    if( $parent ) {
      $this->parent = $parent;
    } else {
      unset( $this->parent );
    }
  }

  public function getThread() {
    return new Thread( $this );
  }

  public function getCreationTime() {
    return $this->creationTime;
  }

  public function setCreationTime( $creationTime ) {
    $this->creationTime = $creationTime;
  }

  public function getId() {
    return $this->id;
  }

  public function getReplies() {
    $result = mysql_magic( 'select id, title, content, author, creation_date from posts where parent = ? order by creation_date',
                           $this->id );
    $topics = array();
    foreach( $result as $row ) {
      $topic = new Post( $row['title'],
                         $row['content'],
                         $row['author'],
                         $row['id'] );
      $topic->setCreationTime( $row['creation_date'] );
      array_push( $topics, $topic );
    }
    return $topics;
  }

  static public function fromId($id) {
    $result = mysql_magic( 'select id, title, content, author, creation_date from posts where id = ? limit 1', $id );
    if( $result ) {
      $topic = new Post( $result['title'],
                         $result['content'],
                         $result['author'],
                         $result['id'] );
      $topic->setCreationTime( $row['creation_date'] );
    }
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
      $topic->setCreationTime( $row['creation_date'] );
      array_push( $topics, $topic );
    }
    return $topics;
  }

  public function save() {
    if( is_null( $this->id ) ) {
      // Hack to get it to run, should be cleaned
      if( $this->parent ) {
        $result = mysql_magic( 'insert into posts (title, content, author, parent) values (?, ?, ?, ?)',
                               $this->title, $this->content, $this->author->getUsername(), $this->parent );
      } else {
        $result = mysql_magic( 'insert into posts (title, content, author) values (?, ?, ?)',
                               $this->title, $this->content, $this->author->getUsername() );
      }
      $this->id = $result;
    } else {
      $result = mysql_magic( 'update posts set title = ?, content = ?, author = ?, parent = ? where id = ?',
                             $this->title, $this->content, $this->author->getUsername(), $this->parent, $this->id );
    }
  }
}
