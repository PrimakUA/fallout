<?php

class Db
{
    private static $_db;

    public static function connectDb($host, $user, $password, $db_name)
    {
        if (!self::$_db) {
            /* Подключение к серверу MySQL */
            self::$_db = mysqli_connect(
                'localhost',  /* Хост, к которому мы подключаемся */
                'root',       /* Имя пользователя */
                '',   /* Используемый пароль */
                'fallout');     /* База данных для запросов по умолчанию */

            if (!self::$_db) {
                printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
                exit;
            }
        }

        mysqli_query(self::$_db, 'SET NAMES utf8');

        return self::$_db;
    }

    public static function getDbLink()
    {
        if (!self::$_db)
            die('Нет подключения к базе данных.');

        return self::$_db;
    }
}