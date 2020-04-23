@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Панель администратора</div>

                    <div class="card-body">
                        <nav class="nav">
                            <a class="nav-link disabled" href="#">Мероприятия</a>
                            <a class="nav-link active" href="#">Категории форума</a>
                        </nav>
                        <br>
                        @if (count($events) > 0)
                            <h3>Мероприятия</h3>
                            <form action="events/update" method="POST" class="form-horizontal">
                                @csrf
                                @method('PATCH')
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th width="279" valign="top">
                                        Наименование мероприятия
                                </th>
                                <th width="213" valign="top">
                                    Дата проведения
                                </th>
                                <th width="213" valign="top">
                                    Менеджер
                                </th>
                            </tr>
                            @foreach($events as $event)
                                <tr>
                                    <td width="279" valign="top">
                                            {{ $event->name }}
                                    </td>
                                    <td width="213" valign="top">
                                        {{ date("d.m.Y",strtotime($event->date)) }}
                                    </td>
                                    <td width="213" valign="top">
                                            <select id="{{ $event->id }}" class="form-control" name="{{ $event->id }}">
                                            <option value=""> Не выбран</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"
                                                        @if ($user->id == old('manager', $event->manager))
                                                            selected="selected"
                                                        @endif>{{ $user->name}} {{$user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <button class="btn btn-primary">Сохранить</button>
                            </form>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
