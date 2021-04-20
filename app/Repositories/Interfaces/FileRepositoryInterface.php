<?php

namespace App\Repositories\Interfaces;

use App\User;

interface FileRepositoryInterface
{
    public function getPhotoForResume(Array $resumeId);
    
}