<?php

namespace App\Transformers\Masters;

use App\Models\Technology;
use League\Fractal\TransformerAbstract;

/**
 * Class TechnologyTransformer.
 */
class TechnologyTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * @param \App\Models\Technology $model
     * @return array
     */
    public function transform($model)
    {
        return [
            'id' => $model->id,
            'name' => $model->technology,
            'status' => $model->status,
            'created_at' => ($model->created_at) ? $model->created_at->toIso8601String() : null,
            'updated_at' => ($model->updated_at) ? $model->updated_at->toIso8601String() : null,
        ];
    }
}
