<?php
namespace Gaea\Client;

use Gaea\Config;
use Gaea\Core\Message;
use Gaea\Core\ObjPool;
use Gaea\Core\Topic;
use Gaea\Logger;

class Producer
{

    public function publish($topic, $msg)
    {
        try {
            $topic = Topic::normalize($topic);
            $msg = Message::normalize($msg);

            $producerClass = Config::get("storage.producer");
            $producer = ObjPool::get($producerClass);
            $ret = $producer->publish($topic, $msg);

            if ($ret !== true) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
        }
        return false;
    }
}