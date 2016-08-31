<?php
/**
 * Proxy pattern example
 *
 * @author Albert Colom <skolom@gmail.com>
 * @see https://en.wikipedia.org/wiki/Proxy_pattern
 */

interface SubjectInterface
{
    public function request();
}

class Proxy implements SubjectInterface
{
    protected $realSubject;

    public function request()
    {
        $this->realSubject = new RealSubject();
        $this->realSubject->request();
    }
}

class RealSubject implements SubjectInterface
{
    public function request()
    {
        echo get_class()." request \n";
    }
}

class User
{
    protected $proxy;

    public function __construct()
    {
        $this->proxy = new Proxy();
    }

    public function request()
    {
        $this->proxy->request();
    }
}

$user = new User();
$user->request();
