<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Resume;

class CommentController extends BaseController
{
    public function store(Request $request){

        
        $fields = $request->post('fields');

        $user = Auth::user();
        
        $entityId = $fields['entity-id'];
        $entityType = $fields['entity-type'];
        $text =  $fields['comment'];
        
        $comment = new Comment();
        $comment->company_id = $user->company->id;
        $comment->comment = $text;
 		$comment->user_id = $user->id;
 		$comment->to_user_id = $user->id;
 		
 		switch ($entityType){
			case 'resume' : $resume = Resume::findOrFail($entityId); $resume->comments()->save($comment); break;
		}
 		
 		if($request->hasFile('comment-file')){
						
 		}

        $data = ['status' => 'success'];

        return response()->json($data, 200); 

    }
}
