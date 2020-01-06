@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">

            @auth
                <div class="create-post">
                    <form class="form-create" action="{{url('post')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="textPostCreate">Create post:</label><br>
                            <textarea id="textPostCreate" name="text" rows="4" cols="40"
                                      placeholder="Write text, please" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">send</button>
                    </form>

                    <form class="form-edit" action="#" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="textPostEdit">Edit post:</label><br>
                            <textarea id="textPostEdit" name="text" rows="4" cols="40" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">save</button>
                    </form>
                </div>
                <hr>
            @endauth

            @foreach ($posts as $post)
                <div class="post-item">
                    <div class="post-head">
                        <h4 class="post-author">{{ $post->user->name }}</h4>
                        <p class="post-create-time text-muted ">{{ $post->created_at }}</p>

                        <div class="float-right">

                            @can('update', $post)
                                <button class="btn btn-outline-success btn-sm btn-edit"
                                        data-url="{{route('edit.post', $post->id)}}">edit
                                </button>
                            @endcan

                            @can('delete', $post)
                                <form method="POST" action="{{route('remove.post', $post->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-outline-danger btn-sm">delete</button>
                                </form>
                            @endcan
                        </div>

                    </div>

                    <div class="post-content">
                        <p>{!! nl2br(e($post->text)) !!}</p>
                    </div>
                    <hr>
                </div>
            @endforeach

        </div>
        <div>{{ $posts->links() }}</div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/script.js')}}"></script>
@endpush
