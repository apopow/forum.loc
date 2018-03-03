@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @can('upload', $profileUser)
                <div class="col-md-3 ">
                    <img style="width:150px; height:150px; float:left; border-radius:50%; margin-right: 25px;" src="/uploads/avatars/{{ $profileUser->  avatar }}"/>
                    <form enctype="multipart/form-data" action="{{route('avatar', Auth::user())}}" method="POST">
                        <label>Update Profile Image</label>
                        <input type="file" name="avatar" />
                        <br/>
                        <input type="submit" class="pull-left btn btn-sm btn-primary" />
                        {{ csrf_field() }}
                    </form>
                </div>    
            @endcan

          
            <div class="col-md-9 ">

                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                        <small>Профиль был создан {{ $profileUser->created_at->format('d-m-Y') }} в {{ $profileUser->created_at->format('H:i:s') }}</small>
                    </h1>
                </div>
                    
                 @foreach ($threads as $thread)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="level">
                               <span class="flex">
                                    <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> опубликовал:
                                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                               </span>

                                <span>{{ $thread->created_at->format('d-m-Y | H:i:s') }}</span>
                            </div>
                        </div>

                        <div class="panel-body">
                            {{ $thread->body }}
                        </div>
                    </div>
                @endforeach

                {{ $threads->links() }}
            </div>
        </div>
    </div>
@endsection