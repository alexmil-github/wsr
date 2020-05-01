@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (count($events) > 0)
            @foreach($events as $event)
                <div class="row justify-content-center mb-3">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9 text-white"><h5><i class="fa fa-calendar fa-fw"
                                                                            aria-hidden="true"></i>&nbsp;{{ $event->name }}
                                        </h5></div>
                                    <div class="col-md-3 float-right text-light">Дата проведения: <strong
                                            class="text-warning">{{ date("d.m.Y", strtotime($event->date)) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(count($themes)>0)
                                    @foreach($themes as $theme)
                                        @if($theme->events_id ==  $event->id)
                                            <div class="row justify-content-center ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <ul class="list-group">
                                                            <a class="text-decoration-none"
                                                                 href="{{ route('show_messages', ['themes_id' => $theme->id]) }}">

                                                                <li class="list-group-item list-group-item-action list-group-item-outline-secondary pointer">
                                                                    <button type="button" class="btn btn-outline-secondary btn-circle"><i class="fa fa-comments"></i></button>
                                                                    <strong> {{ $theme->name }}</strong>
                                                                    <span class="badge badge-secondary badge-pill float-right">14</span>
                                                                </li>
                                                            </a>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <hr>
                                <a href="" class="btn btn-md btn-my mb-3 float-right" role="button"
                                   data-toggle="modal" data-target="#modal_03" data-id="$event->id"
                                   data-content={{ $event->id }}>Создать тему</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{--Модальное окно добавления новой темы --}}
    <div class="modal" tabindex="-1" role="dialog" id="modal_03">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Новая тема</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal" id="add_theme_form">
                        @csrf
                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Наименование') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name='name'
                                       value="{{ isset($events->name) }}" placeholder="Введите наименование"
                                       autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Статус темы') }}</label>
                            <div class="col-md-6">
                                <select id="status" class="form-control" name="status">
                                    @if(count($statuses)>0)
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                    @if ($status->id == old('manager', "<div id='selected'></div>" ))
                                                    selected='selected'
                                                @endif>{{ $status->name}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div id="access_table">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Фамилия</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">Роль</th>
                                    <th scope="col">Доступ к теме</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($users)>0)
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{$user->id}}</th>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                @if(count($roles)>0)
                                                    @foreach($roles as $role)
                                                        {{ ($role->id == $user->role) ? $role->name : '' }}
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input access" checked
                                                           @if($user->id == Auth::user()->id || $user->is_admin == 1 )
                                                           disabled {{-- Запрет на снятие чекбокса для владельца темы и админа--}}
                                                        @endif
                                                    >
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-my">Создать</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>




@endsection
