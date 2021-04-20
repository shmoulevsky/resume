<?
namespace App\Repositories\Resume;

use App\Models\Resume\Education;

use App\Repositories\Interfaces\Resume\EducationRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;


class EducationRepository extends BaseRepository implements EducationRepositoryInterface{

   
   public function __construct(Education $model)
   {
       parent::__construct($model);
   }

     
   

   
}