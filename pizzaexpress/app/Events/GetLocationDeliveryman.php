<?php

namespace pizzaexpress\Events;

use pizzaexpress\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use pizzaexpress\Models\Geo;
use pizzaexpress\Models\Order;

class GetLocationDeliveryman extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $geo;

    private $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Geo $geo, Order $order)
    {
        $this->geo = $geo;
        $this->model = $order;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->model->hash];
    }
}
