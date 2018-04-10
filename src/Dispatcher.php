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
    private $events = [];

    /**
     * @param SubscriberInterface $subscriber
     *
     * @return array
     */
    public function register(SubscriberInterface $subscriber)
    {
        $class = get_class($subscriber);
        $events = $subscriber->getEvents();

        foreach($events as $event => $actions)
        {
            $this->registerEvent($event);
            $this->events[$event][$class] = $subscriber;
        }

        return $this->events;
    }

    /**
     * @param string $eventName
     * @param mixed $data
     */
    public function dispatch(string $eventName, $data = null)
    {
        foreach ($this->getEvent($eventName) as $subscriber)
        {
            $actions = $subscriber->getEventActions($eventName);
            $actions = is_array($actions) ? $actions : [$actions];

            foreach ($actions as $action) {
                $data = is_array($data) ? $data : [$data];
                call_user_func_array([$subscriber, $action], $data);
            }
        }
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function getEvent(string $name): array
    {
        return isset($this->events[$name]) ? $this->events[$name] : [];
    }

    /**
     * @param string $name
     */
    protected function registerEvent(string $name)
    {
        if (!isset($this->events[$name])) {
            $this->events[$name] = [];
        }
    }
}