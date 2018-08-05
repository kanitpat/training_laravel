<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User as UserMod;
use App\Model\Shop as ShopMod;
use App\Model\Product as ProductMod;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mods = UserMod::all();
        // $mods = UserMod::where('active', 1)
        //        ->orderBy('name', 'desc')   
        //     //    ->take(10)
        //        ->get();
   
        // $mod = UserMod::find(1);



        // $mods = UserMod::find([1, 2, 3]);

        //  foreach ($mods as $item) {
        //      echo   $item->name. "  ". $item->surname. "  ". $item->email."<br/>";
        //   }

        // $data = [
        //     'name' => 'My Name',
        //     'surname' => 'My SurName',
        //     'email' => 'myemail@gmail.com'
        // ];
        
        // return view('test', $data );

        // return view('test')
        // ->with('name', 'My Name')
        // ->with('email', 'jim@hotmail.com');

        // $data = [
        //     'name' => 'My Name',
        //     'surname' => 'My SurName',
        //     'email' => 'myemail@gmail.com'
        // ];

        // $item = [
        //     'item1' => 'My Value1',
        //     'item2' => 'My Value2'
        // ];

        // $results = [
        //     'data' => $data,
        //     'item' => $item
        // ];

        // return view('test', $results);
        
        // $mods = UserMod::all();
        // return view('test', compact('data','mods'));
        $mods = UserMod::orderBy('id','desc')->paginate(10);
        return view('admin.user.lists', compact('mods') );

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // การตรวจสอบ
           request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'address' => 'required|min:6',
            'age' => 'required|numeric',
            'city' => 'required',
            'confirm_password' => 'required|min:6|max:20|same:password',
        ], [  //change alet defult
            'name.required' => 'Name is required',
            'mobile.required' => 'numeric is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);

        $mod = new UserMod;
        $mod->email    = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        $mod->mobile   = $request->mobile;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/users')
                    ->with('success', 'User ['.$request->name.'] created successfully.');



         // $mod = new UserMod;
         // $mod->name = $request->name;
         // $mod->email = $request->email;
         // $mod->password = bcrypt($request->password);
         // $mod->remember_token = bcrypt($request->confirm_password);
         // $mod->surname = $request->surname;
         // $mod->mobile = $request->mobile;
         // $mod->age = $request->age;
         // $mod->address = $request->address;
         // $mod->city = $request->city;


        
        //  $mod->save();
        // echo "add data to store " ;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $shop = UserMod::find($id)->shop;
        // echo  $shop->name;

        // $mod = ShopMod::find($id);
        // echo  $mod->name."<br />";        
        // echo  $mod->user->name;


        $products = ProductMod::find($id);
        echo "products Name is" .$products->name;
        echo "<br/><br/>";
        echo "Shop ower is" .$products->shop->name;







    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = UserMod::find($id);
        // echo "edit";
        return view('admin.user.edit', compact('item') );


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $mod = UserMod::find($id);
        // $mod->name = $request->name;
        // $mod->email = $request->email;
        // $mod->password = bcrypt($request->password);
        // $mod->save();
        // echo " Update Success";

            request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'password' => 'required|min:6',
            'address' => 'required|min:6',
            'age' => 'required|numeric',
            'city' => 'required',
            'confirm_password' => 'required|min:6|max:20|same:password',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);

        $mod = UserMod::find($id);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        //$mod->email    = $request->email;
        $mod->mobile   = $request->mobile;
        $mod->surname  = $request->surname;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/users')
                    ->with('success', 'User ['.$request->name.'] updated successfully.');






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mod = UserMod::find($id);
        $mod->delete();
        return redirect('admin/users');

        // echo " Delete Success";

    }
}
