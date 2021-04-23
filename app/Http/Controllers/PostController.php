<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Models\Post;
use App\Models\Comment;
use Redirect;
use File;
use \Validator;
use Illuminate\Http\Request;



class PostController extends Controller
{
  private $post;

  public function __construct(Post $post)
  {
      $this->post = $post;
  }


    public function index(){
        $posts = Post::all();
        return view('post.index-post')->with('posts' ,$posts);
    }



    public function page($id){
        $post = $this->post->with('comments')->find($id);
        return view('post.page-post')->with('post' ,$post);
        
    }



    public function create(){

      $mensagens = [
        'title.required' => 'É Necessário um título.',
        'conteudo.required' => 'É Necessário uma Descrição.',
    ];

    $validator = Validator::make(Input::all(),[
      'title'=>'required',
      'bory'=>'required',
    ], $mensagens);

    if($validator->fails()){
      return back()->withErrors($validator);
    }



        if(Input::file('image'))
        {
          $image = Input::file('image');
          $extension = $image->getClientOriginalExtension();
          if($extension != 'jpg' && $extension != 'png')
          {
            return back()->with('erro', 'Erro: Este Aquivo não é suportado');
          }
        }    

     $post = new Post;
     $post->user_id= auth()->id();
     $post->title = Input::get('title');
     $post->bory = Input::get('bory');
     $post->image = "";
     $post->save();
     if(Input::file('image'))
     {
       File::move($image,public_path().'/imagens/post-id_'.$post->id.'.'.$extension);
       $post->image = '/imagens/post-id_'.$post->id.'.'.$extension;
       $post->save();
     }
     return redirect('/');
    }

    public function edit($id){
        $post = Post::find($id);
        return view('post.edit-post')->with('post' ,$post);
    }

    public function update($id){
      
      $post = Post::find($id);

      if (auth()->id() == $post->user_id){

      if(Input::file('image'))
      {
        $image = Input::file('image');
        $extension = $image->getClientOriginalExtension();
        if($extension != 'jpg' && $extension != 'png')
        {
          return back()->with('erro', 'Erro: Este Aquivo não é suportado');
        }
      }  
      
      if ($post->title!=Input::get('title')); 
      {
        $post->title = Input::get('title'); 
      }

      if ($post->bory!=Input::get('bory')); 
      {
        $post->bory = Input::get('bory'); 
      }

      $post->save();
      
      if(Input::file('image'))
      { 
        File::delete(public_path().$post->image);
        File::move($image,public_path().'/imagens/post-id_'.$post->id.'.'.$extension);
        $post->image = '/imagens/post-id_'.$post->id.'.'.$extension;
        $post->save();
      }

      return redirect('page-post/'.$post->id);
      
  }else return redirect('page-post/'.$post->id);
}

  public function destroy($id){
    $post = Post::find($id);
    if (auth()->id() == $post->user_id){
    File::delete(public_path().$post->image);
    $post->delete();
    return redirect('list-post');
  }else return redirect('page-post/'.$id);

}
}
