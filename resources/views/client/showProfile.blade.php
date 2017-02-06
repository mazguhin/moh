@extends ('layouts.app')
@section ('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Просмотр клиента 

                    @if (Auth::check() && Auth::user()->isModer())
                    <!-- EDIT -->
                    <a href="/client/edit/{{ $client->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>
                    
                    <!-- DELETE -->
                    <a href="/client/delete/{{ $client->id }}">
                      <a class="btn btn-danger btn-sm" href="/client/delete/{{ $client->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('delete-form{{ $client->id }}').submit();">
                                   <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <form id="delete-form{{ $client->id }}" action="/client/delete/{{ $client->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </a>
                    @endif

                </div>
                <div class="panel-body text-center">

                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif

                            <p><b>Имя:</b> {{ $client->name }}</p>
                            <p><b>Организация:</b> {{ $client->rank->organization->name }}</p>
                            <p><b>Ранг:</b> {{ $client->rank->name }}</p>
                            <p><b>Наркозависимость:</b> {{ $client->drugAddiction }}</p>
                            <p><b>Пройдено сеансов:</b> {{ $client->countSession }}</p>
                            <p><b>Гепатит B:</b> {{ $client->hepatitisB }}</p>
                            <p><b>Гепатит C:</b> {{ $client->hepatitisC }}</p>
                            <p><b>ВИЧ:</b> {{ $client->HIV }}</p>
                            <p><b>Стафилококки:</b> {{ $client->staphylococcus }}</p>
                            <p><b>Аллергии:</b> {{ $client->allergies }}</p>
                            <p><b>Зрение:</b> {{ $client->vision }}</p>
                            <p><b>Дополнения:</b> {{ $client->description }}</p>
              
                </div>
            </div>
        </div>
    </div>
@stop