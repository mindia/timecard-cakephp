<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array(
	  'Session',
	  'Html',
	  'Form',
	  'Paginator',
	);
	public $layout = 'default';
	public $components = [
		'Session',
		'Cookie',
		'Auth' => [
			'allowedActions' => ['main'],
		    'loginAction' => [
		        'controller' => 'users',
		        'action' => 'sign_in',
		    ],
		    'loginRedirect' => ['controller' => 'pages', 'action' => 'main'],
 		    'logoutRedirect' => ['controller' => 'pages', 'action' => 'main'],
		    'authError' => 'Did you really think you are allowed to see that?',
		    'authenticate' => [
		        'Form' => [
		           'fields' => ['username' => 'email', 'password'=>'encrypted_password'],
		           'passwordHasher' => [
                    'className' => 'Simple',
                    'hashType' => 'sha256'
               	]
		        ]
		    ]
		],
		'SendEmail'
	];

	public $uses = ['User','Workload', 'Issue'];
	public function beforeFilter()
	{
		$auth_user = $this->Auth->user();
		$current_user = null;
		if( !is_null($auth_user) )
		{
			//todo get users
			$current_user = $this->User->find('first', [
				'fields' => ['User.id', 'User.email', 'User.name'],
				'conditions' => ['User.email' => $auth_user['email'],
				]
			]);
		}
		$this->set('is_login', ($current_user)? true:false );
		$this->set('current_user', $current_user);
		$this->Session->write('current_user', $current_user);

		// todo コンポーネントにまとめるほうがいいかもしれない
		$isRunningWorkload = false;
		$runningWorkloadLists = [];
		if( !is_null($current_user)){
			$isRunningWorkload = $this->Workload->isRunning();
			$runningWorkloadLists = $this->Issue->getIssueByWorkload($this->Workload->isRunningLists());
			$runningWorkloadLists = $this->Workload->addProgressTime($runningWorkloadLists);
		}

		$this->set('isRunning', $isRunningWorkload );
		$this->set('runningWorkloadLists', $runningWorkloadLists );
	}
}
