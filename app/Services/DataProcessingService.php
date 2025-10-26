<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DataProcessingService
{
    private $processor;
    private $validator;

    public function __construct()
    {
        $this->processor = new DataProcessor();
        $this->validator = new DataValidator();
    }

    /**
     * Process data with validation and transformation
     */
    public function process(array $data): array
    {
        Log::info('DataProcessingService: Processing data', ['data' => $data]);

        // Validate input data
        $validationResult = $this->validator->validate($data);
        if (!$validationResult['valid']) {
            return [
                'success' => false,
                'errors' => $validationResult['errors'],
                'processed_at' => now()->toISOString()
            ];
        }

        // Process the data
        $processedData = $this->processor->transform($data);

        return [
            'success' => true,
            'original_data' => $data,
            'processed_data' => $processedData,
            'processed_at' => now()->toISOString(),
            'service' => 'DataProcessingService'
        ];
    }

    /**
     * Batch process multiple data sets
     */
    public function batchProcess(array $dataSets): array
    {
        $results = [];
        $successCount = 0;
        $failureCount = 0;

        foreach ($dataSets as $index => $dataSet) {
            $result = $this->process($dataSet);
            $results[$index] = $result;

            if ($result['success']) {
                $successCount++;
            } else {
                $failureCount++;
            }
        }

        return [
            'success' => $failureCount === 0,
            'results' => $results,
            'summary' => [
                'total' => count($dataSets),
                'success' => $successCount,
                'failure' => $failureCount
            ],
            'processed_at' => now()->toISOString()
        ];
    }
}

/**
 * Internal DataProcessor class
 */
class DataProcessor
{
    public function transform(array $data): array
    {
        // Add processing metadata
        $data['transformed'] = true;
        $data['checksum'] = md5(json_encode($data));
        $data['size'] = strlen(json_encode($data));
        
        // Transform numeric values
        foreach ($data as $key => $value) {
            if (is_numeric($value)) {
                $data["{$key}_doubled"] = $value * 2;
            }
        }

        return $data;
    }
}

/**
 * Internal DataValidator class
 */
class DataValidator
{
    public function validate(array $data): array
    {
        $rules = [
            'required_field' => 'required|string',
            'numeric_field' => 'nullable|numeric|min:0|max:100',
            'email_field' => 'nullable|email'
        ];

        $validator = Validator::make($data, $rules);

        return [
            'valid' => !$validator->fails(),
            'errors' => $validator->errors()->toArray()
        ];
    }
}