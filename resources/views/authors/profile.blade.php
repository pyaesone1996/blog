<div class="card">
    <div class="card-body">
        <center class="m-t-30"> <img src="{{ $author->avatar }}" class="img-circle" width="150" />
            <h4 class="card-title m-t-10">{{ $author->name }}</h4>
            <h6 class="card-subtitle">{{ $author->username }}</h6>
            <div class="row text-center justify-content-md-center">
                <div class="col-4"><a href="{{ '@'.$author->username.'/following' }}" class="link text-decoration-none"><i class="icon-people"></i>
                        <font class="font-medium">{{ count($author->follows) }}</font>
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{ url('/?author='.$author->id) }}" class="link text-decoration-none"><i class="mdi mdi-receipt"></i>
                        @php $count =0; @endphp
                        @foreach ( $articles as $article )
                        @if ($article->author_id == $author->id)
                        @php $count++; @endphp
                        @endif
                        @endforeach
                        <span class="font-medium">{{ $count }}</span>
                    </a>
                </div>
            </div>
        </center>
    </div>

    <div>
        <hr>
    </div>

    <div class="card-body">
        <small class="text-muted">username </small>
        <h6>{{ "@" }}{{ $author->username }}</h6>
        <small class="text-muted p-t-30 db">Birthday</small>
        <h6>{{ date('d M Y',strtotime($author->date_of_birth)) }}</h6> <small class="text-muted p-t-30 db">Address</small>
        <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
        <small class="text-muted p-t-30 db mb-2">Social Profile</small>
        <div class="mt-2">
            <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
            <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
            <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
        </div>

    </div>
</div>
