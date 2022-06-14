<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrier;
use Illuminate\Http\Request;

class CarrierController extends Controller
{
    public function index()
    {
        $items = Carrier::latest()->get();
        return view('admin.pages.carrier.index',[
            'title' => 'Data Carrier',
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
        return view('admin.pages.carrier.create',[
            'title' => 'Create Carrier',
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
            'name' => ['required']
        ]);

        $data = request()->all();
        Carrier::create($data);
        return redirect()->route('admin.carriers.index')->with('success','Carrier berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Carrier::findOrFail($id);
        return view('admin.pages.carrier.edit',[
            'title' => 'Edit Carrier',
            'item' => $item
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
            'name' => ['required']
        ]);
        $item = Carrier::findOrFail($id);
        $data = request()->all();
        $item->update($data);
        return redirect()->route('admin.carriers.index')->with('success','Carrier berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Carrier::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.carriers.index')->with('success','Carrier berhasil dihapus.');
    }
}
