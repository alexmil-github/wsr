@if(count($messages)>0)
    @foreach($messages as $message)
        <div class="row justify-content-center ">
            <div class="col-md-12">
                <div class="form-group">
                    <ul class="list-group">
                        <li class="list-group-item ">
                            <div class="row">
                                <div class="col col-md-2 text-center">
                                    <h5> {{ $message->user->last_name }} {{ $message->user->name }} </h5>
                                    <img class="img-thumbnail border-success" src="{{ $message->user->photo }}"
                                         alt="{{ $message->user->name }} ">
                                    <small>Изменено:</small>
                                </div>
                                <div class="col col-md-9">
                                    <div class="row">
                                        <small>Создано: {{date("d.m.Y",strtotime($message->created_at))}}</small><br>
                                    </div>
                                    <div class="row mt-1">
                                        {{ $message->message }}
                                    </div>
                                </div>
                                <div class="col col-md-1">
                                    кнопки
                                </div>

                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    @endforeach
    <div id="messagesBlock"></div>
    <div class="text-center ">{{ $messages->render() }}</div>

@endif

