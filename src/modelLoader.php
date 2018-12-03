<?php
/**
 * Created by IntelliJ IDEA.
 * User: Anthony
 * Date: 10/31/18
 * Time: 5:18 PM
 */

function modelLoader($class) {
    include('models/' . $class . '.model.php');
}

spl_autoload_register('modelLoader');