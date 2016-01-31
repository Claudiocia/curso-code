<?php

namespace pizzaexpress\Presenters;

use pizzaexpress\Transformers\OrderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderPresenter
 *
 * @package namespace pizzaexpress\Presenters;
 */
class OrderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderTransformer();
    }
}
