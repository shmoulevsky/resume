<?php

namespace App\Repositories\Interfaces;

use App\User;

interface ResumeRepositoryInterface
{
    public function all();

    public function getByUser(User $user);
}