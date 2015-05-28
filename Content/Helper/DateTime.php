<?php

  function Sf_get_year(){
        return date('Y');
  }
    
  function Sf_get_month()
  {
        return date('m');
  }
    
  function Sf_get_day()
  {
        return date('d');
  }
    
  function  Sf_get_date()
  {
        $time = new \SivarApi\Tools\Time(short);
        return  $time->GetFormatDate();
  }
    
  function  Sf_ReWriteDate($date){
          $format = new DateTime($date);
          return $format->format("Y-m-d");
  }


  function Sf_get_time()
  {
         $time = new \SivarApi\Tools\Time(hour);
         return $time->GetFormatDate();
  }

  function Sf_DiffHour($horaini,$horafin)
  {
        \SivarApi\Tools\Time::DiffHour($horaini, $horafin);
  }
    
  function Sf_Get_TimeAgo($datetime, $full = false) 
  {
        $timeago = new \SivarApi\Tools\Time();
        return $timeago->GetTimeAgo($datetime, $full);
  }
