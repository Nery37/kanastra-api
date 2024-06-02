<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\BilletRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * BillingService.
 */
class BillingService extends AppService
{
    protected RepositoryInterface $repository;

    /**
     * @param BilletRepository $repository
     */
    public function __construct(
        BilletRepository $repository,
    ) {
        $this->repository = $repository;
    }

    public function processRecord(array $data): mixed
    {
        try {
            DB::beginTransaction();

            $billet = $this->repository->create([
                'name' => $data['name'],
                'government_id' => $data['governmentId'],
                'email' => $data['email'],
                'debt_amount' => $data['debtAmount'],
                'debt_due_date' => $data['debtDueDate'],
                'debt_id' => $data['debtId'],
            ]);

            DB::commit();

            return $billet;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
