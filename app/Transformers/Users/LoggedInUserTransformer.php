<?php

namespace App\Transformers\Users;

use App\Models\User;
use League\Fractal\TransformerAbstract;
use Spatie\Fractal\Facades\Fractal;

/**
 * Class LoggedInUserTransformer.
 */
class LoggedInUserTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = ['roles'];

    /**
     * @param \App\Model\User $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
            'token' => $model->createToken('Laravel Password Grant Client')->accessToken
        ];
    }

    /**
     * @param \App\Model\User $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRoles(User $model)
    {
        return $this->collection($model->roles, new RoleTransformer());
    }
}
