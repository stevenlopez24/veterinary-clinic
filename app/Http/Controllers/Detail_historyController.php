<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details_history;
use App\Models\Pet;

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
        'pets.name as pet_name',
        'pets.breed',
        'pets.gender',
        'details_history.state_record',
        'customers.name as customer_name',   
        'customers.document',
        'details_history.id_detail_history',
        'document_type.name as document_name',
        'users.name as user_name',
        )
        ->join('medical_history', 'details_history.id_medical_history', '=', 'medical_history.id_medical_history')
        ->join('pets', 'medical_history.id_pet', '=', 'pets.id_pet')
        ->join('customers', 'pets.id_customer', '=', 'customers.id_customer')
        ->join('document_type', 'customers.document_type', '=', 'document_type.id_document_type')
        ->join('users', 'details_history.id_employee', '=', 'users.id')
        ->where('details_history.state_record', '=', 'ACTIVO')
        ->distinct()->get();

        return view('modules.details_history.index', ['detail' => $detail]);
        
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
    public function show(Details_history $deta)
    {
        $detail = Details_history::select(
            'details_history.id_detail_history',
            'details_history.state_record',
            'details_history.temperature',
            'details_history.weight',
            'details_history.heart_rate',
            'details_history.observation',
            'details_history.create_time',
            'details_history.update_time',

            'pets.name as pet_name',
            'pets.breed',
            'pets.gender as pet_gender',

            'customers.name as customer_name',  
            'customers.gender as customer_gender', 
            'customers.document',

            'document_type.name as document_name',

            'users.name as user_name'
            )
            ->join('medical_history', 'details_history.id_medical_history', '=', 'medical_history.id_medical_history')
            ->join('pets', 'medical_history.id_pet', '=', 'pets.id_pet')
            ->join('customers', 'pets.id_customer', '=', 'customers.id_customer')
            ->join('document_type', 'customers.document_type', '=', 'document_type.id_document_type')
            ->join('users', 'details_history.id_employee', '=', 'users.id')
            ->where('details_history.id_detail_history', '=', $deta->id_detail_history)
            ->first();
    
            return view('modules.details_history.detail', compact('detail'));
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
