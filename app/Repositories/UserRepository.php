<?php
namespace App\Repository;

use App\Model\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface{

    /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   /**
    * @return User
    */
    public function getCurrent(): User
    {
        return Auth::user();    
    }

}