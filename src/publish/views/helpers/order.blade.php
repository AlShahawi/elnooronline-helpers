@if (count($rows) > 0)
<ol class="dd-list ">
    @foreach($rows as $row)
    <?php
    $title = $name == 'menu' ? $row->page->trans('name') : $row->name;
    ?>
    <li class="dd-item dd3-item" data-id="{{ $row->id }}">
    <div class="dd-handle dd3-handle" title="{{ trans('lang.order') }}"> </div>
        <div class="dd3-content">
        {!! bsForm::deleteSelect($row->id) !!}
        @if (count($row->images('icon')) > 0)
            <img src="{{ $row->img('icon') }}" width="18">
        @else
        <i class="fa {{ $row->icon }}"></i>
        @endif
        {{ @$title }} 
        <div class="pull-right">
             {!! Btn::view($row->id) !!}
             {!! Btn::edit($row->id) !!}
             {!! Btn::delete($row->id,$title) !!}
        </div>
        </div>
        {!! \Control::orderHtml($name,$parentName,$row->id) !!}
    </li>
    @endforeach 
</ol>
@endif