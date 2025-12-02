<?php

declare(strict_types=1);

namespace PhpDocumentorLlms\Example;

/**
 * User repository interface.
 */
interface UserRepositoryInterface
{
    /**
     * Find a user by ID.
     *
     * @param int $id The user ID
     * @return User|null The user or null if not found
     */
    public function find(int $id): ?User;

    /**
     * Save a user.
     *
     * @param User $user The user to save
     * @return void
     */
    public function save(User $user): void;
}
