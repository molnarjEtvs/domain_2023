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
                        <input type="text" name="domain" id="domain" placeholder="pl.: example.com" class="form-control" value="{{$domain}}">
                    </div>
                    <div class="col-3">
                        <select name="aktiv" id="aktiv" class="form-select">
                            <option value="all">Mindegy</option>
                            <option value="aktiv" @if ($aktiv =="aktiv")
                                selected
                            @endif >Csak Aktivak</option>
                            <option value="lejart"  @if ($aktiv =="lejart")
                            selected
                        @endif>Lejártak</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <button type="submit" class="btn btn-primary w-100">Keresés</button>
                    </div>

                    <div class="col-2">
                        @if ($alap == '0')
                            <a href="{{route('listazas')}}" class="btn btn-danger">Feltételek törlése</a>
                        @endif
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
                        <tr id="domainSor_{{ $egyDomain->d_id }}">
                            <td>#{{ $egyDomain->d_id }}</td>
                            <td>{{ $egyDomain->domain_nev }}</td>
                            <td>{{ $egyDomain->domain_nev_human }}</td>
                            <td>{{ $egyDomain->rogzitesi_ido }}</td>
                            <td id='lejarati_ido_{{ $egyDomain->d_id }}'>{{ $egyDomain->lejarati_ido }}</td>
                            <td>
                                <button class="btn btn-danger gombok" onclick="torlesMegerositese({{ $egyDomain->d_id }});"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                  </svg></button>
                                
                                <button onclick="location.href='{{route('domainModositas',$egyDomain->d_id)}}';" class="btn btn-warning gombok"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                  </svg></button>


                                <button class="btn btn-success gombok" onclick="hosszabbitasMegerosites({{ $egyDomain->d_id }});">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
                                        <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                      </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    
                </table>

                {{ $domainek->links() }}
            </div>
        </div>
    </div>
</div>


<script>
    function torlesMegerositese(domainId){
        $.ajax({
            url: 'domain-torles-megerositese',
            method: 'POST',
            data:{"domainId":domainId},
            beforeSend:function(){
                //Amíg nem kapok választ
                $(".gombok").attr("disabled",true);
            },
            success:function(data){
                //Ha megvan a válasz
                $(".gombok").attr("disabled",false);
                $("#modal-title").html(data['modal-title']);
                $("#modal-body").html(data['modal-body']);
                $("#modal-footer").html(data['modal-footer']);
                $('#myModal').modal('show');
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }


    function hosszabbitasMegerosites(domainId){
        $.ajax({
            url: 'domain-hosszabbitas-megerositese',
            method: 'POST',
            data:{"domainId":domainId},
            beforeSend:function(){
                //Amíg nem kapok választ
                $(".gombok").attr("disabled",true);
            },
            success:function(data){
                //Ha megvan a válasz
                $(".gombok").attr("disabled",false);
                $("#modal-title").html(data['modal-title']);
                $("#modal-body").html(data['modal-body']);
                $("#modal-footer").html(data['modal-footer']);
                $('#myModal').modal('show');
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }


    function domainHosszabitas(domainId){
        $.ajax({
            url: 'domain-hosszabbitas',
            method: 'POST',
            data:{"domainId":domainId},
            beforeSend:function(){
                $('.gombok').attr('disabled',true);
            },
            success:function(data){
                $('.gombok').attr('disabled',false);
                if(data.error == false){
                    $("#lejarati_ido_"+domainId).html(data['hosszabbitott_datum']);
                    $('#myModal').modal('hide');
                }else{
                    alert('hiba történt!');
                }
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    function torlesDomain(domainId){
        $.ajax({
            url: 'domain-torles',
            method: 'POST',
            data:{"domainId":domainId},
            beforeSend:function(){
                //Amíg nem kapok választ
                $(".gombok").attr("disabled",true);
            },
            success:function(data){
                //Ha megvan a válasz
                $(".gombok").attr("disabled",false);
                if(data['error'] == false){
                    $('#myModal').modal('hide');
                    $("#domainSor_"+domainId).remove();
                }else{
                    for(i=0;i<data['errorMsg'].length;i++){
                        $("#modal-body").html(data['errorMsg'][i]); 
                    }
                    
                }
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
</script>

@endsection