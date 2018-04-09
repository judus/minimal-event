<?php namespace Maduser\Minimal\Event\Stubs;

use Maduser\Minimal\Event\Subscriber;

/**
 * Class SubscriberStub
 *
 * @package Maduser\Minimal\Event\Stubs
 */
class SubscriberStub extends Subscriber
{
    /**
     * @var int
     */
    private $counter = 0;

    /**
     * @var array
     */
    protected $events = ['test-event' => ['increaseCounter']];

    /**
     *
     */
    public function increaseCounter()
    {
        $this->counter += 1;
    }

    /**
     * @return int
     */
    public function getCounter()
    {
        return $this->counter;
    }
}
