<?php

namespace Scaleplan\YandexDirectory\Transport;

use Lmc\HttpConstants\Header;
use Scaleplan\DTO\DTO;
use Scaleplan\Http\Constants\ContentTypes;
use Scaleplan\Http\Constants\Methods;
use Scaleplan\Http\Interfaces\RemoteResponseInterface;
use Scaleplan\Http\Interfaces\RequestInterface;
use Scaleplan\HttpStatus\HttpStatusCodes;
use Scaleplan\YandexDirectory\Exceptions\YandexDirectoryException;
use function Scaleplan\DependencyInjection\get_required_container;
use function Scaleplan\Helpers\get_required_env;

/**
 * Class AbstractTransport
 *
 * @package Scaleplan\YandexDirectory\Transport
 */
abstract class AbstractTransport
{
    protected $apiUrl;

    /**
     * AbstractTransport constructor.
     */
    abstract public function __construct();

    /**
     * @param string $url
     * @param null $data
     * @param string|null $dtoClass
     *
     * @return RemoteResponseInterface
     *
     * @throws YandexDirectoryException
     * @throws \ReflectionException
     * @throws \Scaleplan\DTO\Exceptions\ValidationException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     * @throws \Scaleplan\Helpers\Exceptions\EnvNotFoundException
     * @throws \Scaleplan\Http\Exceptions\ClassMustBeDTOException
     * @throws \Scaleplan\Http\Exceptions\HttpException
     * @throws \Scaleplan\Http\Exceptions\RemoteServiceNotAvailableException
     */
    public function post(
        string $url,
        $data = null,
        string $dtoClass = null
    ) : RemoteResponseInterface
    {
        return $this->send(Methods::POST, $url, $data, $dtoClass);
    }

    /**
     * @param string $method
     * @param string $url
     * @param null $data
     * @param string|null $dtoClass
     *
     * @return RemoteResponseInterface
     *
     * @throws YandexDirectoryException
     * @throws \ReflectionException
     * @throws \Scaleplan\DTO\Exceptions\ValidationException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     * @throws \Scaleplan\Helpers\Exceptions\EnvNotFoundException
     * @throws \Scaleplan\Http\Exceptions\ClassMustBeDTOException
     * @throws \Scaleplan\Http\Exceptions\HttpException
     * @throws \Scaleplan\Http\Exceptions\RemoteServiceNotAvailableException
     */
    protected function send(
        string $method,
        string $url,
        $data = null,
        string $dtoClass = null
    ) : RemoteResponseInterface
    {
        $dataArray = $data ?? [];
        if ($data instanceof DTO) {
            $data->validate(['type']);
            $data->validate();
            $dataArray = $data->toFullSnakeArray();
        }

        /** @var RequestInterface $request */
        $request = get_required_container(
            RequestInterface::class,
            [$this->apiUrl . $url, $dataArray]
        );
        if ($dtoClass) {
            $request->setDtoClass($dtoClass);
            $request->setValidationEnable(true);
        }
        $request->setMethod($method);
        $request->addHeader(
            Header::AUTHORIZATION,
            'OAuth ' . get_required_env('YANDEX_ACCESS_TOKEN')
        );
        $request->addHeader(Header::CONTENT_TYPE, ContentTypes::JSON);
        $request->addHeader(Header::ACCEPT, ContentTypes::JSON);
        $request->addHeader('X-Org-ID', get_required_env('YANDEX_APP_ID'));

        $response = $request->send();
        if ($response->getHttpCode() === HttpStatusCodes::HTTP_FORBIDDEN) {
            throw new YandexDirectoryException(
                $response,
                $response->getHeader('WWW-Authenticate') ?? 'Auth token incorrect'
            );
        }

        return $response;
    }

    /**
     * @param string $url
     * @param null $data
     * @param string|null $dtoClass
     *
     * @return RemoteResponseInterface
     *
     * @throws YandexDirectoryException
     * @throws \ReflectionException
     * @throws \Scaleplan\DTO\Exceptions\ValidationException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     * @throws \Scaleplan\Helpers\Exceptions\EnvNotFoundException
     * @throws \Scaleplan\Http\Exceptions\ClassMustBeDTOException
     * @throws \Scaleplan\Http\Exceptions\HttpException
     * @throws \Scaleplan\Http\Exceptions\RemoteServiceNotAvailableException
     */
    public function put(
        string $url,
        $data = null,
        string $dtoClass = null
    ) : RemoteResponseInterface
    {
        return $this->send(Methods::PUT, $url, $data, $dtoClass);
    }

    /**
     * @param string $url
     * @param null $data
     * @param string|null $dtoClass
     *
     * @return RemoteResponseInterface
     *
     * @throws YandexDirectoryException
     * @throws \ReflectionException
     * @throws \Scaleplan\DTO\Exceptions\ValidationException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ContainerTypeNotSupportingException
     * @throws \Scaleplan\DependencyInjection\Exceptions\DependencyInjectionException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ParameterMustBeInterfaceNameOrClassNameException
     * @throws \Scaleplan\DependencyInjection\Exceptions\ReturnTypeMustImplementsInterfaceException
     * @throws \Scaleplan\Helpers\Exceptions\EnvNotFoundException
     * @throws \Scaleplan\Http\Exceptions\ClassMustBeDTOException
     * @throws \Scaleplan\Http\Exceptions\HttpException
     * @throws \Scaleplan\Http\Exceptions\RemoteServiceNotAvailableException
     */
    public function get(
        string $url,
        $data = null,
        string $dtoClass = null
    ) : RemoteResponseInterface
    {
        return $this->send(Methods::GET, $url, $data, $dtoClass);
    }
}
