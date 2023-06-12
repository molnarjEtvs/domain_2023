@extends('layouts.master')
@section('title','Domain lista')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Domain Lista</h1>
            <form method="GET" class="mt-3">
                <div class="row">
                    <div class="col-1">
                        <a href="{{route('domainRogzites')}}" class="btn btn-success">+</a>
                    </div>

                    <div class="col-4">
                        <input type="text" name="domain" id="domain" placeholder="pl.: example.com" class="form-control">
                    </div>

                    <div class="col-3">
                        <select name="aktiv" id="aktiv" class="form-select">
                            <option value="all">Mindegy</option>
                            <option value="aktiv">Csak Aktivak</option>
                            <option value="lejart">Lejártak</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <button type="submit" class="btn btn-primary w-100">Keresés</button>
                    </div>

                    <div class="col-2">

                    </div>
                </div>
            </form>         
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-warning table-striped table-hover">
                    <tr>
                        <th>#id</th>
                        <th>Domain</th>
                        <th>Domain olvasható</th>
                        <th>Rögzítve</th>
                        <th>Lejárat</th>
                        <th>Műveletek</th>
                    </tr>
                    @foreach ($domainek as $egyDomain)
                        <tr>
                            <td>#{{ $egyDomain->d_id }}</td>
                            <td>{{ $egyDomain->domain_nev }}</td>
                            <td>{{ $egyDomain->domain_nev_human }}</td>
                            <td>{{ $egyDomain->rogzitesi_ido }}</td>
                            <td>{{ $egyDomain->lejarati_ido }}</td>
                            <td>
                                Törlés
                                Módosítást
                                Hosszabítást
                            </td>
                        </tr>
                    @endforeach
                    
                </table>

                {{ $domainek->links() }}
            </div>
        </div>
    </div>
</div>


@endsection