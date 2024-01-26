<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\Users\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){

        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;



            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $keys => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $keys)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
    //予約の逆をやる。
    public function cancel(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            dd($getPart);

            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $keys => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $keys)->where('setting_part', $value)->first();
                $reserve_settings->increment('limit_users');
                $reserve_settings->users()->detach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
}
