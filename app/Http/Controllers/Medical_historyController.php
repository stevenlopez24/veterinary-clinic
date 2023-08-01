<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Medical_history;
use App\Models\Customer;


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
            'customers.id_customer',
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
    public function create(Request $request)
    {
        $fecha_actual = date("Y-m-d H:i:s");
        $validate_document = Customer::select('document')
            ->where('document', '=', $request->post('document_customer'))
            ->get();

        if ($validate_document->count() > 0) {
            return redirect()->route('medical_history.index')->with('error', 'ok');
        } else {

            $customer = new Customer;

            $customer->name = $request->post('name_customer');
            $customer->gender = $request->post('type_gender');
            $customer->document = $request->post('document_customer');
            $customer->document_type = $request->post('type_document');
            $customer->create_time = $fecha_actual;
            $customer->update_time = $fecha_actual;

            $customer->save();

            $validate_customer = Customer::select('id_customer')
                ->where('document', '=', $request->post('document_customer'))
                ->get();

            if ($validate_customer->count() > 0) {

                $id_customer_ = $validate_customer[0]->id_customer;
                $pet = new Pet;

                $pet->name = $request->post('name_pet');
                $pet->breed = $request->post('breed_pet');
                $pet->gender = $request->post('type_gender_pet');
                $pet->id_customer = $id_customer_;
                $pet->create_time = $fecha_actual;
                $pet->update_time = $fecha_actual;
                $pet->save();

                $validate_pet = Pet::select('id_pet')
                    ->where('id_customer', '=', $id_customer_)
                    ->get();
                print_r($validate_pet);

                if ($validate_pet->count() > 0) {

                    $id_pet_ = $validate_pet[0]->id_pet;
                    $medical = new Medical_history;

                    $medical->id_pet = $id_pet_;
                    $medical->create_time = $fecha_actual;
                    $medical->update_time = $fecha_actual;

                    $medical->save();

                    return redirect()->route('medical_history.index')->with('save', 'ok');
                } else {
                    return redirect()->route('medical_history.index')->with('error', 'ok');
                }
            } else {
                return redirect()->route('medical_history.index')->with('error', 'ok');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_old(Request $request, $id_customer)
    {
        $name_pet_old = $request->post('name_pet_old');
        $breed_pet_old = $request->post('breed_pet_old');
        $type_gender_pet_old =  $request->post('type_gender_pet_old');

        $fecha_actual = date("Y-m-d H:i:s");

        $validate_customer = Pet::select('*')
            ->where('id_customer', '=', $id_customer)
            ->where('name', '=', $request->post('name_pet_old'))
            ->where('breed', '=', $request->post('breed_pet_old'))
            ->where('gender', '=', $request->post('type_gender_pet_old'))
            ->first();

        if (!isset($validate_customer)) {
            $pet = new Pet;   

            $pet->name = $name_pet_old;
            $pet->breed = $breed_pet_old;
            $pet->gender = $type_gender_pet_old;
            $pet->id_customer = $id_customer;
            $pet->create_time = $fecha_actual;
            $pet->update_time = $fecha_actual;

            $pet->save();

            $validate_pet = Pet::select('id_pet')
                ->where('id_customer', '=', $id_customer)
                ->orderBy('id_pet', 'desc')
                ->get();

            if ($validate_pet->count() > 0) {

                $id_pet_ = $validate_pet[0]->id_pet;
                
                $medical = new Medical_history;

                $medical->id_pet = $id_pet_;
                $medical->create_time = $fecha_actual;
                $medical->update_time = $fecha_actual;

                $medical->save();

                return redirect()->route('medical_history.index')->with('save', 'ok');
            }
        } else {
            return redirect()->route('medical_history.index')->with('yes_exist_pet', 'ok');
        }
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

            'pets.id_pet',
            'pets.name as pet_name',
            'pets.breed',
            'pets.gender as pet_gender',

            'customers.id_customer',
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
    public function search(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_medical,  $id_pet, $id_customer)
    {
        $fecha_actual = date("Y-m-d H:i:s");

        $medical = Medical_history::find($id_medical);
        $medical->update_time = $fecha_actual;

        $pet = Pet::find($id_pet);
        $pet->name = $request->post('name_pet');
        $pet->breed = $request->post('breed_pet');
        $pet->gender = $request->post('type_gender_pet');
        $pet->update_time = $fecha_actual;
        $pet->save();

        $customer = Customer::find($id_customer);
        $customer->name = $request->post('name_customer');
        $customer->gender = $request->post('type_gender');
        $customer->document_type = intval($request->post('type_document'));
        $customer->update_time = $fecha_actual;
        $customer->save();

        return redirect()->route('medical_history.show', ['m_h' => $id_medical])->with('update', 'ok');
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
