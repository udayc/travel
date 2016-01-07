<?php namespace App\Http\Controllers;

use App\Models\ProjectComment;

use Illuminate\Http\Request;

class ProjectCommentController extends Controller{
	
	public function index(Request $request){
		$projectId = $request->get('projectId');
		
		if(!is_numeric($projectId))
			throw new \Exception('Invalid project id passed');
		
		$allComments = ProjectComment::where('project_id', $projectId)
			->where('status', true)
			->with([
				'user' => function($query){
					$query->select(['id', 'name']);
				},
			])->get();
			
		$formattedComments = [];
		foreach($allComments as $comment){
			$formattedComments[] = [
				'id' => $comment->id,
				'userName' => isset($comment->user->name) ? $comment->user->name : 'Unknown',
				'comment' =>  strip_tags($comment->comment),
				'userId' => isset($comment->user->id) ? $comment->user->id : 0,
				'projectId' => $comment->project_id,
				'date' => $comment->created_at->toDateTimeString(),
			];
		}
		return response()->json($formattedComments);
	}
	
	public function store(Request $request){
		//dd($request->all());
		
		//preparing data to save as new comment for a project
		$projectComment = new ProjectComment;
		$projectComment->comment = strip_tags($request->get('comment'));
		$projectComment->project_id = $request->get('projectId');
		$projectComment->user_id = $request->get('userId');
		$projectComment->created_at = new \DateTime($request->get('date'));
		
		//saving the data
		if(!$projectComment->save())
			abort('Saving new record is failed', 500);
		
		//updating and sending fresh json with the new comment	
		return response()->json($projectComment);
	}
	
	public function update($id, Request $request){
		if(is_numeric($id)){
			$projectComment = ProjectComment::findOrFail($id);
			$projectComment->comment = strip_tags($request->get('comment'));
			
			$projectComment->save();
			
			return response()->json($projectComment);
		}else
			abort('The required parameters are missing or invalid', 500);
	}
	
	public function destroy($id){
		if(is_numeric($id)){
			$projectComment = ProjectComment::findOrFail($id);
			$projectComment->delete();
			return response()->json(['success' => 'Successfully deleted']);
		}else
			abort('The required parameters are missing or invalid', 500);
	}
}