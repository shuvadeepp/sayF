<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\DB;

class QueryController extends AppController {
   
    
     public function index() {
         
         //dd(env('DB_DATABASE'));
         $DB_NAME                           = env('DB_DATABASE');         
         $this->viewVars['DB_NAME']         = $DB_NAME;
         
         
         
         $elementsSql	= "
	SELECT TABLE_NAME, 'TABLE' AS ROUTINE_TYPE, TABLE_TYPE AS DEFINATION
	FROM information_schema.tables
	WHERE TABLE_TYPE = 'BASE TABLE' AND information_schema.tables.table_schema = '".$DB_NAME."'
	
	UNION ALL
	
	SELECT TABLE_NAME, 'VIEW' AS ROUTINE_TYPE, VIEW_DEFINITION AS DEFINATION
	FROM information_schema.views
	WHERE information_schema.views.table_schema  = '".$DB_NAME."'
    UNION ALL 
    
    SELECT ROUTINE_NAME, ROUTINE_TYPE, ROUTINE_DEFINITION FROM information_schema.ROUTINES 
	WHERE information_schema.ROUTINES.ROUTINE_SCHEMA  = '".$DB_NAME."';
	";
         
         
        $resElements = DB::select($elementsSql); 
           
           
        $this->viewVars['resElements']     = $resElements;
         
        if(request('dqs')){
            
         $query		= trim(request('dqs'));
        
          if($query) {
              
            try{
                
                $this->viewVars['result']	= DB::select($query);
                
            }catch(exception $e) {   
                dd($e);
            }
            
            $this->viewVars['query']	= $query;
          } 
        }else{
            $this->viewVars['result']	= [];
            $this->viewVars['query']	= '';
        }
        
         return view('application.query',$this->viewVars);
         
    }
}

