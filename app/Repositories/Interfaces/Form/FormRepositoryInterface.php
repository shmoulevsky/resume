<?php

namespace App\Repositories\Interfaces\Form;



interface FormRepositoryInterface
{
    public function getListPaginateWithResumeCount($user_id, $page);
    public function saveForm($arForm, $arFields, $arFieldsVariant, $userId, $formId, $companyId);
}