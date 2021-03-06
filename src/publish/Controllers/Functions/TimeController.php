<?php

namespace App\Http\Controllers\Functions;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TimeController extends Controller
{
    static $Day; 
    static $Month; 
    static $Year; 


  static  function intPart($floatNum) 
    { 
        if ($floatNum< -0.0000001) 
        { 
            return ceil($floatNum-0.0000001); 
        } 
        return floor($floatNum+0.0000001); 
    } 

  static  function ConstractDayMonthYear($date,$format="YYYY/MM/DD") // extract day, month, year out of the date based on the format. 
    { 
        self::$Day=""; 
        self::$Month=""; 
        self::$Year=""; 

        $format=strtoupper($format); 
        $format_Ar= str_split($format); 
        $srcDate_Ar=str_split($date); 

        for ($i=0;$i<count($format_Ar);$i++) 
        { 

            switch($format_Ar[$i]) 
            { 
                case "D": 
                    self::$Day.=$srcDate_Ar[$i]; 
                    break; 
                case "M": 
                    self::$Month.=$srcDate_Ar[$i]; 
                    break; 
                case "Y": 
                    self::$Year.=$srcDate_Ar[$i]; 
                    break; 
            } 
        } 

    } 


   public static  function h_g($date,$format="YYYY/MM/DD") // $date like 10121400, $format like DDMMYYYY, take date & check if its hijri then convert to gregorian date in format (DD-MM-YYYY), if it gregorian the return empty; 
    { 

       self::ConstractDayMonthYear($date,$format); 
        $d=intval(self::$Day); 
        $m=intval(self::$Month); 
        $y=intval(self::$Year); 

        if ($y<1700) 
        { 

        $jd=self::intPart((11*$y+3)/30)+354*$y+30*$m-self::intPart(($m-1)/2)+$d+1948440-385; 

        if ($jd> 2299160 ) 
        { 
            $l=$jd+68569; 
            $n=self::intPart((4*$l)/146097); 
            $l=$l-self::intPart((146097*$n+3)/4); 
            $i=self::intPart((4000*($l+1))/1461001); 
            $l=$l-self::intPart((1461*$i)/4)+31; 
            $j=self::intPart((80*$l)/2447); 
            $d=$l-self::intPart((2447*$j)/80); 
            $l=self::intPart($j/11); 
            $m=$j+2-12*$l; 
            $y=100*($n-49)+$i+$l; 
        } 
        else 
        { 
            $j=$jd+1402; 
            $k=self::intPart(($j-1)/1461); 
            $l=$j-1461*$k; 
            $n=self::intPart(($l-1)/365)-self::intPart($l/1461); 
            $i=$l-365*$n+30; 
            $j=self::intPart((80*$i)/2447); 
            $d=$i-self::intPart((2447*$j)/80); 
            $i=self::intPart($j/11); 
            $m=$j+2-12*$i; 
            $y=4*$k+$n+$i-4716; 
        } 

        if ($d<10) 
            $d="0".$d; 

        if ($m<10) 
            $m="0".$m; 

        return $y.'/'.$m.'/'.$d; 
        } 
        else 
            return ""; 
    } 



public static function g_h($date,$string=false,$format="YYYY/MM/DD") // $date like 10122011, $format like DDMMYYYY, take date & check if its gregorian then convert to hijri date in format (DD-MM-YYYY), if it hijri the return empty; 
     { 
       self::ConstractDayMonthYear($date,$format); 
        $d=intval(self::$Day); 
        $m=intval(self::$Month); 
        $y=intval(self::$Year); 

        if ($y>1700) 
        { 
        if (($y>1582)||(($y==1582)&&($m>10))||(($y==1582)&&($m==10)&&($d>14))) 
        { 
            $jd=self::intPart((1461*($y+4800+self::intPart(($m-14)/12)))/4)+self::intPart((367*($m-2-12*(self::intPart(($m-14)/12))))/12)-self::intPart((3*(self::intPart(($y+4900+self::intPart(($m-14)/12))/100)))/4)+$d-32075; 
        } 
        else 
        { 
            $jd = 367*$y-self::intPart((7*($y+5001+self::intPart(($m-9)/7)))/4)+self::intPart((275*$m)/9)+$d+1729777; 
        } 

        $l=$jd-1948440+10632; 
        $n=self::intPart(($l-1)/10631); 
        $l=$l-10631*$n+354; 
        $j=(self::intPart((10985-$l)/5316))*(self::intPart((50*$l)/17719))+(self::intPart($l/5670))*(self::intPart((43*$l)/15238)); 
        $l=$l-(self::intPart((30-$j)/15))*(self::intPart((17719*$j)/50))-(self::intPart($j/16))*(self::intPart((15238*$j)/43))+29; 
        $m=self::intPart((24*$l)/709); 
        $d=$l-self::intPart((709*$m)/24); 
        $y=30*$n+$j-30; 

        if ($d<10) 
            $d="0".$d; 

        if ($m<10) 
            $m="0".$m; 
if ($string === TRUE) 
{
    return $d.' '.trans('cp.month'.$m).' '.$y;
}
        return $y.'/'.$m.'/'.$d; 
        } 
        else 
        return ""; 


    } 




##################################################
  
    public static function get($val)
   {
        $time = time();
        if (is_numeric($val)) 
        {
            $date = $val;
        }else{
            $date = strtotime($val);
        }
        $timeall = $time-$date;
    
        if($timeall < 60){
    
        $timeall = trans('times.few_seconds');
    
        }else if($timeall > 60 and $timeall < 3600){

        $timed = $timeall/60;
        $timed = floor($timed);

        $timeall = trans('times.before_minutes',['time'=> $timed]);
    
        }else if($timeall > 3600 and $timeall < 86400){
    
        $timed = $timeall/3600;
        $timed = floor($timed);
        $timeall = trans('times.before_hours',['time'=> $timed]);

    
        }else if($timeall > 86400 and $timeall < 604800){
    
        $timed = $timeall/86400;
        $timed = floor($timed);
        $timeall = trans('times.before_days',['time'=> $timed]);
    
        }else if($timeall > 604800 and $timeall < 2592000){
    
        $timed = $timeall/604800;
        $timed = floor($timed);
        $timeall = trans('times.before_weeks',['time'=> $timed]);
    
        }else if($timeall > 2592000 and $timeall < 31104000){
    
        $timed = $timeall/2592000;
        $timed = floor($timed);
        $timeall = trans('times.before_mounths',['time'=> $timed]);
    
        }else if($timeall > 31104000){
    
        $timed = $timeall/31104000;
        $timed = floor($timed);
        $timeall = trans('times.before_years',['time'=> $timed]);
    
}
   return $timeall;
   }
    public static function since($val)
   {
        $time = time();
        if (is_numeric($val)) 
        {
           $date = $val;
        }else{
            $date = strtotime($val);
        }

        $timeall = $time-$date;
        
        return $timeall;
   }

       public static function left($val)
   {
    if (is_numeric($val)) 
    {
        $day = date('d',$val);
        $mounth = date('m',$val);
        $year = date('Y',$val);
    }else{ 
        $day = date('d',strtotime($val));
        $mounth = date('m',strtotime($val));
        $year = date('Y',strtotime($val));
    }
        $target = mktime(0,0,0,$mounth,$day,$year);
        $time = time();
        $difference = $target - $time;
        $month = floor($difference / 2592000);
        $days = floor($difference / 86400);
        $hours = floor($difference / 3600);
        $mins = floor($difference / 60);
        $secs = floor($difference);
        if ($difference > 2592000) 
        {
            $timer = trans('times.count_douwn_mo',['months'=>$month]);
        }elseif ($difference > 86400 && $difference < 2592000) 
        {
            // $timer = trans('times.count_douwn_d',['days'=>$days]);
        }elseif($difference > 3600 && $difference < 86400){
            // $timer = trans('times.count_douwn_h',['hours'=>$hours]);
        }elseif($difference > 60 && $difference < 3600){
            // $timer = trans('times.count_douwn_m',['mins'=>$mins]);
        }else{
            // $timer = trans('times.count_douwn_finish');
        }
return $difference;
   }


          public static function date_end($val)
   {
       $day = date('d',strtotime($val));
        $mounth = date('m',strtotime($val));
        $year = date('Y',strtotime($val));
        $target = mktime(0,0,0,$mounth,$day,$year);
        $time = time();
        $difference = $target - $time;
return $difference;
   }


     public static function leftConnect($val)
   {
        $time = time();
        if (is_numeric($val)) 
        {
            $date = $val;
        }else{
            $date = strtotime($val);
        }
        $timeall = $time-$date;
    
        if($timeall < 60){
    
        $timeall = trans('chat.few_seconds');
    
        }else if($timeall > 60 and $timeall < 3600){

        $timed = $timeall/60;
        $timed = floor($timed);

        $timeall = trans('chat.before_minutes',['time'=> $timed]);
    
        }else if($timeall > 3600 and $timeall < 86400){
    
        $timed = $timeall/3600;
        $timed = floor($timed);
        $timeall = trans('chat.before_hours',['time'=> $timed]);

    
        }else if($timeall > 86400 and $timeall < 604800){
    
        $timed = $timeall/86400;
        $timed = floor($timed);
        $timeall = trans('chat.before_days',['time'=> $timed]);
    
        }else if($timeall > 604800 and $timeall < 2592000){
    
        $timed = $timeall/604800;
        $timed = floor($timed);
        $timeall = trans('chat.before_weeks',['time'=> $timed]);
    
        }else if($timeall > 2592000 and $timeall < 31104000){
    
        $timed = $timeall/2592000;
        $timed = floor($timed);
        $timeall = trans('chat.before_mounths',['time'=> $timed]);
    
        }else if($timeall > 31104000){
    
        $timed = $timeall/31104000;
        $timed = floor($timed);
        $timeall = trans('chat.before_years',['time'=> $timed]);
    
}
   return $timeall;
   }


public static function lastDays($val) 
{
    
    $oneDay = 86400 * $days;
    if (is_numeric($val)) 
    {
        $day = date('d',$val);
        $mounth = date('m',$val);
        $year = date('Y',$val);
    }else{ 
        $day = date('d',strtotime($val));
        $mounth = date('m',strtotime($val));
        $year = date('Y',strtotime($val));
    }
        $target = mktime(0,0,0,$mounth,$day,$year);
        $time = time();
        $difference = $target - $time;
}

}
