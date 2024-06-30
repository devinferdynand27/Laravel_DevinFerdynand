<?php

namespace App\Http\Controllers;

use App\Models\Mstr_Hospital;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Pasien::orderBy('created_at', 'asc');
            if (!empty($request->id_hospital)) {
                $query->where('hospital_id', $request->id_hospital);
            }
            $data = $query->get();
        
            return datatables($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <div class="d-flex gap-2">
                            <button type="button" style="background: rgb(0, 153, 255);" class="btn btn-primary" data-id="' . $data->id . '" onclick="editItem(' . $data->id . ')">
                                <i class="bx bxs-eyedropper"></i>
                            </button>
                            <button type="button" style="background: yellow; border:0" class="btn btn-warning" data-id="' . $data->id . '" onclick="showItem(' . $data->id . ')">
                                <i class="bx bx-show"></i>
                            </button>
                            <button type="button" style="background: red;" onclick="deleteItem(' . $data->id . ')" class="btn btn-danger">
                                <i class="bx bx-trash me-1"></i>
                            </button>
                        </div>
                    ';
                })
                ->editColumn('patient_name', function ($data) {
                    return $data->patient_name;
                })
                ->editColumn('address', function ($data) {
                    return $data->address;
                })
                ->editColumn('phone_number', function ($data) {
                    return $data->phone_number;
                })
                ->editColumn('hospital_id', function ($data) {
                    return $data->hospital->hospital_name;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        
        
        return view('admin.pasien.index');
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
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'hospital_id' => 'required',
        ]);

        $pasien = new Pasien();
        $pasien->patient_name = $request->patient_name;
        $pasien->address = $request->address;
        $pasien->phone_number = $request->phone_number;
        $pasien->hospital_id = $request->hospital_id;
        $pasien->save();
        return response()->json(['success' => 'Data pasien berhasil ditambahkan']);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Eager load the hospital relationship
        $pasien = Pasien::with('hospital')->findOrFail($id);
    
        // Return the patient data along with the hospital data
        return response()->json([
            'hospital' => $pasien->hospital, // Assuming 'name' is the attribute you want from Mstr_Hospitals
            'patient_name' => $pasien->patient_name,
            'address' => $pasien->address,
            'phone_number' => $pasien->phone_number
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        $hospitalOptions = Mstr_Hospital::orderBy('created_at', 'asc')->get();
    
        // Ubah data menjadi array yang sesuai untuk JSON response
        $data = [
            'id' => $pasien->id,
            'hospitalOptions' => $hospitalOptions,
            'hospital_id' => $pasien->hospital_id,
            'patient_name' => $pasien->patient_name,
            'address' => $pasien->address,
            'phone_number' => $pasien->phone_number
        ];
    
        return response()->json($data);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'hospital_id' => 'required',
        ]);
        $pasien = Pasien::find($id);
        $pasien->patient_name = $request->patient_name;
        $pasien->address = $request->address;
        $pasien->phone_number = $request->phone_number;
        $pasien->hospital_id = $request->hospital_id;
        $pasien->save();
        return response()->json(['success' => 'Data pasien berhasil ditambahkan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hospital = Pasien::find($id);
        if (!$hospital) {
            return response()->json(['success' => false, 'message' => 'Hospital not found.'], 404);
            
        }
        $hospital->delete();
        return response()->json(['success' => true, 'message' => 'Hospital deleted successfully']);
    }
}
