<?php

namespace Tests\Unit\Services;

use App\Repositories\FileRepository;
use App\Services\FileService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileServiceTest extends TestCase
{
    protected $mockFileRepository;
    protected $fileService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockFileRepository = $this->createMock(FileRepository::class);
        $this->fileService = new FileService($this->mockFileRepository);
    }

    public function testStoreFile()
    {

        DB::beginTransaction();
        $csvContent = "name,governmentId,email,debtAmount,debtDueDate,debtId\n"
                    . "Elijah Santos,9558,janet95@example.com,7811,2024-01-19,ea23f2ca-663a-4266-a742-9da4c9f4fcb3\n"
                    . "Samuel Orr,5486,linmichael@example.com,5662,2023-02-25,acc1794e-b264-4fab-8bb7-3400d4c4734d\n"
                    . "Leslie Morgan,9611,russellwolfe@example.net,6177,2022-10-17,9f5a2b0c-967e-4443-a03d-9d7cdcb2216f";

        $fakeFile = UploadedFile::fake()->createWithContent('testUnit.csv', $csvContent);

        $data = ['file' => $fakeFile];
        $response = $this->fileService->storeFile($data);
        $path = 'files/'.$response['file'];

        $this->assertArrayHasKey('success', $response);

        Storage::disk('public')->assertExists($path);
        Storage::disk('public')->delete($path);
        DB::rollBack();
    }
}
