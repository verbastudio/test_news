<?php
/**
 * Created by PhpStorm.
 * User: verba
 * Date: 25.09.19
 * Time: 20:41
 */

namespace NEWS;

define('server_path', $_SERVER['DOCUMENT_ROOT'] . '/test_news/');
define('main_url', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/test_news/');
(empty(session_id())) ? session_start() : session_id();
define('id_session', session_id());
require_once('autoload.php');

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
    require_once(server_path . 'views/head.php');
    if ($_GET['post']) {
        $post_id = (int)preg_replace('/(^0-9)/', '', $_GET['post']);
        $post = (new ControllerNews())->show_news($post_id);
        if ($post) {
            extract($post);
            require_once(server_path . 'views/main.php');
        }
    } elseif ($_GET['add']) {
        $action = "Add";
        require_once(server_path . 'views/add.php');
    } elseif ($_GET['addgenerator']) {
        $list = newsCreator();
        for ($tr = 1; $tr <= 109; $tr++) {
            $request = [
                'post_name' => $list['post_name'] . $tr,
                'post_body' => $list['post_body'],
                'status' => 1
            ];
            $sdfs = (new ControllerNews())->AddPost($request);
        }
    } elseif ($_GET['edit']) {
        $action = "Edit";
        $post_id = (int)preg_replace('/(^0-9)/', '', $_GET['edit']);
        $post = (new ControllerNews())->show_news($post_id);
        if ($post) {
            extract($post);
            require_once(server_path . 'views/add.php');
        }
    } else {
        $posts = (new ControllerNews())->index();
        $total = $posts['total'];
        unset($posts['total']);
        if (count($posts)) {
            extract($posts);
        } else {
            $posts = 'empty';
        }
        $paginator = (new ControllerNews())->paginator($total);
        require_once(server_path . 'views/main.php');
    }
    require_once(server_path . 'views/footer.php');
} else {
    if ($_POST['addpost'] && $_POST['addpost'] == id_session) {
        unset($_POST['addpost']);
        $request = array_filter($_POST);
        if ($request && !empty($request['post_name']) && !empty($request['post_body'])) {
            if ($request['id']) {
                $act = 'updateed';
                $add_post = (new ControllerNews())->EditPost($request);
            } else {
                $act = 'added';
                $add_post = (new ControllerNews())->AddPost($request);
            }
            echo json_encode(['status' => 'success', 'text' => 'Success post ' . $act]);
        } else {
            echo json_encode(['status' => 'error', 'text' => '<stromng>ALARM!!!!<br>SOMETHING WENT WRONG!!!</stromng>']);
        }
    } elseif ($_POST['removepost'] && $_POST['removepost'] == id_session) {
        unset($_POST['removepost']);
        $request = array_filter($_POST);
        if ($request) {
            (new ControllerNews())->RemovePost($request['id']);
            echo json_encode(['status' => 'success', 'text' => 'Success post removed']);
        } else {
            echo json_encode(['status' => 'error', 'text' => '<stromng>ALARM!!!!<br>SOMETHING WENT WRONG!!!</stromng>']);
        }
    } else {
        $posts = (new ControllerNews())->index();
        $total = $posts['total'];
        unset($posts['total']);
        if (count($posts)) {
            extract($posts);
        } else {
            $posts = ['empty'];
        }
        require_once(server_path . 'views/main.php');
    }
}




