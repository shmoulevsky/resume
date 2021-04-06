<?php 
 namespace App\Traits;
 use App\ESh\Helper;

 trait DateTimeFormat
 {
     public function getFormatDateTimeAttribute()     
     {               
        $arDate = Helper::convertDateTime($this->created_at); 
        return '<span class="date-attr">'.$arDate[0].'</span>'.', '.'<span class="time-attr">'.$arDate[1].'</span>';       
     }

     public function getFormatDateAttribute()     
     {               
        $arDate = Helper::convertDate($this->created_at); 
        return '<span class="date-attr">'.$arDate[0].'</span>';       
     }
 }