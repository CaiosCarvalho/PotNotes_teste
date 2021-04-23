<?php


namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use \Validator;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
{
    public function create ($id)
    {

        /* $mensagens = [
            'title.required' => 'É Necessário um título.',
            'conteudo.required' => 'É Necessário uma Descrição.',
        ];
    
        $validator = Validator::make(Input::all(),[
          'title'=>'required',
          'bory'=>'required',
        ], $mensagens);
    
        if($validator->fails()){
          return back()->withErrors($validator);
        } */
        $comment = new Comment();
        $comment->post_id =$id;
        $comment->user_id= auth()->id();
        $comment->title = Input::get('title');
        $comment->bory = Input::get('bory');
        $comment->save();
        //$comment = $request->user()->comments()->create($request->all());

        return redirect('page-post/'.$id);
      }

    public function destroy($id){
        //dd($post_id);
        $comment = Comment::find($id);
        if (auth()->id() == $comment->user_id)
        {  
        $post_id = $comment->post_id;
        $comment->delete();
        return redirect('page-post/'.$post_id);
    }else return redirect('page-post');
    
    } 
}
