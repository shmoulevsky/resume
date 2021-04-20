<?
namespace App\Repositories\Test;

use App\Models\Test\TestResume;

use App\Repositories\Interfaces\Test\TestResumeRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class TestResumeRepository extends BaseRepository implements TestResumeRepositoryInterface{

    
   public function __construct(TestResume $model)
   {
       parent::__construct($model);
   }

   
   
}