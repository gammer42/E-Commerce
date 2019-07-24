<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\SupplierAlert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SupplierAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $alerts = SupplierAlert::all();
        return view('admin.supplier.alert', compact('alerts','suppliers'));
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
        // dd($request);
        $alert = new SupplierAlert();

        $alert->amount = $request->amount;
        $alert->supplier_id = $request->supplier;
        $alert->notification_date = Carbon::parse($request->notification_date);
        $alert->payment_date = Carbon::parse($request->notification_date);
        $alert->status = true;

        $alert->save();

        return redirect()->route('supplier_payment_alert.index');
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
        $alert = SupplierAlert::find($id);

        $alert->amount = $request->amount;
        $alert->supplier_id = $request->supplier;
        $alert->notification_date = Carbon::parse($request->notification_date);
        $alert->payment_date = Carbon::parse($request->payment_date);
        $alert->status = true;

        $alert->save();

        return redirect()->route('supplier_payment_alert.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SupplierAlert::find($id)->delete();

        Session::flash('message', 'Delete Successfully');
        return redirect()->route('supplier_payment_alert.index');
    }
}
