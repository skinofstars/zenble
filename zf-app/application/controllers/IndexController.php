<?php

class IndexController extends Zend_Controller_Action
{

    private $_acl = null;
    private $_role = null;

    public function init()
    {
        // yeah, just hack in a require...
        // basically, i'd have hoped this would have been available in an autoload
        // maybe at the very least put it in a bootstrap
        // or y'know, php namespace loading
        require_once 'Album/Acl.php';

        $this->_acl = new Album_Acl();

        $this->_role = (Zend_Auth::getInstance()->hasIdentity()) ? 'user' : 'guest';
    }

    public function preDispatch()
    {
        // FIXME action name isn't returning correctly?
        //  just use per Action ACL until we sort it out
        $action = $this->getRequest()->getActionName();

        // if ( !$this->_acl->isAllowed($this->_role, 'album', $action) ) {
        //   $this->_helper->redirector('index', 'auth');
        // }
    }

    public function indexAction()
    {
        $albums = new Application_Model_DbTable_Albums();
        $this->view->albums = $albums->fetchAll();
    }

    public function addAction()
    {
        // FIXME this would be better done in the preDispatch method
        if ( !$this->_acl->isAllowed($this->_role, 'album', 'add') ) {
          $this->_helper->redirector('index', 'auth');
        }

        $form = new Application_Form_Album();

        $form->submit->setLabel('Add');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->addAlbum($artist, $title);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        // FIXME this would be better done in the preDispatch method
        if ( !$this->_acl->isAllowed($this->_role, 'album', 'edit') ) {
          $this->_helper->redirector('index', 'auth');
        }


        $form = new Application_Form_Album();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->updateAlbum($id, $artist, $title);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }

        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Albums();
                $form->populate($albums->getAlbum($id));
            }
        }
    }

    public function deleteAction()
    {
        // FIXME this would be better done in the preDispatch method
        if ( !$this->_acl->isAllowed($this->_role, 'album', 'delete') ) {
          $this->_helper->redirector('index', 'auth');
        }

         if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $albums = new Application_Model_DbTable_Albums();
                $albums->deleteAlbum($id);
            }
            $this->_helper->redirector('index');
         } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_DbTable_Albums();
            $this->view->album = $albums->getAlbum($id);
         }
    }


}

