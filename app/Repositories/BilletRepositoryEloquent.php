<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Billet;
use App\Presenters\FilePresenter;

/**
 * Class BilletRepositoryEloquent.
 */
class BilletRepositoryEloquent extends Repository implements BilletRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Billet::class;
    }

}
