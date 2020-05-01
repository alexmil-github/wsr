@if(count($messages)>0)
                                @foreach($messages as $message)
                                    <div class="row justify-content-center ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <ul class="list-group">
                                                    <li class="list-group-item list-group-item-secondary ">
                                                        {{ $message->message }}

                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
    <div id="messagesBlock"></div>
    <div class="text-center">{{ $messages->render() }}</div>

@endif

