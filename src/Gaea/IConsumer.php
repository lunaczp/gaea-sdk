<?php
namespace Gaea;

interface IConsumer
{

    public function consume($topic);

}