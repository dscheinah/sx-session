<?php
namespace Sx\Session;

use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Used to indicate all session errors. This includes various and "not found" errors.
 */
class SessionException extends Exception implements ContainerExceptionInterface, NotFoundExceptionInterface
{
}
