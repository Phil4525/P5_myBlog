<?php

namespace App\Lib;

class Globals
{
    private $GET;
    private $POST;
    private $SERVER;
    private $SESSION;

    public function __construct()
    {
        $this->GET = filter_input_array(INPUT_GET) ?? null;
        $this->POST = filter_input_array(INPUT_POST) ?? null;
        $this->SERVER = filter_input_array(INPUT_SERVER) ?? null;
        $this->SESSION = &$_SESSION;
    }

    public function getGET(string $key = null)
    {
        if ($key != null) {
            return $this->GET[$key] ?? null;
        }
        return $this->GET;
    }

    public function getPOST(string $key = null)
    {
        if ($key != null) {
            return $this->POST[$key] ?? null;
        }
        return $this->POST;
    }

    public function getSERVER(string $key = null)
    {
        if ($key != null) {
            return $this->SERVER[$key] ?? null;
        }
        return $this->SERVER;
    }

    public function getSESSION(string $key = null)
    {
        return isset($this->SESSION[$key]) ? $this->SESSION[$key] : null;
    }

    public function setSESSION(string $key, array $values)
    {
        $this->SESSION[$key] = $values;
    }

    public function unsetSESSION(string $key)
    {
        unset($this->SESSION[$key]);
    }
}
