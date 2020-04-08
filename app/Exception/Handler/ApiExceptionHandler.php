<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use App\Exception\ApiException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;
use Swoft\Validator\Exception\ValidatorException;
use Throwable;

/**
 * Class ApiExceptionHandler
 *
 * @since 2.0
 *
 * @ExceptionHandler({ApiException::class,\Throwable::class})
 */
class ApiExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $except
     * @param Response $response
     *
     * @return Response
     */
    public function handle(Throwable $except, Response $response): Response
    {
        // Log error message
        Log::error($except->getMessage());
        CLog::error('%s. (At %s line %d)', $except->getMessage(), $except->getFile(), $except->getLine());

        if ($except instanceof ValidatorException){
            $code = -1;
        }

        // 这里code默认为-1 因为layIm的api成功返回的code为0
        $code = ($except->getCode() == 0) ? -1 : $except->getCode();
        $message = $except->getMessage();



        // Debug is true
        if (APP_DEBUG) {
            $message = sprintf('(%s) %s', get_class($except), $except->getMessage());
        }
        return throwApiException(
            $code,
            $message,
            sprintf('At %s line %d', $except->getFile(), $except->getLine()),
            $except->getTraceAsString()
        );
    }
}
