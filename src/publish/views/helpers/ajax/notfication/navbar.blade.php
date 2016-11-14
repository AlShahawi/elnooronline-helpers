<?php
if (auth()->user()->rule == 'admin') 
{
   $notfications = auth()->user()->adminNotfications()->orderBy('created_at','desc')->limit(50)->get();
}else{
    $notfications = auth()->user()->importNotfications()->orderBy('created_at','desc')->limit(50)->get();
}
// $notfications = App\Notfication::where('extends_name','user')->where('extends_id','!=',user('id'))
//     ->selectRaw('*,SUM(readed) as sum,
//         COUNT(readed) as count,
//         MAX(created_at) as created,
//         MAX(readed) as readed,
//         notifiable_type,
//         belongs_id,
//         MAX(belongs_id) as last_chat
//         ')
//     ->groupBy('extends_id','notifiable_type')->orderBy('created','desc')->limit(50)->get();
?>

@forelse ($notfications as $notfication)
<?php
$model = '\App\\'.ucfirst(str_singular(camel_case($notfication->notifiable_type)));
$morphed = $model::find($notfication->notifiable_id);

$url = url(cp.str_plural(strtolower(snake_case($notfication->notifiable_type))).'/'.$morphed->id);

 $except_urls = ['langs','settings'];
if (in_array($notfication->notifiable_type, $except_urls)) 
{
    $url = url(cp.'settings/'.($notfication->notifiable_type == 'langs' ? 'languages' : 'main_settings'));
}
if ($notfication->notifiable_type == 'options') 
{
    $url = 'javascript:;';
}
$colum = !empty($morphed->colum) ? $morphed->colum : 'name';
$user_id = $notfication->user ? $notfication->user->id : 0;

$msg = trans('notfication.'.$notfication->type,
    [
        'sender' => __($notfication->sender,'name',trans('lang.User')),
        'user' => __($notfication->user,'name',trans('lang.User')),
        'morphed' => __($morphed,$colum,null),
    ]);
if ($user_id == user('id')) 
{
    $msg = trans('notfication.'.$notfication->type.'_me',
    [
        'sender' => __($notfication->sender,'name',trans('lang.User')),
        'user' => __($notfication->user,'name',trans('lang.User')),
        'morphed' => __($morphed,$colum,null),
    ]);
}

?>
<li>
    <a href="{{ $url }}">
        <span class="time">{{ Time::get($notfication->created_at) }}</span>
        <span class="details">
            {{--<span class="label label-sm label-icon bg-red-thunderbird bg-font-red-thunderbird">
                 <i class="icon-bell"></i></span> --}}
            <span class="{{ $notfication->readed == 0 ? ' bold' : '' }}"> {!! $msg !!}</span>
    </a>
</li>

@empty

    <li><a href="javascript:;">{{ trans('lang.empty_notfication') }}</a></li>

@endforelse
