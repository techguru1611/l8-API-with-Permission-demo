<?php

namespace App\Transformers\Assets;

use League\Fractal\TransformerAbstract;

/**
 * Class AssetTransformer.
 */
class AssetTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Asset $model
     * @return array
     */
    public function transform(\App\Models\Asset $model)
    {
        return [
            'id' => $model->id,
            'type' => $model->type,
            'path' => $model->path,
            'mime' => $model->mime,
            'links' => [
                'full' => url('api/assets/'.$model->id.'/render'),
                'thumb' => url('api/assets/'.$model->id.'/render?width=200&height=200'),
            ],
            'created_at' => $model->created_at->toIso8601String(),
        ];
    }
}
