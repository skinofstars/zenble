<?php

// not really right to say this is just about the album,
//  but you know what they say about hard things in tech...
class Album_Acl extends Zend_Acl {

  public function __construct() {
    //Add a new role called "guest"
    $this->addRole(new Zend_Acl_Role('guest'));

    //Add a role called user, which inherits from guest
    $this->addRole(new Zend_Acl_Role('user'), 'guest');

    //Add a resource called page
    $this->add(new Zend_Acl_Resource('album'));

    // guests can view stuff
    $this->allow('guest', 'album', 'view');

    // users can do stuff
    $this->allow('user', 'album', 'add');
    $this->allow('user', 'album', 'edit');
    $this->allow('user', 'album', 'delete');
  }

}
