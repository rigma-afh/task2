<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Resident::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResidentRequest $request)
    {

    Resident::create($request->validated());
    return redirect('add')->with('success','resident added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Resident::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */





    public function update(UpdateResidentRequest $request, string $id)
    {
       
        Resident::find($id)->update($request->validated());
      //   Resident::findOrFail($id)->update($request->validated());

        return redirect('/')->with('success','Resident updated successfully');

    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Resident::findOrFail($id)->delete();
    }
}
