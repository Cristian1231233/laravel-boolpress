@extends('layouts.admin')

@section('content')

    <div class="container">

        <h1>Modifica: {{ $post->title }}</h1>

        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
          </div>
        @endif
        

        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input value="{{ old('title', $post->title) }}" type="text" name="title" class="form-control @error('title') is-invalid
                @enderror" id="title" placeholder="titolo">
                @error('title')
                   <p> {{ $message }} </p>
                @enderror
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Descrizione</label>
                <textarea class="form-control @error('title') is-invalid
                @enderror" name="content" id="content" rows="3">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <p> {{ $message }} </p>
                @enderror
              </div>
              <div class="mb-3">
                <select name="category_id" id="category_id" class="form-select" form-label="Seleziona una categoria">
                    <option selected>Selezionare una categoria</option>
                    @foreach ($categories as $category)
                    <option 
                    @if ($category->id == old('category_id')) selected @endif
                    value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach                   
                  </select>
             </div>
             <h2>Tag</h2>
             @foreach ($tags as $tag)
                  <span class="d-inline-block mr-3">
                      <input type="checkbox"
                          name="tags[]"
                          value="{{ $tag->id }}"
                          id="tag{{ $loop->iteration }}"
                          {{-- al primo caricamento non ci sono errori quindi --}}
                          {{-- stampo cheched se contengo l'id --}}
                            @if(!$errors->any() && $post->tags->contains($tag->id))
                                checked
                            @elseif ($errors->any() && in_array($tag->id, old('tags', [])))
                             {{-- viene stampato se ci sono errori quindi la regola ?? dtata dall'old --}}
                                checked
                            @endif
                          >
                      <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                  </span>
                @endforeach
       
              <button class="btn btn-success" type="submit">Invia</button>
            </div>
            </form>
      
    </div>
    
@endsection