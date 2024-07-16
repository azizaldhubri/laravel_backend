<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\task ;

class taskcontroller extends Controller
{
   public function index() {
    $task=task::all();
    $data=[
        'status'=>200 ,
        'post'=>$task

    ];
    return response()->json($data,200) ;
    }
    
    //  public function getTask($id)
    // {   
    //     $task = task::all()->where('user_id','=',$id);
        
    //     $data=[
    //         'status'=>200 ,
    //         'post'=>$task
    
    //     ];
    //     return response()->json($data,200) ;
       
    // }

    public function store(Request $request)
    {
        $task = new task();
        $request->validate([
            'title' => 'required'
            
        ]);
        $taskCreated = $task->create([
            'user_id' => $request->user_id,
            'receivertask_id' => $request->receivertask_id,
            'title' => $request->title,
           
        ]);
        return $taskCreated;
    }

    public function destroy($id)
    {           
        return  task::findOrFail($id)->delete();
    }

    public function editpost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
            
        ]);
        $task = task::findOrFail($id);
        $task->title = $request->title;
     
        $task->save();
    }
  

}
