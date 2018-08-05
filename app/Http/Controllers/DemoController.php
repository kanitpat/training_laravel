<?php

namespace App\Http\Controllers;
use \App\Exports\BladeExport;
use App\User as UserMod; 

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index()
    {
        // return view('admin.layouts.template');
        return 'demoone';

    }

    public function demotwo()
    {
        return "Method POST: demotwo";
    }

    public function demothree()
    {
        return "Method GET, POST : demothree";
    }

    public function demofour()
    {
        return "Method GET, POST, PUT/PATCH, DELETE : demofour";
    }
    public function testlinenoti()
    {
        $line_noti_token = "KsLLgN2crJabGmKeQpyt9eEhyXo40lwdJvc8iNLss65";
        
        $message = array(
          'message' => "ดีจ้า",//required message
          'stickerPackageId'=> 1,
          'stickerId'=> 117
        );
        
        notify_message($message,$line_noti_token);
        
        return 'ok';
    }
    public function testexcel(){
        $user = UserMod::all();
        return \Excel::download(new BladeExport($user->toArray()), 'invoices.xlsx');
 }




}
