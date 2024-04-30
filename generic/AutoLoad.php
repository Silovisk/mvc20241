<?php
spl_autoload_register(function ($class){
    include $_SERVER["DOCUMENT_ROOT"]."/mvc2024/".$class.".php";
});