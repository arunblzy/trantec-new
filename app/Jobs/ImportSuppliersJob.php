<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SuppliersImport;
use Maatwebsite\Excel\Excel as MaatwebsiteExcel;

class ImportSuppliersJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $filePath;

    public function __construct(string $filePath = null)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        // Ensure the correct path to the file is used
        $fullPath = storage_path('app/public/' . $this->filePath);

        // Log the full path for debugging
        Log::info('Processing file at path: ' . $fullPath);

        // Check if the file exists
        if (!file_exists($fullPath)) {
            Log::error('File does not exist at path: ' . $fullPath);
            throw new \Exception("File [{$this->filePath}] does not exist.");
        }

        // Process the file with an explicit type
        Excel::import(new SuppliersImport, $fullPath, null, MaatwebsiteExcel::XLSX);

        // Optionally delete the file after processing
        Storage::disk('public')->delete($this->filePath);
    }
}
