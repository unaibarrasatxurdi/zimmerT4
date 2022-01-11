@extends('layouts.app')

@section('content')

<div class="container my-5">

    <hotel-details :id="{{ $id }}" class="mb-5"></hotel-details>

    <h4 class="mb-4">Comentarios</h4>

    @if($user)
        <form id="comment-form" class="mb-2">
            @csrf
            <div class="d-flex align-items-center gap-4">
                <div>
                    <div class="user-icon bg-success">
                        <span>{{ $user->initials }}</span>
                    </div>
                </div>
                <div class="d-flex flex-column w-100">
                    <span class="fw-bold">{{ $user->name }}</span>
                    <input id="comment-input" type="text" autocomplete="off" placeholder="Añade un comentario publico" required>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-3">
                <button id="comment-btn" type="button" class="btn btn-primary">Comentar</button>
            </div>
        </form>
    @endif
    @if(sizeof($comments) == 0)
        <p id="no-comments" class="text-muted">Este hotel no tiene comentarios</p>
    @endif
    <div id="sample-comment" class="comment d-none d-flex align-items-top gap-4 mb-3">
        <div class="mt-1">
            <div class="user-icon bg-success">
                <span class="initials"></span>
            </div>
        </div>
        <div class="d-flex flex-column w-100">
            <div class="d-flex gap-2">
                <span class="username fw-bold"></span>
                <span class="text-muted"></span>
            </div>
            <p class="content"></p>
        </div>
    </div>
    <div class="comments">
        
    </div>

</div>

@endsection