<?php

namespace Scaleplan\YandexDirectory;

use Scaleplan\YandexDirectory\Transport\ClientTransport;

/**
 * Class AbstractAPI
 *
 * @package Scaleplan\YandexDirectory
 */
abstract class AbstractAPI
{
    /**
     * @var ClientTransport
     */
    protected $api;

    /**
     * AbstractAPI constructor.
     */
    protected function __construct()
    {
        $this->api = new ClientTransport();
    }
}
