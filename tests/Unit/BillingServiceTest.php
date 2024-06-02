<?php

namespace Tests\Unit\Services;

use App\Repositories\BilletRepository;
use App\Services\BillingService;
use Exception;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BillingServiceTest extends TestCase
{
    protected $mockBilletRepository;
    protected $billingService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockBilletRepository = $this->createMock(BilletRepository::class);
        $this->billingService = new BillingService($this->mockBilletRepository);
    }

    public function testProcessRecord()
    {
        $data = [
            'name' => 'Elijah Santos',
            'governmentId' => '9558',
            'email' => 'janet95@example.com',
            'debtAmount' => 7811,
            'debtDueDate' => '2024-01-19',
            'debtId' => 'ea23f2ca-663a-4266-a742-9da4c9f4fcb3',
        ];

        $this->mockBilletRepository->expects($this->once())
            ->method('create')
            ->with([
                'name' => $data['name'],
                'government_id' => $data['governmentId'],
                'email' => $data['email'],
                'debt_amount' => $data['debtAmount'],
                'debt_due_date' => $data['debtDueDate'],
                'debt_id' => $data['debtId'],
            ])
            ->willReturn($data);

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        $response = $this->billingService->processRecord($data);

        $this->assertSame($data, $response);
    }

    public function testProcessRecordFails()
    {
        $data = [
            'name' => 'Elijah Santos',
            'governmentId' => '9558',
            'email' => 'janet95@example.com',
            'debtAmount' => 7811,
            'debtDueDate' => '2024-01-19',
            'debtId' => 'ea23f2ca-663a-4266-a742-9da4c9f4fcb3',
        ];

        $this->mockBilletRepository->expects($this->once())
            ->method('create')
            ->will($this->throwException(new Exception('Erro ao criar o registro')));

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollBack')->once();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Erro ao criar o registro');

        $this->billingService->processRecord($data);
    }
}
