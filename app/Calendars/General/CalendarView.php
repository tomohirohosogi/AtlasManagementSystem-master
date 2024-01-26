<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];

    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");
        //ここで過去日の選別（if=過去、ales=今日以降）
        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="yester-day border">';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }


          //訳→もし予約データがあるならば
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'. $reservePart .'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';

          }else{
            //お試しモーダル
            $html[] ='
            <div class="modal-open-button">
              <a class="js-open-button" href="" data-title="'.$day->authReserveDate($day->everyDay())->first()->setting_reserve.'"date-time="'.$reservePart.'">open</a>
            </div>

            <div class="modal-contact">
              <p>test</p>
              <div class="data-title">
                予約日：<text name="title">
              </div>
              <div class="date-time">
                時間：<text name="time">
              </div>
              <a>上記の予約をキャンセルしてもよろしいですか？</a>
              <button class="js-close-button">閉じる</button>
              <form action="/cancel/calendar" method="post" id="cancelParts">'.csrf_field().'
                <button class="cancel">
                <input type="submit" class="" value="キャンセル" form="cancelParts">
                <input type="hidden" name="getPart[]" class="time" value="" form="cancelParts">
                <input type="hidden" name="getData[]" class="data" value="" form="cancelParts">
              </form>
            </div>';

            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
            //テスト版
          }

        //↓にif今日以降ならばを追加
        }else{
          $html[] = $day->selectPart($day->everyDay());
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<a>受付終了</a>';
          }else {

          }

        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';


    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
