<?php

namespace App\Exceptions;

use App\Mail\ErrorMail;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
use Illuminate\Support\Facades\Mail;


class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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

    public function report(Throwable $exception)
    {
        // Hata kaydını e-posta ile göndermek istediğiniz koşulu burada kontrol edebilirsiniz.
        if ($this->shouldReport($exception)) {
            $this->sendErrorEmail($exception);
        }

        parent::report($exception);
    }

    private function sendErrorEmail(Exception $exception)
    {
        // E-posta gönderme işlemini burada gerçekleştirin.
        Mail::to('projehatalari@gmail.com')->send(new ErrorMail($exception));
    }
}
