@if (count($rows) > 0)
    <ul class="{{ $parent == 0 ? ($position == 'join_us' ? 'list-unstyled' : '') : ($position == 'important_links' ? 'list-unstyled' : '') }}">
        @foreach($rows as $row)
    <?php
    $cat = $name == 'menu' ? $row->page : $row;
                $nameUrl = str_plural($name);
    if ($name == 'menu') {
                $url = empty($row->page->urlname) ? url($nameUrl.'/'.$row->page->id) : url($nameUrl.'/'.$row->page->urlname);
                $url = !empty($row->page->out_url) ? $row->page->out_url : $url;
                $model = '\App\\'.str_singular(ucfirst($name));
                $countChild = $model::where('parent',$row->id)->count();
                if ($countChild > 0) { $url = 'javascript:;'; }
    }else{
        $url = url($nameUrl.'/'.$row->id);
    }
    ?>

                    <li><a href="{{ $url }}">
                 @if (count($row->images('icon_img')) > 0)
                    <img src="{{ $row->img('icon_img') }}" width="18">
                @else
                <i class="fa {{ $row->icon }}"></i>
                @endif

                    {{ $cat->name }}</a>
                        {!! \Control::mainOrderHtml($name,$parentName,$row->id,$position) !!}
                    </li>
        @endforeach 
    </ul>
@endif
