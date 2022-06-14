<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $items = Warehouse::latest()->get();
        return view('admin.pages.warehouse.index',[
            'title' => 'Data Warehouse',
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
        return view('admin.pages.warehouse.create',[
            'title' => 'Create Warehouse',
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
        Warehouse::create($data);
        return redirect()->route('admin.warehouses.index')->with('success','Warehouse berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Warehouse::findOrFail($id);
        return view('admin.pages.warehouse.edit',[
            'title' => 'Edit Warehouse',
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
        $item = Warehouse::findOrFail($id);
        $data = request()->all();
        $item->update($data);
        return redirect()->route('admin.warehouses.index')->with('success','Warehouse berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Warehouse::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.warehouses.index')->with('success','Warehouse berhasil dihapus.');
    }
}
