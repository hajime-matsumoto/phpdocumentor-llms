<?php

declare(strict_types=1);

namespace PhpDocumentorLlms\Example;

/**
 * User management service.
 *
 * Handles user creation, retrieval, and updates.
 */
class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * Create a new UserService instance.
     *
     * @param UserRepositoryInterface $repository The user repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find a user by ID.
     *
     * @param int $id The user ID
     * @return User|null The user or null if not found
     */
    public function findById(int $id): ?User
    {
        return $this->repository->find($id);
    }

    /**
     * Create a new user.
     *
     * @param string $name The user's name
     * @param string $email The user's email address
     * @return User The created user
     */
    public function create(string $name, string $email): User
    {
        $user = new User($name, $email);
        $this->repository->save($user);
        return $user;
    }
}
