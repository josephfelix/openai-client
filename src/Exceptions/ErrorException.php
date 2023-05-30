<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /** @var array{message: string, type: ?string, code: ?string} */
    private array $contents;
    
    /**
     * Creates a new Exception instance.
     *
     * @param  array{message: string, type: ?string, code: ?string}  $contents
     */
    public function __construct(array $contents)
    {
        parent::__construct($contents['message']);

        $this->contents = $contents;
    }

    /**
     * Returns the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Returns the error type.
     */
    public function getErrorType(): ?string
    {
        return $this->contents['type'];
    }

    /**
     * Returns the error type.
     */
    public function getErrorCode(): ?string
    {
        return $this->contents['code'];
    }
}
