<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        return view('cities.list', compact('cities'));
    }

    public function create(){
        $cities = City::all();
        return view('customers.create',compact('cities'));
    }

    public function store(Request $request){
        $city = new City();
        $city->name = $request->input('name');
        $city->save();

        //tao moi xong quay lai danh sach khach hang
        return redirect()->route('cities.index');
    }

    public function edit($id) {
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }

    public function update(Request $request, $id) {

    }

    public function destroy($id){
        $city = City::findOrFail($id);

        //xoa khach hang thuoc tinh thanh nay
        $city->customer()->delete();
        $city->delete();

        //cap nhat xong quay ve trang danh sach tinh thanh
        return redirect()->route('cities.index');
    }


}
