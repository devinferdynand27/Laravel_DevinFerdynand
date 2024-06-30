<?php

namespace App\Http\Controllers;

use App\Models\Mstr_Hospital;
use App\Models\Pasien;
use Illuminate\Http\Request;

class MstrHospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mstr_Hospital::orderBy('created_at', 'asc')->get();
            return datatables($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <div class="d-flex gap-2">
                            <button type="button"  style="background: rgb(0, 153, 255);" class="btn btn-primary"  data-id="' . $data->id . '" onclick="editItem(' . $data->id . ')">
                                <i class="bx bxs-eyedropper"></i>
                            </button>
                            <button type="button" style="background: yellow;border:0" class="btn btn-warning" data-id="' . $data->id . '" onclick="showItem(' . $data->id . ')">
                                <i class="bx bx-show"></i>
                            </button>
                            <button type="button"  style="background: red;" onclick="deleteItem(' . $data->id . ')" class="btn btn-danger">
                                <i class="bx bx-trash me-1"></i>
                            </button>
                        </div>
                    ';
                })


                ->editColumn('hospital_name', function ($data) {
                    return $data->hospital_name;
                })
                ->editColumn('address', function ($data) {
                    // Batasi address menjadi 10 karakter
                    $address = strlen($data->address) > 10 ? substr($data->address, 0, 10) . '...' : $data->address;
                    return $address;
                })

                ->editColumn('email', function ($data) {
                    return $data->email;
                })
                ->editColumn('telephone', function ($data) {
                    return $data->telephone;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.hospitals.index');
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
        $validated = $request->validate([
            'hospital_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:15',
        ]);

        $hospital = Mstr_Hospital::create($validated);

        return response()->json($hospital);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hospital = Mstr_Hospital::findOrFail($id);
        return response()->json($hospital);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hospital = Mstr_Hospital::findOrFail($id);
        return response()->json($hospital);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hospital = Mstr_Hospital::find($id);
        $hospital->hospital_name = $request->input('hospital_name');
        $hospital->address = $request->input('address');
        $hospital->email = $request->input('email');
        $hospital->telephone = $request->input('telephone');
        $hospital->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hospital = Mstr_Hospital::find($id);
        if (!$hospital) {
            return response()->json(['success' => false, 'message' => 'Hospital not found.'], 404);
            
        }
        if ($hospital->patients()->exists()) {
            return response()->json(['success' => false, 'message' => 'Cannot delete hospital with related patients.'], 400);
        }
        $hospital->delete();
        return response()->json(['success' => true, 'message' => 'Hospital deleted successfully']);
    }
}
