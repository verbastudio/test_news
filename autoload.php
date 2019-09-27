<?php
/**
 * Created by PhpStorm.
 * User: verba
 * Date: 26.09.19
 * Time: 22:53
 */

$classes = glob(server_path.'classes/*.php');
foreach ($classes as $class){
    if (file_exists($class)){
        @include_once $class;
    }
}
