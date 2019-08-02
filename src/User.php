<?php

namespace Scaleplan\YandexDirectory;

use Scaleplan\Http\Interfaces\RemoteResponseInterface;
use Scaleplan\YandexDirectory\DTO\Request\UserDTO;

/**
 * Class User
 *
 * @package Scaleplan\YandexDirectory
 */
class User extends AbstractAPI
{
    /**
     * @param UserDTO $dto
     *
     * @return RemoteResponseInterface
     *
     * @throws Exceptions\YandexDirectoryException
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
    public function create(UserDTO $dto) : RemoteResponseInterface
    {
        return $this->api->post('/user', $dto);
    }
}
