<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteVisit;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    // create a function to staore ip address in the database
    public function saveIP(Request $request) {
     
     $pageVisit = new SiteVisit();   
     
     try {
     
     $pageVisit->ip = $request->data["ip"];
     $pageVisit->page = $request->data['page'];
     $pageVisit->location = $request->data['location'];
     $pageVisit->date = date('Y-m-d');
     
     $pageVisit->save();
     
     
     //return response()->json($pageVisit);
    
     } catch (\Throwable $th) {
         return $th;
     }
 
    }
    
    //GET ALL SAVED IP FOR A DAY

    public function todayLogs() {
        
        //$date = $request->input('date');
        $date = date('Y-m-d');
        
        $visitors = DB::table('site_visit')->select('ip' , 'page' , 'location' , 'created_at' )->where('date' , $date)->get();
                
        return $visitors;
    
    }
    
    // select all monthly visits
    public function montlyVisits(Request $request) {
    
        $date = $request->input('month');
        
        try {
            
        $monthly = DB::table('site_visit')->select('ip' , 'page' , 'location' , 'created_at')->whereMonth('created_at' , $date )->get(); 
        
        return $monthly;
        
        } catch (\Throwable $th) {
            throw $th;
        }
    
        return 0;
    
    }

    //get avarage of site visists for a day
    public function avday(Request $request) {
    
    

        try {
            
            $month = $request->month;
            $year = $request->year;
            
            
            //$avday = DB::table('site_visit')->select(DB::raw('count(ip) as no, DAY(created_at) as day '))->groupBy(DB::raw("DAY(created_at)"))->get();
            $avday = DB::table('site_visit')->select(DB::raw('count(ip) as no, DAY(created_at) as day'))
            ->whereMonth("created_at", '=' ,$month)
            ->whereYEAR("created_at" , '=' ,$year)
            ->groupBy(DB::raw("DAY(created_at)"))->get();
        
           return $avday;
           
            
        } catch (Throwable $th) {
            return $th;
        }
        
        
    
    }
    
    
    //get avarages of visists 
    //will get 
    public function avmonthly(Request $request) {
        
        try {
        
        $year = $request->year;
           
        //$avmonth = DB::table('site_visit')->select(DB::raw('count(ip) as no '))->whereMonth('created_at' , $date)->get();
        $avmonth = DB::table('site_visit')->select(DB::raw('count(ip) as no , MONTH(created_at) as month'))
        ->whereYear("created_at", '=', $year )
        ->groupBy(DB::raw("MONTH(created_at)"))->get();
        
        return $avmonth;
        
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return 0;
    }

    // get average sites visit for a year
    public function avyear() {
       
        
        try {
            
        $avyear = DB::table('site_visit')->select(DB::raw('count(ip) as no , YEAR(created_at) as year' ))->groupBy(DB::raw("YEAR(created_at)"))->get();
        
        return $avyear;
            
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return 0;
    }


}
