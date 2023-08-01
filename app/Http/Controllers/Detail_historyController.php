<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Details_history;
use App\Models\Pet;
use App\Models\Medical_history;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

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
    public function create(Request $request)
    {
        $userID = Auth::id();

        $temperature = $request->post('temperature');
        $weight = $request->post('weight');
        $heart_rate = $request->post('heart_rate');
        $observation = $request->post('observation');

        $fecha_actual = date("Y-m-d H:i:s");
        $validate_document = Customer::select('id_customer')
            ->where('document', '=', $request->post('document_customer'))
            ->get();

        if ($validate_document->count() > 0) {
            $id_customer_ = $validate_document[0]->id_customer;

            $validate_pet = Pet::select('*')
                ->where('name', '=', $request->post('name_pet'))
                ->where('breed', '=', $request->post('breed_pet'))
                ->where('gender', '=', $request->post('type_gender_pet_old'))
                ->where('id_customer', '=', $id_customer_)
                ->get();

            

            if ($validate_pet->count() > 0) {
                $id_pet_ = $validate_pet[0]->id_customer;

                $validate_medical = Medical_history::select('id_medical_history')
                    ->where('id_pet', '=', $id_pet_)
                    ->get();

                $id_medical_ = $validate_medical[0]->id_medical_history;

                if ($validate_medical->count() > 0) {


                    $medical = new Details_history();

                    $medical->temperature = $temperature;
                    $medical->weight = $weight;
                    $medical->heart_rate = $heart_rate;
                    $medical->observation = $observation;

                    $medical->id_medical_history = $id_medical_;
                    $medical->id_employee = $userID ;
                    $medical->create_time = $fecha_actual;
                    $medical->update_time = $fecha_actual;

                    $medical->save();

                    return redirect()->route('detail_history.index')->with('save', 'ok');
                } else {
                    return redirect()->route('detail_history.index')->with('error', 'ok');
                }
            } else {
                return redirect()->route('detail_history.index')->with('not_exist_pet', 'ok');
            }
            
        } else {

            
            return redirect()->route('detail_history.index')->with('error', 'ok');
        }
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
    public function update(Request $request,  $id_detail_history)
    {
        $fecha_actual = date("Y-m-d H:i:s");

        $detail = Details_history::find($id_detail_history);
        $detail->temperature = $request->post('temperature');
        $detail->weight = $request->post('weight');
        $detail->heart_rate = $request->post('heart_rate');
        $detail->observation = $request->post('observation');
        $detail->update_time = $fecha_actual;
        $detail->save();

        return redirect()->route('detail_history.show', ['deta' => $id_detail_history])->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
