@extends('layouts.app')

@section('content')

@if ($user)

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Datu pertsonalak') }}</div>
                <div class="card-body">
                    <form id="formulario" method="POST" action="/profile/{{ $user->id}}">
                        @csrf
                        {{ method_field('PUT') }}
                        <input hidden id="initials" value="{{$user->initials}}" type="text" name="initials">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Izena</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Posta elktronikoa</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Gorde') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<script type="application/javascript">

    $(document).ready(function() {

        $("#name").on("keyup", function() {
            let initials_list = $(this).val().split(" ");
            let initials = "";
            for (let i = 0; i < initials_list.length; i++) {
                if (initials_list[i].length > 0) {
                    initials += initials_list[i].charAt(0).toUpperCase();
                    if (initials.length == 2)
                        break;
                }
            }
        });

/*         $("form#formulario").validate({
            rules: {
                initials : {
                    required: true,
                    minlength: 1,
                    maxlenght: 2
                },
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
            },
            messages : {
                initials: {
                    required: "Errorea"
                },
                name: {
                    required: "Mesedez, sartu izena"
                },
                email: {
                    required: "Mesedez, sartu email-a",
                    email: "Errorea email-aren formatuan"
                }  
            }
            });


    }); */
    });

</script>

@endsection