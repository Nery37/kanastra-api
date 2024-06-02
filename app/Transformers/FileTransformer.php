<?php

namespace App\Transformers;

use App\Entities\File;
use League\Fractal\TransformerAbstract;

/**
 * Class FileTransformer.
 *
 * @package namespace App\Transformers;
 */
class FileTransformer extends TransformerAbstract
{
    /**
     * Transform the File entity.
     *
     * @param \App\Entities\File $model
     *
     * @return array
     */
    public function transform(File $model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $this->getFileName($model->name),
            'mime_type' => $model->mime_type,
            'path' => $model->path,
            'size' => (int) $model->size,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    private function getFileName($fileName)
    {
        $underscorePosition = strpos($fileName, '_');

        return $underscorePosition !== false ? substr($fileName, $underscorePosition + 1) : $fileName;
    }
}
