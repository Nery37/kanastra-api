<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\FilesController;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    /**
     * Testa o envio de um arquivo CSV para a rota file-store.
     *
     * @return void
     */
    public function testUploadCsvFile()
    {
        $csvContent = "name,governmentId,email,debtAmount,debtDueDate,debtId\n"
                    . "Elijah Santos,9558,janet95@example.com,7811,2024-01-19,ea23f2ca-663a-4266-a742-9da4c9f4fcb3\n"
                    . "Samuel Orr,5486,linmichael@example.com,5662,2023-02-25,acc1794e-b264-4fab-8bb7-3400d4c4734d\n"
                    . "Leslie Morgan,9611,russellwolfe@example.net,6177,2022-10-17,9f5a2b0c-967e-4443-a03d-9d7cdcb2216f";

        $fakeFile = UploadedFile::fake()->createWithContent('testFeature.csv', $csvContent);
        $response = $this->postJson(route('file-store'), ['file' => $fakeFile]);

        $response->assertStatus(201)
                 ->assertJson(['success' => 'O arquivo foi salvo e será processado em breve.']);

        Storage::disk('public')->assertExists('files/' . $response['file']);
        Storage::disk('public')->delete('files/' . $response['file']);
    }
}
