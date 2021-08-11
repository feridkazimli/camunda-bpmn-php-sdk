<?php
declare(strict_types=1);

namespace Bpmn\Helpers;

class Response
{
    protected static $error = [];
    protected static $success = [];
    protected static $data = [];

    public static function setError($error_body)
    {
        static::$error = $error_body;
        return static::$error;
    }

    public static function setSuccess($body)
    {
        static::$success = $body;
        return static::$success;
    }

    public static function getData()
    {
        if (count(static::$error) > 0) {
            return static::$error;
        }
        else
        {
            return static::$success;
            // echo json_encode(static::$success);
        }
    }

    public static function getError()
    {
        if (count(static::$error) > 0) {
            echo json_encode(static::$error);
            die;
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function getSuccess()
    {
        if (count(static::$success) > 0) {
            return static::$success;
        }
        else
        {
            return false;
        }
    }
}
?>