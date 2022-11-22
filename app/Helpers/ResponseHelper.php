<?php
namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseHelper
{
    /**
     * Prepare success response
     *
     * @param string $apiMessage
     * @param array $apiData
     * @param int $apiStatus
     * @return Illuminate\Http\JsonResponse
     */
    public function success(
        string $apiMessage,
        array $apiData,
        int $apiStatus = 200
    ): JsonResponse {
        $response['status'] = $apiStatus;

        if (!empty($apiData)) {
            $response['data'] = $apiData;
        }

        if ($apiMessage) {
            $response['message'] = $apiMessage;
        }

        return response()->json($response, $apiStatus, []);
    }

    /**
     * Prepare success response
     *
     * @param string $apiMessage
     * @param $apiData
     * @param int $apiStatus
     * @return Illuminate\Http\JsonResponse
     */
    public function successSingleRecord(
        string $apiMessage,
        $apiData,
        int $apiStatus = 200
    ): JsonResponse {
        $response['status'] = $apiStatus;

        if (!empty($apiData)) {
            $response['data'] = $apiData;
        }

        if ($apiMessage) {
            $response['message'] = $apiMessage;
        }

        return response()->json($response, $apiStatus, []);
    }

    /**
     * Prepare success response
     *
     * @param string $apiMessage
     * @param Illuminate\Pagination\LengthAwarePaginator $apiData
     * @param int $apiStatus
     * @param array $metaData
     * @return Illuminate\Http\JsonResponse
     */
    public function successWithPagination(
        string $apiMessage,
        LengthAwarePaginator $apiData,        
        int $apiStatus = 200,
        array $metaData = []
    ): JsonResponse {
        $response['status'] = $apiStatus;
        $response['data'] = [];

        // Check response data have pagination or not? Pagination response parameter sets
        if ($apiData->count()) {
            $apiData->appends(['perPage' => $apiData->perPage()]);

            $response['data'] = $apiData->toArray()['data'];
            $response['pagination'] = [
                "total" => $apiData->total(),
                "per_page" => $apiData->perPage(),
                "current_page" => $apiData->currentPage(),
                "total_pages" => $apiData->lastPage(),
                "next_url" => $apiData->nextPageUrl()
            ];
        }

        if (!empty($metaData)) {
            $response['meta_data'] = $metaData;
        }

        if ($apiMessage) {
            $response['message'] = $apiMessage;
        }

        return response()->json($response, $apiStatus, []);
    }

    /**
     * Prepare error response
     *
     * @param string $customErrorMessage
     * @param string $statusCode
     * @return Illuminate\Http\JsonResponse
     */
    public function error(
        string $customErrorMessage,
        int $statusCode = 500
    ): JsonResponse {
        $response['message'] = $customErrorMessage;
        $response['data'] = [];
        $response['status'] = $statusCode;

        return response()->json($response, $statusCode, [], JSON_NUMERIC_CHECK);
    }
}
