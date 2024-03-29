<?php

namespace Scaleplan\YandexDirectory\Exceptions;

use Scaleplan\Http\RemoteResponse;

/**
 * Class MatrixException
 *
 * @package Scaleplan\RocketChat\Exceptions
 */
class YandexDirectoryException extends \Exception
{
    public const MESSAGE = 'Yandex connect integration error.';
    public const CODE    = 400;

    /**
     * @var RemoteResponse
     */
    protected $response;

    /**
     * MatrixException constructor.
     *
     * @param RemoteResponse $response
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(RemoteResponse $response, $message = '', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message ?: static::MESSAGE, $code ?? static::CODE, $previous);
        $this->response = $response;
    }
}
