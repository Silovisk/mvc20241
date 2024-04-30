<?php
spl_autoload_register(function ($class){
    include $_SERVER["DOCUMENT_ROOT"]."/mvc20241/".$class.".php";
});