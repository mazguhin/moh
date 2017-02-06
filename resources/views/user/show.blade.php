@extends ('layouts.app')
@section ('content')
    <div class="row">

    @if (session('msg'))
    <div class="col-sm-10 col-sm-offset-1">
        <div class="alert alert-info">{{ session('msg') }}</div> 
    </div>
    @endif

            <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                    <div class="panel-heading">Найти пользователя</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/search') }}">
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
                <div class="panel-heading">Все пользователи
                <a href="/user/create">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                      </button>
                </a>
                <a href="/user/showdisable">
                      <button type="button" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                </a>
                </div>
                <div class="panel-body">

                    @if (count($users) > 0)
    <table class="table table-striped">

        <thead>
            <th>Имя</th>
            <th>Ник</th>
            <th>Ранг</th>
            <th>Права</th>
            <th>Дата создания</th>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><?php $ranks=array('none','Интерн','Санитар','Мед. брат','Спасатель','Нарколог','Доктор','Психолог','Хирург','Зам. главного врача','Главный врач'); ?>
                {{ $ranks[$user->rank] }}</td>
                <td><?php $permissions=array('none','Пользователь','Модератор','Администратор','Системный администратор'); ?>
                {{ $permissions[$user->permission] }}</td>
                <td>{{ $user->created_at->format('d/m/Y h:m:s') }}</td>
                <td>

                  <p>
                    <!-- EDIT -->
                    <a href="/user/edit/{{ $user->id }}">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                    </a>
                    
                    <!-- DISABLE -->
                    <a href="/user/disable/{{ $user->id }}">
                      <a class="btn btn-danger btn-sm" href="/user/disable/{{ $user->id }}"
                          onclick="event.preventDefault();
                                   document.getElementById('disable-form{{ $user->id }}').submit();">
                                   <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>

                      <form id="disable-form{{ $user->id }}" action="/user/disable/{{ $user->id }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </a>
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