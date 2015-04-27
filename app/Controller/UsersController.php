<?php
/**
 * Created by PhpStorm.
 * User: chongos
 * Date: 4/20/15 AD
 * Time: 10:35 PM
 */
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add');
    }

    public function login() {

        //if already logged-in, redirect
        if($this->Session->check('Auth.User')) {
            if($this->Auth->user('role') == 'a')
                $this->redirect(array('controller' => 'admins', 'action' => 'index'));
            else
                $this->redirect(array('controller' => 'profile', 'action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
                if($this->Auth->user('role') == 'a')
                    $this->redirect(array('controller' => 'admins', 'action' => 'index'));
                else
                    $this->redirect(array('controller' => 'profile', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }


    public function add()
    {
        $this->layout ='blank';
        if ($this->request->is('post')) {

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been created'));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }
        }
    }

    public function activate($id = null) {

        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }

}
