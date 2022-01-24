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
                                <button id="gordeBotoia" type="button" class="btn btn-primary">
                                    {{ __('Gorde') }}
                                </button>
                            </div>
                        </div>
                        <span>
                            kaixo soy el span
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@section('scriptsErabiltzaile')
    @parent
 
    <script type="application/javascript">
    class erabiltzailea {
                constructor(p_inizialak, p_izena, p_email) {
                    this._inizialak=p_inizialak;
                    this._izena = p_izena;
                    this._email=p_email;
                }
   
                /* getterrak */
                inizialak(){
                    return this._inizialak;
                }
   
                izena() {
                    return this._izena;
                }
   
                email(){
                    return this._email
                }
   
                /* inizialen luzeera gehienez 2 eta gutxienez 0 izatea eta letra larriz egotea konprobatu
                baldintzak ez badira betetzen, return false */
                balidatuInizialak(){
                    let inizialak = this.inizialak();
                    if((inizialak.length==2)||(inizialak.length==1)&&(inizialak === inizialak.toUpperCase())){
                        return true;
                    }else{
                        return false;
                    }
                }
   
                /* izena soilik letrak izatea
                baldintza ez bada betetzen, return false */
                balidatuIzena(){
                    let izena = this.izena();
                    let patroia = /^[A-Za-z\s]+$/ /* \s-renik hutsuneak onartzen ditu */
                    return patroia.test(izena);
                }
   
                /* emaila emailaren formatua izatea. Bestela false */
                balidatuEmaila(){
                    let email = this.email();
                    let patroia = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    return patroia.test(email);
               
                }
            }
 
    </script>
@endsection


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
            $("#initials").val(initials);
        });

        $("#gordeBotoia").on("click", function(){
                let erabiltzaile=new erabiltzailea(
                    $("#initials").val(),
                    $("#name").val(),
                    $("#email").val()
                );
                balidatuEtaBidaliFormularioa(erabiltzaile);
            });
    });

        /* konprobatzaileak deitu. Konprobatzaileak true itzultzen badu, formularioa bidali*/
        function balidatuEtaBidaliFormularioa(erabiltzaile){
            if(konprobatuDatuGuztiak(erabiltzaile)){
                $("#formulario").submit();
                return true;
            }else{
                return false;
            }
        }

        /* hiru inputetan testua dagoela konprobatu
        bat hutsik badago - return false*/            
        function konprobatuDatuGuztiak(erabiltzaileDatuak){
            if((erabiltzaileDatuak.inizialak().length==0)||(!erabiltzaileDatuak.balidatuInizialak())){ 
                return false;
            }
            if((erabiltzaileDatuak.izena().length==0)||(!erabiltzaileDatuak.balidatuIzena())){
                return false;
            }
            if((erabiltzaileDatuak.email().length==0)||(!erabiltzaileDatuak.balidatuEmaila())){
                return false;
            }
            return true;
        }
</script>

@endsection