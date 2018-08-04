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
        $mods = UserMod::paginate(15);
        return view('admin.user.lists', compact('mods') );

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mod = new UserMod;
        $mod->name = $request->name;
        $mod->email = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->save();


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
        //
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
        $mod = UserMod::find($id);
        $mod->name = $request->name;
        $mod->email = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->save();
        echo " Update Success";


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
        echo " Delete Success";

    }
}
