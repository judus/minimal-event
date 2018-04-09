<?php namespace Maduser\Minimal\Event;

use Maduser\Minimal\Event\Contracts\DispatcherInterface;
use Maduser\Minimal\Event\Contracts\SubscriberInterface;

/**
 * Class Dispatcher
 *
 * @package Maduser\Minimal\Event
 */
class Dispatcher implements DispatcherInterface
{
    /**
     * @var array
     */
    private $subscribers = [];

    /**
     * @param SubscriberInterface $subscriber
     */
    public function addSubscriber(SubscriberInterface $subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    /**
     * @param string $eventName
     * @param mixed $data
     */
    public function dispatch(string $eventName, $data = null)
    {
        foreach ($this->subscribers as $subscriber)
        {
            foreach ($subscriber->getSubscribedEvent($eventName) as $action)
            {
                $subscriber->{$action}($data);
            }
        }
    }
}