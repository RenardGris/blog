<?php

namespace Core\Auth;

/**
 * Class Session
 * Abstract class to manage $_SESSION superglobal
 *
 */
class Session
{
    /**
     * @var $_SESSION
     */
    protected $session;

    /**
     * Session constructor.
     * Singleton for $_SESSION
     */
    public function __construct()
    {
        if(empty($this->session)){
            $this->session = &$_SESSION;
        }
        return $this->session;
    }


    /**
     *
     * insert a new $value in $_SESSION
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function put($key, $value)
    {
        $this->session[$key] = $value;
    }

    /**
     *
     * used as an abstract class to get value of request key from App
     *
     * @param mixed $key
     * @return mixed|null
     */
    public static function get($key)
    {
        //return (isset($_SESSION[$key]) ? filter_var($_SESSION[$key]) : null);
        return (new Session())->getKey($key);
    }

    /**
     *
     * remove value of the $key from $_SESSION
     *
     * @param mixed $key
     */
    public function forget($key)
    {
        unset($this->session[$key]);
    }

    /**
     *
     * return value of the request $key if exist, else return null
     *
     * @param mixed $key
     * @return mixed|null
     */
    public function getKey($key)
    {
        return isset($this->session[$key]) ? $this->session[$key] : null;
    }

}
