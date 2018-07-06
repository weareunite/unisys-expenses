<?php

namespace Unite\Expenses;

use Unite\Expenses\Events\ItemDeleted;
use Unite\Expenses\Events\ItemEvent;
use Unite\Expenses\Events\ItemSaved;

class ItemSubscriber
{
    public function updateTotalPriceInExpense(ItemEvent $event)
    {
        $event->model->expense->total_price = $event->model->expense->calculateTotalPrice();
        $event->model->expense->total_price_without_vat = $event->model->expense->calculateTotalPriceWithoutVat();
        $event->model->expense->save();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            [ ItemSaved::class, ItemDeleted::class ],
            ItemSubscriber::class . '@updateTotalPriceInExpense'
        );
    }
}