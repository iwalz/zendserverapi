<?php
namespace ZendServerAPI\DataTypes;

class SuperGlobals
{
    protected $get = array();
    protected $post = array();
    protected $cookie = array();
    protected $server = array();
    protected $session = array();

    public function __construct()
    {

    }

    public function addGetParameter($key, $value)
    {
        $this->get[$key] = $value;
    }

    public function getGetParameter($key = null)
    {
        if ($key === null) {
            return $this->get;
        } elseif (array_key_exists($key, $this->get)) {
            return $this->get[$key];
        } else {
            return null;
        }
    }

    public function addPostParameter($key, $value)
    {
        $this->post[$key] = $value;
    }

    public function getPostParameter($key = null)
    {
        if ($key === null) {
            return $this->post;
        } elseif (array_key_exists($key, $this->post)) {
            return $this->post[$key];
        } else {
            return null;
        }
    }

    public function addCookieParameter($key, $value)
    {
        $this->cookie[$key] = $value;
    }

    public function getCookieParameter($key = null)
    {
        if ($key === null) {
            return $this->cookie;
        } elseif (array_key_exists($key, $this->cookie)) {
            return $this->cookie[$key];
        } else {
            return null;
        }
    }

    public function addSessionParameter($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function getSessionParameter($key = null)
    {
        if ($key === null) {
            return $this->session;
        } elseif (array_key_exists($key, $this->session)) {
            return $this->session[$key];
        } else {
            return null;
        }
    }

    public function addServerParameter($key, $value)
    {
        $this->server[$key] = $value;
    }

    public function getServerParameter($key = null)
    {
        if ($key === null) {
            return $this->server;
        } elseif (array_key_exists($key, $this->server)) {
            return $this->server[$key];
        } else {
            return null;
        }
    }
}
