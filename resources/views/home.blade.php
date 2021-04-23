@extends('layouts.app')

@section('content')
<<div class="container">
    <h1> Ultimas Notas</h1>
         <div class="card-columns">
            @foreach ($ultimos as $key => $post)        
            <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
              <p class="card-text"><small class="text-muted">Por: {!! $post->user->name !!}</small></p>
                <img class="card-img-top" src="{{ url($post->image) }}" alt="">
                <div class="card-body">
                  <h2 class="card-title">{{ $post->title }}</h2> 
                  <p class="card-text">{{ $post->bory }}</p>            
                  <p class="card-text"><small class="text-muted">{!! $post->created_at->diffForHumans() !!}</small></p>
                  <a href="{{ url('page-post/'.$post->id) }}" class="btn btn-success" role="button">Visualizar</a>
                </div>
              </div>
          @endforeach
        </div>
            <div class=" d-flex align-items-end">
        {{ $ultimos->render() }}
    </div>
</div>


@endsection
