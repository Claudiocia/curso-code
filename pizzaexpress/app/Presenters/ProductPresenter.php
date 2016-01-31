<?php

namespace pizzaexpress\Presenters;

use pizzaexpress\Transformers\ProductTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProductPresenter
 *
 * @package namespace pizzaexpress\Presenters;
 */
class ProductPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductTransformer();
    }
}
