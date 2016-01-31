<?php

namespace pizzaexpress\Transformers;

use League\Fractal\TransformerAbstract;
use pizzaexpress\Models\Cupom;

/**
 * Class CupomTransformer
 * @package namespace pizzaexpress\Transformers;
 */
class CupomTransformer extends TransformerAbstract
{

    /**
     * Transform the \Cupom entity
     * @param \Cupom $model
     *
     * @return array
     */
    public function transform(Cupom $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
