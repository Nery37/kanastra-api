<?php

declare(strict_types=1);

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait UuidTrait
{
    protected static function bootUuidTrait(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Uuid::uuid4()->toString();
            }
        });
    }
}
