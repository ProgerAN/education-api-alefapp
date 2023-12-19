<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use MarcinOrlowski\ResponseBuilder\ExceptionHandlerHelper;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $ex, $request) {
            return ExceptionHandlerHelper::render($request, $ex);
        });
    }

    public function render($request, Throwable $e)
    {
//        if ($e instanceof ModelNotFoundException) {
//            return new JsonResponse([
//                'message' => "Unable to locate the {$this->prettyModelNotFound($e)} you requested."
//            ], 404);
//        }

        return parent::render($request, $e);
    }

    private function prettyModelNotFound(ModelNotFoundException $exception): string
    {
        if (!is_null($exception->getModel())) {
            return Str::lower(ltrim(preg_replace('/[A-Z]/', ' $0', class_basename($exception->getModel()))));
        }

        return 'resource';
    }
}
