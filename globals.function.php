<?php

const YEAR_GENERATOR_CENTER = 'CENTER';
const YEAR_GENERATOR_TOP = 'TOP';
const YEAR_GENERATOR_BOTTOM = 'BOTTOM';

function getWalletId($string)
{
    return substr($string, -10);
}

function parseRequest($request, $log = false)
{
    \Log::info('Request generated from IP Address: ' . request()->ip());

    if ($log === true) {
        \Log::info($request->except(['password', 'pin', 'auth']));
    }

    return $request->all();
}

function standardResponse($status, $message = null, $httpCode = 200, $data = [])
{
    $response = [
        'status' => $status,
        'message' => $message ?? 'Process Failed',
        'data' => $data,
    ];
    \Log::info(
        'Response in ' . getCurrentAction() . ' :' . print_r($response, true)
    );

    return response()->json($response, $httpCode);
}

/**
 * Other Utility functions below
 */
function publish($job)
{
    if (env('RABBITMQ_SERVER_ON') == true) {
        \Modules\Messenger\Messenger\Task\TaskProducer::publish($job);
    } else {
        if (method_exists($job, 'handle')) {
            $job->handle();
        } else {
            event($job);
        }
    }
}

function processJobFromWorker()
{
    if (env('RABBITMQ_SERVER_ON') == true) {
        \Modules\Messenger\Messenger\Task\TaskConsumer::processJobFromWorker();
    }
}

function decodeToken($token)
{
    try {
        $decoded = \Firebase\JWT\JWT::decode($token, env('JWT_SECRET'), [
            'HS256',
        ]);
    } catch (\Firebase\JWT\ExpiredException $e) {
        $decoded = [];
    }

    return $decoded;
}

function getHeaders($request)
{
    return $request->header();
}

function parsePoolProcessResult($pool)
{
    $pool->wait();
    //\Log::info("Pool Log:: " . print_r($pool, true));
    $result = $pool->getResult();
    if (is_array($result) && count($result) == 1) {
        return $result[0];
    } else {
        return $result;
    }
}

function decryptFile($path)
{
    return \Modules\Crypt\Entities\DecryptFile::instantDecrypt($path);
}

function encryptFile($path)
{
    return \Modules\Crypt\Entities\EncryptFile::instantEncrypt($path);
}

function validationError($data, $httpCode)
{
    return response()->json(
        [
            'responseCode' => $data['responseCode'] ?? '01',
            'message' => \Modules\ParrotHttp\Http\Controllers\ErrorClassifier::responseMessage(
                $data['responseCode'] ?? '01'
            ),
            'data' => $data ?? [],
        ],
        $httpCode
    );
}

function respondOK($response)
{
    // check if fastcgi_finish_request is callable
    if (is_callable('fastcgi_finish_request')) {
        /*
         * This works in Nginx but the next approach not
         */
        session_write_close();
        fastcgi_finish_request();

        return;
    }

    ignore_user_abort(true);

    ob_start();

    header('Content-Type: application/json');

    echo json_encode($response, JSON_PRETTY_PRINT);

    $serverProtocole = filter_input(
        INPUT_SERVER,
        'SERVER_PROTOCOL',
        FILTER_SANITIZE_STRING
    );
    header($serverProtocole . ' 200 OK');
    header('Content-Encoding: none');
    header('Content-Length: ' . ob_get_length());
    header('Connection: close');

    ob_end_flush();
    ob_flush();
    flush();

    // Close current session (if it exists).
    if (session_id()) {
        session_write_close();
    }
}

function exceptionResponse($data, $httpCode)
{
    $response = [
        'responseCode' => $data['responseCode'] ?? '91',
        'message' => \Modules\ParrotHttp\Http\Controllers\ErrorClassifier::responseMessage(
            $data['responseCode'] ?? '91',
            $data['message']
        ),
        'data' => $data ?? [],
    ];
    \Log::info(
        'Exception Response in ' .
            getCurrentAction() .
            ' :' .
            print_r($response, true)
    );

    return response()->json($response, $httpCode);
}

function initializeAsyncPool()
{
    $poolObject = new \Modules\AsyncProcess\Entities\ProcessPool();
    $pool = $poolObject->getPool();
    return $pool;
}

function getCurrentAction()
{
    return Illuminate\Support\Facades\Route::getCurrentRoute()->getActionName() ??
        '';
}

function generate_years(
    $startAt = null,
    $count = 20,
    $format = YEAR_GENERATOR_CENTER
) {
    if (!$startAt) {
        $startAt = date('Y');
    }

    $years = [];

    switch (strtoupper($format)) {
        case YEAR_GENERATOR_CENTER:
            $halves = round($count / 2);

            for ($i = 0; $i < $halves; $i++) {
                $years[] = $startAt + $halves - $i;
            }

            for ($i = 0; $i < $halves; $i++) {
                $years[] = $startAt - $i;
            }

            break;
        case YEAR_GENERATOR_TOP:
            for ($i = 0; $i < $count; $i++) {
                $years[] = $startAt - $i;
                json_encode($data);
                json_encode($data);
                json_encode($data);
            }
            break;

        case YEAR_GENERATOR_BOTTOM:
            for ($i = 0; $i < $count; $i++) {
                $years[] = $startAt + $count - $i;
            }
            break;
    }
    return $years;
}

function isPath($path)
{
    return $path == currentRoutePath();
}

function currentRoutePath()
{
    return currentRoute()->uri;
}

function currentRoute()
{
    return \Route::current();
}

function to_db_date($string)
{
    $timestamp = strtotime($string);

    return date('Y-m-d', $timestamp);
}
function to_db_datetime($string)
{
    $timestamp = strtotime($string);

    return date('Y-m-d H:i:s', $timestamp);
}

function from_db_datetime($dateTime)
{
    $timestamp = strtotime($dateTime);

    return date('Y-m-d h:i:s A', $timestamp);
}

function strToDbTime($timeString)
{
    $timestamp = strtotime($timeString);

    return date('H:i:s', $timestamp);
}

function dbTimeToStr($time)
{
    $timestamp = strtotime($time);

    return date('h:i A', $timestamp);
}

function setMetaData(
    \Modules\System\Contracts\iMetaData &$entity,
    array $metaDataValue,
    bool $shouldSave = false
) {
    $return = null;
    $data = $entity->metadata;

    if (empty($data)) {
        // no configuration value
        $return = json_encode($metaDataValue);
    } else {
        foreach ($metaDataValue as $field => $val) {
            // update configuration value
            $data[$field] = $metaDataValue[$field];
        }
        $return = json_encode($data);
    }

    if ($shouldSave) {
        $entity->save();
    }

    return $return;
}

function getMetaDataValue(array $meta, $searchField)
{
    if (!empty($meta)) {
        //
        foreach ($meta as $f => $val) {
            //
            if ($f == $searchField) {
                return $val;
            }
        }
    }

    return;
}

function inPercentage($numerator, $denominator)
{
    return round(($numerator / $denominator) * 100, 2);
}

function errorResponse($message)
{
    return response()->json($message, 401);
}

function generateJsonWebTokenFromUser(\Modules\Users\Models\User $user = null)
{
    if (!$user) {
        return null;
    }

    return \JWTAuth::fromUser($user);
}
