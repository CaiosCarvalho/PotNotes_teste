@extends('layouts.app')

@section('content')

<div class="container">


  <div class="card mb-3 shadow-sm p-3 mb-5 bg-white rounded">
    <p class="card-text"><small class="text-muted">Por: {!! $post->user->name !!}</small></p>
    <img class="card-img-top" src="{{ url($post->image) }}" alt="">
    <div class="card-body">
      <h3 class="card-title">{{ $post->title }}</h3>
      <p class="card-text">{{ $post->bory }}.</p>
      <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
    </div>
  </div>
  @if(auth()->id() == $post->user_id)
  <div>
  <a href="{{ url('edit-post/'.$post->id) }}" class="btn btn-outline-dark btn-sm" role="button">Editar</a>
  <a href="{{ url('delete-post/'.$post->id) }}" class="btn btn-outline-dark btn-sm" role="button">Deletar</a>
</div>
@endif
   
   <div class="mt-5">
   <h5 class="mt-n1">Adicionar Comentário:</h5>
   @if(auth()->check())    
    <form action="{{ url('create-comment/'.$post->id)}}" method="POST" class="form">
          @csrf
       <div class="form-group">
        <input type="text" name="title"  class="form-control _nome" placeholder="Nome" required>
       </div>
      <div class="form-group">
        <textarea name="bory" class="form-control _texto" rows="5" cols="30" placeholder="Comentario" required></textarea>
      </div>
        <button type="submit" class="btn btn-secondary text-light">Comentar</button>
    </form>
    @else 
     <p>Precisa estar logado para fazer comentarios: <a href="{{ route('login')}}">Login</a></p>
    @endif
    </div> 

  <div class="container">
    <hr>
   <h3>Comentários ({{ $post->comments->count() }})</h3>
   @forelse ($post->comments as $comment)
    <p>
        <b>{{ $comment->user->name }} comentou: </b>
        {{ $comment->bory }}
    </p>
    @if(auth()->id() == $comment->user_id)
    <a href="{{ url('delete-comment/'.$comment->id) }}" class="btn btn-outline-dark btn-sm" role="button">Deletar</a>
    @endif
    <hr>
   @empty

 @endforelse

  </div>
</div> 

@endsection