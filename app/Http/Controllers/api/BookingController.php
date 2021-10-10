<?php

namespace App\Http\Controllers\api;

use Exception;
use Validator;
use App\Utilities\Auth;
use App\Utilities\ApiOutput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function __construct()
    {
        DB::beginTransaction();
    }

    public function add(Request $request) 
    {
        try{
            $data = [];
            $user_id = Auth::id();
            $car_id = trim($request->input('car_id'));
            $number_of_days = trim($request->input('number_of_days'));
            $from_date = trim($request->input('from_date'));
            $params = [];

            $data = BookingService::add($user_id, $car_id, $number_of_days, $from_date, $params);
            
            DB::commit();
            return ApiOutput::success("Booking added successfully", $data);
        }catch(Exception $e) {
            DB::rollBack();
            return ApiOutput::error($e->getMessage());
        }
    }

    public function ongoing_booking(Request $request) 
    {
        try{
            $data = [];

            $data = BookingService::get_ongoing_booking();
            
            DB::commit();
            return ApiOutput::success("successfully get the ongoing booking", $data);
        }catch(Exception $e) {
            DB::rollBack();
            return ApiOutput::error($e->getMessage());
        }
    }

    public function booking_history(Request $request) 
    {
        try{
            $data = [];

            $data = BookingService::get_booking_history();
            
            DB::commit();
            return ApiOutput::success("successfully get the booking history", $data);
        }catch(Exception $e) {
            DB::rollBack();
            return ApiOutput::error($e->getMessage());
        }
    }
}
