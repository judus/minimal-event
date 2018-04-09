<?php namespace Maduser\Minimal\Event;

use Maduser\Minimal\Event\Contracts\SubscriberInterface;

/**
 * Class Subscriber
 *
 * @package Maduser\Minimal\Event
 */
abstract class Subscriber implements SubscriberInterface
{
    /**
     * @var array
     */
    protected $events = [];

    /**
     * @param $name
     *
     * @return array|mixed
     */
    public function getSubscribedEvent($name)
    {
        return isset($this->events[$name]) ? $this->events[$name] : [];
    }
}