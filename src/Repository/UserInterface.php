<?php

namespace Api\Repository;

use Api\Model\User;

interface UserInterface
{
    public function userAuth(User $user): string;

    public function recoverPass(User $user): array;

    public function addUser(User $user): array;

}