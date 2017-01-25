<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
class LessonsController extends Controller
{
    //
    public function getLesson(){
	$lesson = Lesson::all();
    	return response()->json(['message'=>'get data success',
    							 'lessons'=>$lesson]);
    }
    public function updateLesson(Request $request,$id){
    	$lesson = Lesson::findOrfail($id);
    	$lesson -> update(['lesson_name'=>$request->input('lesson_name')]);
    	return response()->json(['message'=>'Update success']);
    }
    public function storeLesson(Request $request){
        $this->validate($request,['lesson_name'=>'required']);

        $lesson = Lesson::create(['lesson_name'=>$request->input('lesson_name')]);
        return response()->json(['message'=>'lesson Added',
                                 'lessons'=>$lesson]);
        
    }
    public function deleteLesson(Request $request,$id){
        $lesson = Lesson::find($id);
        $lesson ->delete();
        return Response()->json(['message'=>'delete Success']);
    }
}
