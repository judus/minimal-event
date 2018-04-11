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
     * List of events with methods
     *
     * @var array
     */
    protected $events = [];

    /**
     * Returns the events array
     *
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Returns a list of methods associated with a event
     *
     * @param $name
     *
     * @return array|mixed
     */
    public function getEventActions($eventName)
    {
        $events = isset($this->events[$eventName]) ? $this->events[$eventName] : [];

        return is_array($events) ? $events : [$events];
    }

    /**
     * Handles the event
     *
     * @param      $eventName
     * @param null $data
     *
     * @return array|mixed
     */
    public function handle($eventName, $data = null)
    {
        $results = [];

        if ($actions = $this->getEventActions($eventName)) {

            $actions = is_array($actions) ? $actions : [$actions];
            $data = is_array($data) ? $data : [$data];

            foreach ($actions as $action) {
                if ($result = $this->execute($action, $data)) {
                    $results[$action] = $result;
                }
            }
        }

        return count($results) === 1 ? $results[0] : $results;
    }

    /**
     * Calls a event method
     *
     * @param      $method
     * @param null $data
     *
     * @return mixed|null
     */
    protected function execute($method, $data = null)
    {
        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $data);
        }

        return null;
    }
}