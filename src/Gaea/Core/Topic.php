<?php
namespace Gaea\Core;

use Gaea\Config;
use Gaea\Exception\TopicException;

class Topic {

    public static function normalize($name) {
        if (empty($name)) {
            throw new TopicException("Topic name is empty");
        }

        if (strlen($name) > Config::get("topic.legnth")) {
            throw new TopicException("Topic name too long:" .strlen($name));
        }

        return $name;
    }
}
