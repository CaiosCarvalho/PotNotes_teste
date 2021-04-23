@extends('layouts.app')

@section('content')


<div class="container">
  
    <H1>Nova nota</H1>
 
 <form action="{{ url('create-post')}}" method="POST" enctype="multipart/form-data">
         @csrf

       @if (session('erro'))
            <div class="alert alert-danger">
                {{session('erro')}}
            </div>
        @endif
        
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-group">
          <label for="title">Titulo</label>
          <input name='title' type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titulo ">
        </div>
        <div class="form-group">
          <label for='bory'>Descrição</label>
          <textarea name='bory' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagem</label>
            <input name='image' type="file" class="form-control-file" id="image">
          </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
 </form>
</div>





@endsection