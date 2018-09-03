<?php
namespace Gaea\Client;

use Gaea\Config;

class Consumer
{
    private $config;

    public function __construct()
    {
        $this->config = Config::getInstance();
    }
}
