<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\FileRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessCsvFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * FileService.
 */
class FileService extends AppService
{
    protected RepositoryInterface $repository;

    /**
     * @param FileRepository $repository
     */
    public function __construct(
        FileRepository $repository,
    ) {
        $this->repository = $repository;
    }

    public function storeFile(array $data): mixed
    {
        try {
            DB::beginTransaction();

            $file = $data['file'];
            $timestamp = now()->format('YmdHis');
            $fileName = $timestamp . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('files', $fileName, 'public');
            $fileSize = $file->getSize();
            $file = $this->repository->create([
                'name' => $fileName,
                'mime_type' => $file->getClientMimeType(),
                'path' => $path,
                'size' => $fileSize,
            ]);

            ProcessCsvFile::dispatch($path, $fileName);

            DB::commit();

            return ['success' => 'O arquivo foi salvo e será processado em breve.', 'file' => $fileName];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
