<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Medical_history;


class Medical_historyController extends Controller
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
        $medical_history = Medical_history::select(
        'medical_history.id_medical_history',
        'medical_history.state_record as medical_history_state_record',
        'pets.name',
        'pets.breed',
        'pets.gender',
        'customers.name as customer_name',   
        'customers.document',
        'document_type.name as document_name',    
        )
        ->join('pets', 'pets.id_pet', '=', 'medical_history.id_pet')
        ->join('customers', 'pets.id_customer', '=', 'customers.id_customer')
        ->join('document_type', 'customers.document_type', '=', 'document_type.id_document_type')
        ->where('medical_history.state_record', '=', 'ACTIVO')
        ->distinct()->get();

    return view('modules.medical_history.index', ['medical_history' => $medical_history]);
        
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
    public function show(Medical_history $m_h)
    {
        
        $detail = Medical_history::select(
            'medical_history.id_medical_history',
            'medical_history.state_record as medical_history_state_record',
            'medical_history.create_time',
            'medical_history.update_time',
            'pets.name as pet_name',
            'pets.breed',
            'pets.gender as pet_gender',
            'customers.name as customer_name',  
            'customers.gender as customer_gender', 
            'customers.document',
            'document_type.name as document_name'         
            )
            ->join('pets', 'pets.id_pet', '=', 'medical_history.id_pet')
            ->join('customers', 'pets.id_customer', '=', 'customers.id_customer')
            ->join('document_type', 'customers.document_type', '=', 'document_type.id_document_type')
            ->where('medical_history.id_medical_history', '=', $m_h->id_medical_history)
            ->first();
            
            return view('modules.medical_history.detail', compact('detail'));
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
    public function destroy($id_medical_history)
    {
        $medical = Medical_history::findOrFail($id_medical_history);
        if ($medical->state_record == 'ACTIVO') {
            $medical->state_record = 'INACTIVO';
        } else {
            $medical->state_record = 'ACTIVO';
        }
        $medical->save();
        return redirect()->route('medical_history.index')->with('destroy', 'ok');;
    }
}
