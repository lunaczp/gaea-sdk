<?php
namespace Gaea\Core;

use Gaea\Config;
use Gaea\Exception\MessageException;
use Gaea\Exception\TopicException;
use Gaea\Library\Uuid;

class Message {

    public static function normalize($msg) {
        if (empty($msg)) {
            throw new TopicException("Msg is empty");
        }

        $msgData['gaeaId'] = Uuid::get();
        $msgData['data'] = $msg;

        $msgStr = json_encode($msgData);
        if ($msgStr === false) {
            throw new MessageException("Msg encode error:" .json_last_error_msg());
        }
        if (strlen($msgStr) > Config::get("message.size.max")) {
            throw new MessageException("Msg size exceed after encode :" .strlen($msgStr));
        }
        return $msgStr;
    }
}
