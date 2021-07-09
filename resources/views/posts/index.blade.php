@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Manage Posts</h1>
                <form method="post" action="{{ route('posts.search') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" placeholder="Search.." class="form-control">
                        </div>
                        <div>
                            <button class="btn btn-dark">Search</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('posts.create') }}" class="btn btn-success" style="float: right">Create Post</a>
                <br/><br>
                <table class="table table-striped">
                    <thead>
                    <th width="80px">Id</th>
                    <th>Title</th>
                    <th>Post Image</th>
                    <th width="150px" colspan="2">Action</th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
{{--                            <td><img src="{{ \Illuminate\Support\Facades\Storage::url($post->image) }}" height="75" width="75" alt="" /></td>--}}

                            <td><img src="/img/{{ $post->image }}" width="100px"></td>
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View Post</a>
                                <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-success">Edit</a>
                                 <form id="delete-form-{{$post->id}}"
                                      method="get"
                                      action="{{route('posts.destroy',$post->id)}}"
                                      style="display: none">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                </form>
                                <a href="" class="btn btn-danger" style="font-size: 16px" onclick="if(confirm('ARE YOU SURE ,YOU WANT TO DELETE THIS?'))
                                    {
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{$post->id}}').submit();
                                    }else
                                    {
                                    event.preventDefault();
                                    }" > Delete</a>
                            </td>


                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
