<?php 

Namespace App\Http\Managers;
use Illuminate\Support\Carbon;


class FormatManager{

   public function getDateFr($date){
        $carbon = new Carbon();
        $dateFr = $carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
        return $dateFr;
   }
}