<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $cities = City::all();
        return view('customers.list', compact('customers','cities'));
    }

    public function filterByCity(Request $request){
        $idCity = $request->input('city_id');

        //kiem tra city co ton tai khong

        $cityFilter = City::find($idCity);
        //dd($cityFilter);
        //lay ra tat ca customer cua cityFiler
        $customers = Customer::where('city_id', $cityFilter->id)->get();

        $totalCustomerFilter = count($customers);
        $cities = City::all();

        return view('customers.list', compact('customers', 'cities', 'totalCustomerFilter', 'cityFilter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('customers.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name  = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob  = $request->input('dob');
        $customer->city_id  = $request->input('city_id');
        $customer->save();

        Session::flash('success', 'Tạo mới khách hàng thành công');

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $cities = City::all();
        return view('customers.edit', compact('customer','cities'));
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
        $customer = Customer::find($id);
        $customer->name  = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob  = $request->input('dob');
        $customer->city_id  = $request->input('city_id');
        $customer->save();

        Session::flash('success','Cập nhật khách hàng thành công');
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        Session::flash('success', 'Xóa khách hàng thành công');
        return redirect()->route('customers.index');
    }
}
