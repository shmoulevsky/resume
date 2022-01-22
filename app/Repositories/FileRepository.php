<?php
namespace App\Repositories;

use App\Models\File;
use App\Repositories\Interfaces\FileRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FileRepository extends BaseRepository implements FileRepositoryInterface{

    
   public function __construct(File $model)
   {
       parent::__construct($model);
   }

   
   public function getPhotoForResume(Array $resume_id): Collection
   {
       return DB::table('files')->join('resume', 'resume.id', '=', 'files.fileable_id')->select('files.url', 'files.name', 'resume.id')->whereIn('resume.id',  $resume_id)->get()->mapWithKeys(function($photo, $key) {
        return [$photo->id => $photo];
        });   
   }

}