@extends ('layouts.app')
@section ('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Редактировать пользователя</div>
                <div class="panel-body">

                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/edit/'.$user->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Имя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Ник</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                            <label for="permission" class="col-md-4 control-label">Права</label>

                            <div class="col-md-6">
                                <select id="permission" class="form-control" name="permission" required>
                                    <?php $permissions=array('none','Пользователь','Модератор','Администратор','Системный администратор'); ?>
                                    @for ($j=1; $j<=Auth::user()->permission; $j++)
                                        <option value="{{ $j }}"
                                        @if ($j==$user->permission) selected @endif
                                        >{{ $permissions[$j] }}</options>
                                    @endfor
                                </select>

                                @if ($errors->has('permission'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rank') ? ' has-error' : '' }}">
                            <label for="rank" class="col-md-4 control-label">Ранг</label>

                            <div class="col-md-6">
                                <select id="rank" class="form-control" name="rank" required>
                                    <?php $ranks=array('none','Интерн','Санитар','Мед. брат','Спасатель','Нарколог','Доктор','Психолог','Хирург','Зам. главного врача','Главный врач'); ?>
                                    @for ($i=1; $i<=10; $i++)
                                        <option value="{{ $i }}"
                                        @if ($i==$user->rank) selected @endif
                                        >{{ $ranks[$i] }}</options>
                                    @endfor
                                </select>

                                @if ($errors->has('rank'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rank') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Сохранить
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Изменение пароля пользователя</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/editpassword/'.$user->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Сохранить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
@stop