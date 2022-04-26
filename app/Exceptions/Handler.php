<?php

namespace App\Exceptions;

use App\Http\Log;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Log;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // todo dj 自定义异常接管
    public function render($request, Throwable $e)
    {
        switch ($e) {
            case $e instanceof HttpException:
                return fail($e->getMessage());
            case $e instanceof ValidationException:
                return fail(current($e->validator)[0]);
            case $e instanceof \Exception:
                self::handlerLog($e, '普通异常');
                return fail('请求失败');
            default:
                self::handlerLog($e, '未正常捕获的异常');
                return fail('请求异常');
        }
    }
}
