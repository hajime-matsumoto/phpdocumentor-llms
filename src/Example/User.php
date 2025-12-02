<?php

declare(strict_types=1);

namespace PhpDocumentorLlms\Example;

/**
 * User entity.
 */
final class User
{
    /**
     * @var string The user's name
     */
    public string $name;

    /**
     * @var string The user's email
     */
    public string $email;

    /**
     * Create a new User.
     *
     * @param string $name The user's name
     * @param string $email The user's email address
     */
    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the user's display name.
     *
     * @return string The display name
     */
    public function getDisplayName(): string
    {
        return $this->name;
    }
}
