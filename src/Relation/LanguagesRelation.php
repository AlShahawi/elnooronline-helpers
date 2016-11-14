<?php
namespace AhmedFathy\Helpers\Relation;
trait LanguagesRelation{
    
    

    public function languages()
    {
        return $this->morphMany('App\Language','langable');
    }


    public function translate($lang ,$colum,$trans)
    {
        $trans = ['colum' => $colum, 'trans' => $trans];
        if (is_numeric($lang)) 
        {
            $query = \App\Lang::find($lang);
            if(is_null($query)) { return false; }
          $trans['lang'] = $lang;
        }
        elseif(is_string($lang))
        {
            $query = \App\Lang::where('code',$lang)->first();
            if(is_null($query)) { return false; }
            $trans['lang'] = $query->id;
        }
          $checkTrans = $this->languages()->where('lang',$lang)->where('colum',$colum)->first();
          if (is_null($checkTrans)) 
          {
            $this->languages()->create($trans);
          }else{
            $checkTrans->trans = $trans['trans'];
            $checkTrans->save();
          }
    }

	public function trans($colum,$language = null)
    {
        if (is_null($language)) 
        {
            $lang_id = \App\Lang::where('code',app()->getLocale())->first();
            if ($lang_id) {
                $lang_id = $lang_id->id;
            }
        }
        else{
            $lang_id = \App\Lang::where('code',$language)->first()->id;
        }
        $table = str_singular($this->getTable());
        
        $trans = @$this->morphOne('App\Language','langable')
            ->where('lang',$lang_id)->where('colum',$colum)->first()->trans;

            if (is_null($trans)) 
            {
                return @$this->{$colum};
            }else{
            return $trans;
                
            }
    }


    
  
}