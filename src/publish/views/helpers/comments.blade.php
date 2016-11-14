<?php
?>
               <ul class="comments-list">
    @foreach($extends->comments->where('parent_id',0) as $row)
  <!-- comment -->
  @php

  @endphp
        <li>
            <div class="comment-in">
                <a href="#"><img src="{{ $row->user->img() }}"  class="avatar"></a>
                <div>
                    <span class="ii">
        <i class="fa fa-user"></i>
        <em><a href="javascript:;">{{ @$row->user->name }}</a></em>
        <i class="fa fa-clock-o"></i>
        <em>{{ Time::get($row->created_at) }}</em>
        </span>
                    <p>{{ $row->comment }}</p>
                </div>
            </div>
                <ul>
                    @foreach ($row->replays as $replay)
                        <li>
                        <div class="comment-in">
                            <a href="#"><img src="{{ $replay->user->img() }}"  class="avatar"></a>
                            <div>
                                <span class="ii">
                    <i class="fa fa-user"></i>
                    <em><a href="javascript:;">{{ @$replay->user->name }}</a></em>
                    <i class="fa fa-clock-o"></i>
                    <em>{{ Time::get($replay->created_at) }}</em>
                    </span>
                                <p>{{ $replay->comment }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    <span class="result"></span>
                    @if (auth()->check())
                        <li>
                        {!! Form::open(['url'=>'comment/'.$extends->getTable().'/'.$extends->id.'/'.$row->id,'class'=>'comment-form']) !!}
                            <div class="comment-in">
                                <a href="#"><img src="{{ auth()->user()->img() }}"  class="avatar"></a>
                                <div>
                                    <span class="ii">
                        <i class="fa fa-user"></i>
                        <em><a href="javascript:;">{{ auth()->user()->name }}</a></em>
                        </span>
                                    <p><textarea rows="2" name="comment" class="comment-msg"></textarea></p>
                                <input type="submit" value="{{ trans('lang.replay') }}">
                                <div class="clear"></div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        </li>
                    @endif
                </ul>
        </li>
        <!-- //comment -->
    @endforeach 
@if (auth()->check())
    <span class="result"></span>
    <li>
    {!! Form::open(['url'=>'comment/'.$extends->getTable().'/'.$extends->id.'/0','class'=>'comment-form']) !!}
        <div class="comment-in">
            <a href="#"><img src="{{ auth()->user()->img() }}"  class="avatar"></a>
            <div>
                <span class="ii">
    <i class="fa fa-user"></i>
    <em><a href="javascript:;">{{ auth()->user()->name }}</a></em>
    </span>
                <p><textarea rows="3" name="comment" class="comment-msg"></textarea></p>
            <input type="submit" value="{{ trans('lang.send_comment') }}">
            <div class="clear"></div>
            </div>
        </div>
    {!! Form::close() !!}
    </li>
@endif
    

</ul>

