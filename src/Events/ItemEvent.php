<?php

namespace Unite\Expenses\Events;

use Illuminate\Queue\SerializesModels;
use Unite\Expenses\Models\Item;

abstract class ItemEvent
{
    use SerializesModels;

    /** @var Item */
    public $model;

    /**
     * Create a new event instance.
     *
     * @param  Item $model
     * @return void
     */
    public function __construct(Item $model)
    {
        $this->model = $model;
    }
}