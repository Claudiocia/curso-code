<?php

namespace pizzaexpress\Transformers;

use League\Fractal\TransformerAbstract;
use pizzaexpress\Models\User;

/**
 * Class UserTransformer
 * @package namespace pizzaexpress\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['client'];

    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'      => $model->name,
            'email'     => $model->email,
            'role'      => $model->role
        ];
    }

    public function includeClient(User $model)
    {
        if($model->client) {
            return $this->item($model->client, new ClientTransformer());
        }else{
            return null;
        }
    }
}
