<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    public function index()
    {
        $items = Country::latest()->get();
        return view('admin.pages.country.index',[
            'title' => 'Data County',
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
        return view('admin.pages.country.create',[
            'title' => 'Create Country',
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
            'code' => ['required','unique:countries,code'],
            'name' => ['required']
        ]);

        $data = request()->all();
        Country::create($data);
        return redirect()->route('admin.countries.index')->with('success','Negara berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Country::findOrFail($id);
        return view('admin.pages.country.edit',[
            'title' => 'Edit Country',
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
            'code' => ['required',Rule::unique('countries','code')->ignore($id)],
            'name' => ['required']
        ]);
        $item = Country::findOrFail($id);
        $data = request()->all();
        $item->update($data);
        return redirect()->route('admin.countries.index')->with('success','Negara berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Country::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.countries.index')->with('success','Negara berhasil dihapus.');
    }
}
