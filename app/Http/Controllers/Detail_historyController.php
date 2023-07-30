<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details_history;

class Detail_historyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = Details_history::select(
        'pets.id_pet',
        'pets.name',
        'pets.breed',
        'pets.gender',
        'details_history.state_record',
        'customers.name_customer',   
        'customers.document',
        'details_history.id_details_history'
        )
        ->join('medical_history', 'details_history.id_medical_history', '=', 'medical_history.id_medical_history')
        ->join('pets', 'medical_history.id_pet', '=', 'pets.id_pet')
        ->join('customers', 'pets.id_customer', '=', 'customers.id_customer')
        ->where('details_history.state_record', '=', 'ACTIVO')
        ->distinct()->get();
print_r($detail);
         //return view('modules.details_history.index', ['detail' => $detail]);
        
    }
    

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
