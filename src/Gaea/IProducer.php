<?php
namespace Gaea;

interface IProducer
{

    public function publish($topic, $msg);

}
