 @if ( $article->likes->pluck('liked')->contains(1) )

 <form action="/admin/articles/{{ $article->id }}/removelike" method="POST">
     @foreach ($article->likes()->where('liked' , 1)->get() as $key => $value)
     <input type="hidden" name="id" value="{{ $value->id }}">
     @endforeach
     @method('DELETE')
     @csrf
     @if(Auth::check())
     <button type="submit" class="p-0 btn text-decoration-none {{ $article->isLikeBy(Auth::user()) ? 'text-info' : 'text-dark'  }}">
         @endif
         <div class="d-flex align-items-center justify-content-start">
             <i class=" far fa-thumbs-up align-self-center mr-2"> </i>
             <span class="align-self-center">{{ $article->liked  ?: 0}}</span>
         </div>
     </button>
 </form>

 @else

 <form action="/admin/articles/{{ $article->id }}/like" method="POST">
     @csrf
     @if(Auth::check())
     <button type="submit" class="p-0 btn text-decoration-none {{ $article->isLikeBy(Auth::user()) ? 'text-info' : 'text-dark'  }}">
         @endif
         <div class="d-flex align-items-center justify-content-start">
             <i class=" far fa-thumbs-up align-self-center mr-2"> </i>
             <span class="align-self-center">{{ $article->liked  ?: 0}}</span>
         </div>
     </button>
 </form>

 @endif

 @if ( $article->likes->pluck('liked')->contains(0) )

 <form action="/admin/articles/{{ $article->id }}/removelike" method="POST">
     @csrf
     @foreach ($article->likes()->where('liked' , 0)->get() as $key => $value)
     <input type="hidden" name="id" value="{{ $value->id }}">
     @endforeach
     @method('DELETE')
     @if(Auth::check())
     <button type="submit" class="p-0 btn text-decoration-none {{ $article->isDislikeBy(Auth::user()) ? 'text-info' : 'text-dark'  }}">
         @endif
         <div class="d-flex align-items-center justify-content-start ml-3">
             <i class=" far fa-thumbs-down align-self-center mr-2"> </i>
             <span class="align-self-center"> {{ $article->disliked  ?: 0}}</span>
         </div>
     </button>
 </form>

 @else

 <form action="/admin/articles/{{ $article->id }}/like" method="POST">
     @csrf
     @method('DELETE')
     @if(Auth::check())
     <button type="submit" class="p-0 btn text-decoration-none {{ $article->isDislikeBy(Auth::user()) ? 'text-info' : 'text-dark'  }}">
         @endif
         <div class="d-flex align-items-center justify-content-start ml-3">
             <i class=" far fa-thumbs-down align-self-center mr-2"> </i>
             <span class="align-self-center"> {{ $article->disliked  ?: 0}}</span>
         </div>
     </button>
 </form>

 @endif
