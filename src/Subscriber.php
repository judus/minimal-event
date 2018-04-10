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
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param $name
     *
     * @return array|mixed
     */
    public function getEventActions($eventName)
    {
        return isset($this->events[$eventName]) ? $this->events[$eventName] : [];
    }
}