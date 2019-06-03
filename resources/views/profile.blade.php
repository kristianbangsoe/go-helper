@extends('layouts.app')

@section('content')
    <div class="profile pt-5">
    
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profiloplysninger</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Ændre password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="email-tab" data-toggle="tab" href="#cemail" role="tab" aria-controls="cemail" aria-selected="false">Ændre email</a>
                </li>
            </ul>
        </div>
        
        <div class="row card tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profile">                         
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <div class="px-5 pt-4">
                        <p class="h4 row mb-4 pb-2 border-bottom">Profiloplysninger</p>
                        <div class="d-flex flex-row row">
                            <div class="form-group d-flex flex-column" id="my-profile">
                                <img class="pro-img" src="/uploads/avatars/{{ $user->avatar }}">
                                <input  type="file" name="avatar" class="mt-2 file-input">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                            </div>
                            <div class=" d-flex flex-column col">
                                <div class=" d-flex flex-row ">
                                    <div class="form-group col">
                                        <label for="name" class="col-form-label">{{ __('Fornavn') }}</label>
                                            <input id="name" autocomplete="off" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ Auth::user()->name }}" required autofocus>
                                            @if ($errors->has('firstname'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                            @endif 
                                    </div>
                                    <div class="form-group col">
                                        <label for="lastname" class=" col-form-label">{{ __('Efternavn') }}</label>
                    
                                        <div>
                                            <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ Auth::user()->lastname }}" required autofocus>                                

                                            @if ($errors->has('lastname'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>  
                                </div>
                                <div class=" d-flex flex-row ">
                                    <div class="form-group col">
                                            <label for="email" class=" col-form-label">{{ __('E-mail') }}</label>
    
                                            <div class="">
                                                <input readonly id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required>
    
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="form-group col">
                                        <label for="birth" class=" col-form-label">{{ __('Fødselsdag') }}</label>
                                        <div>
                                            <input id="birth" type="date" class="form-control{{ $errors->has('birth') ? ' is-invalid' : '' }}" name="birth" value="{{ Auth::user()->birth }}" required autofocus>                                

                                            @if ($errors->has('birth'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('birth') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>  
                                </div> 
                                
                                <div class=" d-flex flex-row ">
                                    <div class="form-group col">
                                        <label for="zip" class=" col-form-label">{{ __('Postnummer') }}</label>

                                        <div class="">
                                            <input id="zip" type="text" class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip" value="{{ Auth::user()->zip }}" required>

                                            @if ($errors->has('zip'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('zip') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label for="city" class=" col-form-label">{{ __('By') }}</label>
                                        <div>
                                            <input id="city" readonly type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ Auth::user()->city }}" required autofocus>                                

                                            @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>  
                                </div> 

                                <div class=" d-flex flex-row ">
                                        <div class="form-group col">
                                            <label for="street" class=" col-form-label">{{ __('Gade og nr.') }}</label>
    
                                            <div class="">
                                                <input id="street" type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" name="street" value="{{ Auth::user()->street }}" required>
    
                                                @if ($errors->has('street'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('street') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <label for="phone" class=" col-form-label">{{ __('Telefonnummer') }}</label>
                                            <div>
                                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" placeholder="Dit telefonnummer" value="{{ Auth::user()->phone }}" required autofocus>                                
    
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>  
                                    </div> 

                            </div>      
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="px-5 pt-4">
                        <div class="row form-group mb-4">             
                            <label class="h4" for="bio">Din Selvbiografi</label>
                            <p class="small w-100">Beskriv dig selv, hvem du er og hvorfor man lige skal vælge dig til en opgave</p>
                            <textarea name="bio" class="form-control" id="bio" rows="3">{{ Auth::user()->bio }}</textarea>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="px-5 pt-4">
                        <div class="row border-bottom mb-4">
                            <p class="h4  pt-3 pb-0 ">Hvilke opgaver kan du løse?</p>
                        </div>
                        <categories-list class="pb-5" post-title="{{ Auth::user()->id}}"></categories-list>
                        <div class="edit-bar">
                            <div class="container">
                                <div class="row">
                                    <input type="submit" value="Opdater profil" class="pull-right btn btn-lg btn-red">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="cemail">
                <form method="POST" action="{{ route('password.email') }}">
                    <div class="px-5 pt-4">
                        <p class="h4 row mb-4 pb-2 border-bottom">Skift email</p>
                        @csrf
                        <div class="d-flex flex-row row">
                            <div class="form-group col px-0">
                                <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email}}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>

@endsection