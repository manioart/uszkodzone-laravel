<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileService
{

    /**
     * @param string $path
     * @param model $model
     *
     * @return void
     *
     */
    public function storeFile(string $path, string $fileName, model $model): void
    {
            $contents = file_get_contents($path);
            $file = Storage::disk('public')->put($fileName, $contents);
            $path = Storage::url($fileName);

            $model->files()->create([
                'original_name' => $fileName,
                'path' => $path,
            ]);
    }

    /**
     * @param model $model
     *
     * @return collection
     *
     */
    public function getFiles(model $model): collection
    {
        $model->load('files');

        return $model->files;
    }

    /**
     * @param mixed $model
     *
     * @return BinaryFileResponse
     *
     */
    public function downloadFile($model): BinaryFileResponse
    {
        $model->load('files');
        $file = public_path($model->files()->first()->path);

        return response()->download($file);
    }

    /**
     * @param model $model
     *
     * @return void
     *
     */
    public function destroyAll(model $model): void
    {
        $model->load('files');

        foreach ($model->files as $file) {
            Storage::delete($file->path);
            $file->delete();
        }
    }

    /**
     * @return void
     *
     */
    public function destroy(): void
    {
        foreach ($this->files as $file) {
            Storage::delete($file->path);
            $file->delete();
        }
    }
}
