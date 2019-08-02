<?php

namespace Scaleplan\YandexDirectory\Transport;

use function Scaleplan\Helpers\get_required_env;

/**
 * Class ClientTransport
 *
 * @package Scaleplan\Matrix\Transport
 */
class ClientTransport extends AbstractTransport
{
    /**
     * AdminTransport constructor.
     *
     * @throws \Scaleplan\Helpers\Exceptions\EnvNotFoundException
     */
    public function __construct()
    {
        $this->apiUrl = get_required_env('YANDEX_DIRECTORY_API_URL');
    }
}
