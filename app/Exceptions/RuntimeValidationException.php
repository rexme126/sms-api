<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\RuntimeValidationException;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class RuntimeValidationException extends Exception implements RendersErrorsExtensions
{
    /**
    * @var @string
    */
    private $key;
    private $reason;

    public function __construct(string $message, string $key, $reason = '')
    {
        parent::__construct($message);

        $this->key = $key;
        $this->reason = $reason;
    }

    /**
     * Returns true when exception message is safe to be displayed to a client.
     *
     * @api
     * @return bool
     */
    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * Returns string describing a category of the error.
     *
     * Value "graphql" is reserved for errors produced by query parsing or validation, do not use it.
     *
     * @api
     * @return string
     */
    public function getCategory(): string
    {
        return 'validation';
    }

    /**
     * Return the content that is put in the "extensions" part
     * of the returned error.
     *
     * @return array
     */
    public function extensionsContent(): array
    {
        return [
            'code' => $this->key,
            'reason' => $this->reason,
        ];
    }
}
