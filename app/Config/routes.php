<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', ['controller' => 'pages', 'action' => 'main']);
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', ['controller' => 'pages', 'action' => 'display']);

	Router::connect('/projects/new', ['controller' => 'projects', 'action' => 'registration']);
	Router::connect('/projects/:id', ['controller' => 'projects', 'action' => 'show'], ['id' => '[0-9]+']);
	Router::connect('/projects/:id/edit', ['controller' => 'projects', 'action' => 'edit'], ['id' => '[0-9]+']);

	Router::connect('/projects/:id/issues/new', ['controller' => 'issues', 'action' => 'registration'], ['id' => '[0-9]+']);
	Router::connect('/projects/:id/issues/create', ['controller' => 'issues', 'action' => 'create'], ['id' => '[0-9]+']);
	Router::connect('/projects/:id/members', ['controller' => 'members', 'action' => 'index'], ['id' => '[0-9]+']);
	Router::connect('/issues/:id', ['controller' => 'issues', 'action' => 'show'], ['id' => '[0-9]+']);
	Router::connect('/issues/:id/comment', ['controller' => 'comments', 'action' => 'create'], ['id' => '[0-9]+']);
	Router::connect('/issues/:id/close.json', ['controller' => 'issues', 'action' => 'close'], ['id' => '[0-9]+']);
	Router::connect('/issues/:id/reopen.json', ['controller' => 'issues', 'action' => 'reopen'], ['id' => '[0-9]+']);
	Router::connect('/issues/:id/workloads/start', ['controller' => 'workloads', 'action' => 'start'], ['id' => '[0-9]+']);
	Router::connect('/issues/:id/workloads/stop', ['controller' => 'workloads', 'action' => 'stop'], ['id' => '[0-9]+']);
	Router::connect('/issues/:id/edit', ['controller' => 'issues', 'action' => 'edit'], ['id' => '[0-9]+']);
	Router::connect('/issues/:id/assignee', ['controller' => 'issues', 'action' => 'assignee'], ['id' => '[0-9]+']);

	Router::connect('/members/:id/delete', ['controller' => 'members', 'action' => 'del'], ['id' => '[0-9]+']);

	Router::connect('/users/sign_up', ['controller' => 'users', 'action' => 'signUp']);
	Router::connect('/users/sign_in', ['controller' => 'users', 'action' => 'signIn']);
	Router::connect('/users/sign_out', ['controller' => 'users', 'action' => 'signOut']);
	Router::connect('/users/:id', ['controller' => 'users', 'action' => 'show'], ['id' => '[0-9]+']);
	Router::connect('/opauth-complete/*', ['controller' => 'users', 'action' => 'opauthComplete']);

	Router::connect('/dashboard', ['controller' => 'dashboards', 'action' => 'show']);

	Router::connect('/users/:user_id/workloads/:year/:month/:day', ['controller' => 'workloads', 'action' => 'index'],
		['user_id' => '[0-9]+','year' => '[0-9]+','month' => '[0-9]+','day' => '[0-9]+',]);

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
