<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Models\Resident;

use App\DataTables\ResidentDataTable;
use Illuminate\Http\Request;

class ResidentWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(ResidentDataTable $dataTable)
    {
        return $dataTable->render('welcome');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
             return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResidentRequest $request)
    {
        Resident::create($request->validated());
        return redirect('/residents')->with('success','resident added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resident= Resident::findOrFail($id);
        return view('/viewresident', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $resident=Resident::findOrFail($id);
        return view('edit', compact('resident'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResidentRequest $request, string $id)
    {

      Resident::findOrFail($id)->update($request->validated());
        return redirect('/residents')->with('success','Resident updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Resident::findOrFail($id)->delete();
        return redirect()->route('residents.index')->with('success', 'Residegnt deleted successfully');
    }



    public function toggleStatus($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->status = $resident->status === 'active' ? 'inactive' : 'active';
        $resident->save();

        return redirect()->back()->with('success', 'Resident status updated successfully');
    }






}
