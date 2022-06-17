<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrier;
use App\Models\Country;
use App\Models\Finance;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    public function index()
    {
        $items = Finance::latest()->get();
        return view('admin.pages.finance.index',[
            'title' => 'Data Finance',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::orderBy('name','ASC')->get();
        $carriers = Carrier::orderBy('name','ASC')->get();
        $countries = Country::orderBy('name','ASC')->get();
        return view('admin.pages.finance.create',[
            'title' => 'Create Finance',
            'warehouses' => $warehouses,
            'carriers' => $carriers,
            'countries' => $countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'job_number' => ['required','unique:finances,job_number'],
            'type' => ['required'],
            'warehouse_id' => ['required'],
            'carrier_id' => ['required'],
            'port_of_loading' => ['required'],
            'destination' => ['required'],
            'customer' => ['required'],
            'consigne' => ['required']
            
        ]);

        $data = request()->all();
        Finance::create($data);
        return redirect()->route('admin.finances.index')->with('success','Finance berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Finance::findOrFail($id);
        $warehouses = Warehouse::orderBy('name','ASC')->get();
        $carriers = Carrier::orderBy('name','ASC')->get();
        $countries = Country::orderBy('name','ASC')->get();
        return view('admin.pages.finance.edit',[
            'title' => 'Edit Finance',
            'item' => $item,
            'warehouses' => $warehouses,
            'carriers' => $carriers,
            'countries' => $countries
        ]);
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
        request()->validate([
            'job_number' => ['required',Rule::unique('finances','job_number')->ignore($id)],
            'type' => ['required'],
            'warehouse_id' => ['required'],
            'carrier_id' => ['required'],
            'port_of_loading' => ['required'],
            'destination' => ['required'],
            'customer' => ['required'],
            'consigne' => ['required']
            
        ]);

        $data = request()->all();
        $item = Finance::findOrFail($id);
        $item->update($data);
        return redirect()->route('admin.finances.index')->with('success','Finance berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Finance::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.finances.index')->with('success','Finance berhasil dihapus.');
    }

    public function download($id)
    {
        $item = Finance::findOrFail($id);
        $cat = request('cat');
        if($cat === 'invoice')
        {
            $file= public_path('storage/'). $item->invoice;
        }else if($cat === 'payment_status')
        {
            $file= public_path('storage/'). $item->payment_status;
        }else{
            $file= public_path('storage/'). $item->delivery_order;
        }

        $headers = array(
            'Content-Type: application/pdf',
        );

        if(!file_exists($file)){
            return redirect()->back()->with('error','File tidak ditemukan.');
        }

        return Response::download($file, Str::random(20) . '.pdf', $headers);
    }
}
