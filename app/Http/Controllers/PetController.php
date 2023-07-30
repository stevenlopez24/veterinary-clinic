<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
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
        $pets = Pet::select(
        'pets.id_pet',
        'pets.name',
        'pets.breed',
        'pets.gender',
        'pets.state_record',
        'customers.name_customer',   
        'customers.document'  
        )
        ->join('customers', 'pets.id_customer', '=', 'customers.id_customer')
        ->where('pets.state_record', '=', 'ACTIVO')
        ->distinct()->get();

    return view('modules.pets.index', ['pets' => $pets]);
        
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
