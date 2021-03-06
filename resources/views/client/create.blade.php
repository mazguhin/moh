@extends ('layouts.app')
@section ('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Добавить клиента</div>
                <div class="panel-body">

                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/client/store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Имя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rank') ? ' has-error' : '' }}">
                            <label for="rank" class="col-md-4 control-label">Ранг</label>

                            <div class="col-md-6">
                                <select id="rank" class="form-control" name="rank" required>
                                   @foreach ($ranks as $rank)                                   
                                        <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                                   @endforeach
                                </select>

                                @if ($errors->has('rank'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rank') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('drugAddiction') ? ' has-error' : '' }}">
                            <label for="drugAddiction" class="col-md-4 control-label">Наркозависимость</label>

                            <div class="col-md-6">
                                <input id="drugAddiction" type="number" class="form-control" name="drugAddiction" value="{{ old('drugAddiction') }}" required>

                                @if ($errors->has('drugAddiction'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('drugAddiction') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('countSession') ? ' has-error' : '' }}">
                            <label for="countSession" class="col-md-4 control-label">Пройдено сеансов</label>

                            <div class="col-md-6">
                                <input id="countSession" type="number" class="form-control" name="countSession" value="{{ old('countSession') }}" required>

                                @if ($errors->has('countSession'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('countSession') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hepatitisB') ? ' has-error' : '' }}">
                            <label for="hepatitisB" class="col-md-4 control-label">Гепатит B</label>

                            <div class="col-md-6">
                                <select id="hepatitisB" class="form-control" name="hepatitisB" required>
                                    <option value="Отрицательный">Отрицательный</option>
                                    <option value="Положительный">Положительный</option>
                                </select>

                                @if ($errors->has('hepatitisB'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hepatitisB') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hepatitisC') ? ' has-error' : '' }}">
                            <label for="hepatitisC" class="col-md-4 control-label">Гепатит C</label>

                            <div class="col-md-6">
                                <select id="hepatitisC" class="form-control" name="hepatitisC" required>
                                    <option value="Отрицательный">Отрицательный</option>
                                    <option value="Положительный">Положительный</option>
                                </select>

                                @if ($errors->has('hepatitisC'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hepatitisC') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('HIV') ? ' has-error' : '' }}">
                            <label for="HIV" class="col-md-4 control-label">ВИЧ</label>

                            <div class="col-md-6">
                                <select id="HIV" class="form-control" name="HIV" required>
                                    <option value="Отрицательный">Отрицательный</option>
                                    <option value="Положительный">Положительный</option>
                                </select>

                                @if ($errors->has('HIV'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('HIV') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('staphylococcus') ? ' has-error' : '' }}">
                            <label for="staphylococcus" class="col-md-4 control-label">Стафилококки</label>

                            <div class="col-md-6">
                                <select id="staphylococcus" class="form-control" name="staphylococcus" required>
                                    <option value="Отрицательный">Отрицательный</option>
                                    <option value="Нейтральный">Нейтральный</option>
                                    <option value="Положительный">Положительный</option>
                                </select>

                                @if ($errors->has('staphylococcus'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('staphylococcus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('allergies') ? ' has-error' : '' }}">
                            <label for="allergies" class="col-md-4 control-label">Аллергии</label>

                            <div class="col-md-6">
                                <select id="allergies" class="form-control" name="allergies" required>
                                    <option value="Отсутствуют">Отсутствуют</option>
                                    <option value="Присутствуют">Присутствуют</option>
                                </select>

                                @if ($errors->has('allergies'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('allergies') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('vision') ? ' has-error' : '' }}">
                            <label for="vision" class="col-md-4 control-label">Зрение</label>

                            <div class="col-md-6">
                                <select id="vision" class="form-control" name="vision" required>
                                    <option value="Норма">Норма</option>
                                    <option value="Ниже нормы">Ниже нормы</option>
                                    <option value="Выше нормы">Выше нормы</option>
                                </select>

                                @if ($errors->has('vision'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vision') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Дополнения</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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
    </div>
@stop