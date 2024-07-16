<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\models\Post ;
use App\models\Post1 ;
use Validator ;
class PostsController extends Controller
{
   
    public function index()
    {
        $post1=post1::all();
        $data=[
            'status'=>200 ,
            'post'=>$post1

        ];
        return response()->json($data,200) ; 
    }
    public function upload(Request $request)
    {
        $validitor=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            
        ])  ;
        if($validitor->fails())
        {
            $data=[
                'status'=>422,
                'message'=>$validitor->messages()
    
            ];
            return response()->json($data,422);
        }
        else{
            $post1=new post1;
            $post1->name=$request->name;
            $post1->email=$request->email;
            $post1->phone=$request->phone;

            $post1->save();

            $data=[
                'status'=>200,
                'message'=>'Data uploaded successfully'
    
            ];            
            return response()->json($data,200);

        }
    }
    public function destroy($id)
    {           
        return  post1::findOrFail($id)->delete();
    }
    public function getPost($id)
    {
        return post1::findOrFail($id);
    }
//--------------------------------


    public function editpost(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
          
        ]);
        $post1 = post1::findOrFail($id);
        $post1->name = $request->name;
        $post1->email = $request->email;
        $post1->phone = $request->phone;
        $post1->save();
    }


    

     
}
