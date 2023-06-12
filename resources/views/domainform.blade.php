@extends('layouts.master')
@section('title','Domain lista')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="border p-3 mt-5">
                <h1 class="text-center">Domain rögzítése</h1>
                <div class="text-center">
                    <a href="{{route('listazas')}}" class="btn btn-warning">Vissza</a>
                </div>

                @if (Session::has('rogzitve'))
                    <div class="alert alert-success">
                        {{Session::get('rogzitve')}}
                    </div>
                @endif
                

                <form method="POST">
                    @csrf
                    <div>
                        <label for="domain_nev">Domain név:</label>
                        <input type="text" name="domain_nev" id="domain_nev" class="form-control" value="{{old('domain_nev')}}">
                        @error('domain_nev')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label for="domain_nev_human">Domain név olvashatóan:</label>
                        <input type="text" name="domain_nev_human" id="domain_nev_human" class="form-control" value="{{old('domain_nev_human')}}">
                        @error('domain_nev_human')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label for="lejarati_ido">Lejárati idő:</label>
                        <input type="date" name="lejarati_ido" id="lejarati_ido" class="form-control" value="{{old('lejarati_ido')}}">
                        @error('lejarati_ido')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100">Rögzítés</button>
                    </div>
                    
                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
@endsection