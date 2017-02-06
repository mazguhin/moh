@extends ('layouts.app')
@section ('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Выключенные пользователи</div>
                <div class="panel-body">

                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif

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