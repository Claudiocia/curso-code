<?php

namespace pizzaexpress\Transformers;

use League\Fractal\TransformerAbstract;
use pizzaexpress\Models\OrderItem;

/**
 * Class OrderItemTransformer
 * @package namespace pizzaexpress\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{

    /**
     * Transform the \OrderItem entity
     * @param \OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
