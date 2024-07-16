<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\chiled_taskes ;

class chiledTaskesController extends Controller
{
    public function index() {
        $chiled_taskes=chiled_taskes::all();
        $data=[
            'status'=>200 ,
            'post'=>$chiled_taskes
    
        ];
        return response()->json($data,200) ;
        }
        public function store(Request $request)
        {
            $chiled_taskes = new chiled_taskes();
            $request->validate([
                'title' => 'required'
                
            ]);
            $chiled_taskCreated = $chiled_taskes->create([
                'title' => $request->title,
                'task_id' => $request->task_id,
                'user_id' => $request->user_id,
               
            ]);
            return $chiled_taskCreated;
        }
    
        public function destroy($id)
        {           
            return  chiled_taskes::findOrFail($id)->delete();
        }
    
        public function editpost(Request $request, $id)
        {
            $request->validate([
                'title' => 'required'
                
            ]);
            $chiled_taskes =chiled_taskes::findOrFail($id);
            $chiled_taskes->title = $request->title;
         
            $chiled_taskes->save();
        }
        
}
