@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white"><h5>Панель администратора</h5></div>

                    <div class="card-body">
                        <h3>Мероприятия</h3>
                        <hr>
                        <a href="" class="btn btn-md btn-outline-dark mb-3 float-right" role="button" data-toggle="modal"
                           data-target="#modal_01">Добавить новое</a>
                        <br>
                        @if (count($events) > 0)
                            <form action="{{ route('update_events') }}" method="POST" class="form-horizontal">
                                @csrf
                                @method('PATCH')
                                <table class="table  table-striped table-responsive-sm" id="filter-table">
                                    <tbody>
                                    <tr>
                                        <th valign="top">
                                            Наименование мероприятия
                                        </th>
                                        <th valign="top">
                                            Дата проведения
                                        </th>
                                        <th valign="top">
                                            Менеджер
                                        </th>
                                        <th valign="top">
                                        </th>
                                    </tr>
                                    <tr class='table-filters'>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Поиск...">
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    @foreach($events as $event)
                                        <tr class='table-data'>
                                            <td  valign="top">
                                                {{ $event->name }}
                                            </td>
                                            <td width="20%" valign="top">
                                                {{ date("d.m.Y",strtotime($event->date)) }}
                                            </td>
                                            <td valign="top">
                                                <select class="form-control" name="{{ $event->id }}">
                                                    <option value="">Не выбран</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}"
                                                                @if ($user->id == old('manager', $event->manager))
                                                                selected="selected"
                                                            @endif>{{ $user->name}} {{$user->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td valign="top" class="float-right">
                                                <a href="#" class="btn btn-md btn-outline-dark" data-toggle="modal"
                                                   data-target="#modal_02" data-content="{{ $event }}">
                                                    <i class="fa fa-pencil fa-fw"></i>
                                                </a>
                                                <a href="{{ route('delete_event', ['events_id' => $event->id]) }}"
                                                   class="btn btn-md btn-outline-danger">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-my">Сохранить изменения</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Модальное окно добавления нового мероприятия--}}
    <div class="modal" tabindex="-1" role="dialog" id="modal_01">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Новое мероприятие</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{  route ('create_event') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Наименование') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name='name'
                                       value="{{ isset($events->name) }}" placeholder="Введите наименование мероприятия"
                                       autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Дата проведения') }}</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name='date'
                                       value="{{ isset($events->date) }}" placeholder="Введите дату" autofocus required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-my">Добавить</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{--Модальное окно редактирования мероприятия--}}
    <div class="modal" tabindex="-1" role="dialog" id="modal_02">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Редактирование мероприятия</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal" id="edit_form">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Наименование') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name='name' placeholder="Наименование"
                                       autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Дата проведения') }}</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name='date' placeholder="Дата"
                                       autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Менеджер') }}</label>
                            <div class="col-md-6">
                                <select id="manager" class="form-control" name="manager">
                                    <option value=""> Не выбран</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                                @if ($user->id == old('manager', "<div id='selected'></div>" ))
                                                selected='selected'
                                            @endif>{{ $user->name}} {{$user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-my">Сохранить</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection

