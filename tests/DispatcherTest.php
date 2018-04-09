<?php namespace Maduser\Minimal\Events\Tests;

use PHPUnit\Framework\TestCase;
use Maduser\Minimal\Event\Dispatcher;
use Maduser\Minimal\Event\Stubs\SubscriberStub;

/**
 * Class DispatcherTest
 *
 * @package Maduser\Minimal\Events\Tests
 */
class DispatcherTest extends TestCase
{
    /** @var Dispatcher */
    private $dispatcher;

    /**
     * @var SubscriberStub
     */
    private $subscriber;

    /**
     *
     */
    public function setUp()
    {
        $this->dispatcher = new Dispatcher;
        $this->subscriber = new SubscriberStub;
    }

    /** @test */
    public function dispatchTest()
    {
        $this->dispatcher->addSubscriber($this->subscriber);
        $this->dispatcher->dispatch('test-event');
        $this->assertEquals(1, $this->subscriber->getCounter());
    }
}