@extends('layouts.app')
    
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 nopadding">
            <div class="user-wrapper">
                <ul class="users">
                    @foreach ($users as $user)
                        <li class="user info_user" id="{{ $user->id }}">
                            <span class="pending">2</span>
                            <div class="media">
                                <div class="media-left">
                                    <img src="{{!empty($user->image) ? 'upload/'.$user->image : "" }}" alt="" class="media-object">
                                </div>

                                <div class="media-body">
                                    <p class="name">{{ $user->name }}</p>
                                    <p class="email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9 nopadding">
            <div class="card">
                <div class="message-wrapper" id="message-wrapper">
                    @include('admin.message.messages')
                </div> 
                <div class="input-text">
                    <input type="text" name="message-send" id="message-send" class="submit">
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection