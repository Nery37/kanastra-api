<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\File;
use App\Presenters\FilePresenter;

/**
 * Class FileRepositoryEloquent.
 */
class FileRepositoryEloquent extends Repository implements FileRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return File::class;
    }

    /**
     * @return string
     */
    public function presenter(): string
    {
        return FilePresenter::class;
    }
}
