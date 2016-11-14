<?php 

function alert_success($text,$attr =[])
{
    $cls = ['class'=>'alert alert-success'];
        if (!isset($attr['class'])) { $attr['class'] = $cls['class']; }

            $attributes = '';
        foreach ($attr as $key => $value) {
            $attributes .= $key.'="'.$value.'" ';
        }
    return '<div '.$attributes.'>
                <strong>'.$text.'</strong>
            </div>';
}

function alert_danger($text)
{
    return '<div class="alert alert-danger">
                <strong>'.$text.'</strong>
            </div>';
}

function alert_errors($errors,$attr = [])
{
    if (count($errors) > 0) 
    {
        $cls = ['class'=>'alert alert-danger'];
        if (!isset($attr['class'])) { $attr['class'] = $cls['class']; }
            $attributes = '';
        foreach ($attr as $key => $value) {
            $attributes .= $key.'="'.$value.'" ';
        }
        $msg = '<div '.$attributes.'><ul>';
                foreach ($errors->all() as $error)
                {
                    $msg .= '<li>'.$error.'</li>';
                }
        $msg .= '</ul></div>';
                    
         return $msg;      
    }
}

function alert_warning($text)
{
    return '<div class="alert alert-warning">
                <strong>'.$text.'</strong>
            </div>';
}

function alert_loading()
{
    return '<div class="alert alert-warning">
            <strong class="text-center"><img src="'.url('public/assets/cpanel/img/loading.gif').'" width="20" alt=""></strong>
            </div>';
}