@extends ('layouts.app')
@section ('content')
    <div class="row">

    @if (session('msg'))
    <div class="col-sm-10 col-sm-offset-1">
        <div class="alert alert-info">{{ session('msg') }}</div> 
    </div>
    @endif

        @if (Auth::check() && Auth::user()->isModer())
        <div class="col-sm-10 col-sm-offset-1">
                
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить клиента</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/client/create') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
                                <label for="organization" class="col-md-4 control-label">Организация</label>

                                <div class="col-md-6">
                                    <select name="organization" id="organization" class="form-control" required>
                                        @foreach ($organizations as $organization)
                                        @if ($organization->name!="MOH")
                                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('organization'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('organization') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Добавить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        @endif

        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                    <div class="panel-heading">Найти клиента</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/client/search') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Ник</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" id="name">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    Например: Evgen_Pepsi
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Найти
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Все клиенты</div>
                <div class="panel-body">


                    @if (count($clients) > 0)
    <table class="table table-striped">

        <thead>
            <th>Ник</th>
            <th>Организация</th>
            <th>Ранг</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </thead>

        <tbody>
            @foreach ($clients as $client)
            <tr>
                
                <td>{{ $client->name }}</td>
                <td>{{ $client->rank->organization->name }}</td>
                <td>{{ $client->rank->name }}</td>
                <td>{{ $client->created_at->format('d/m/Y') }}</td>
                <td>

                  <p>

                    <a href="/client/show/{{ $client->id }}">
                      <button type="button" class="btn btn-default btn-sm">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </button>
                    </a>

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

                  </p>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
                </div>
            </div>
        </div>
    </div>
@stop