<?php

namespace App\Repositories\Interfaces\Resume;

use App\Resume\Resume;

interface ResumeRepositoryInterface
{
    public function all();
    public function getListPaginate($user_id, $page);
    public function getListId($user_id);
    public function getGroupedByStatus($user_id);
    public function getWithComments($id);

}
