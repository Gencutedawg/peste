<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlateSpecification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlateSpecificationController extends Controller
{
    /**
     * Display a listing of plate specifications
     */
    public function index(Request $request)
    {
        $query = PlateSpecification::query();

        // Search by plate code
        if ($request->filled('search')) {
            $query->where('plate_code', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $perPage = (int) $request->input('per_page', 10);
        $plates = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        return view('admin.plates.index', compact('plates'));
    }

    /**
     * Show the form for creating a new plate specification
     */
    public function create()
    {
        return view('admin.plates.create');
    }

    /**
     * Store a newly created plate specification
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_code' => 'required|string|max:100|unique:plate_specification',
            'weight_usl' => 'required|numeric|between:0,999.99',
            'weight_target' => 'required|numeric|between:0,999.99',
            'weight_lsl' => 'required|numeric|between:0,999.99',
            'thick_usl' => 'required|numeric|between:0,999.99',
            'thick_target' => 'required|numeric|between:0,999.99',
            'thick_lsl' => 'required|numeric|between:0,999.99',
            'mc_lsl' => 'required|numeric|between:0,999.99',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['is_active'] = true;

        PlateSpecification::create($validated);

        return redirect()->route('plates.index')->with('success', 'Plate specification created successfully.');
    }

    /**
     * Show the form for editing a plate specification
     */
    public function edit(PlateSpecification $plate)
    {
        return view('admin.plates.edit', compact('plate'));
    }

    /**
     * Update the plate specification
     */
    public function update(Request $request, PlateSpecification $plate)
    {
        $validated = $request->validate([
            'plate_code' => 'required|string|max:100|unique:plate_specification,plate_code,' . $plate->id,
            'weight_usl' => 'required|numeric|between:0,999.99',
            'weight_target' => 'required|numeric|between:0,999.99',
            'weight_lsl' => 'required|numeric|between:0,999.99',
            'thick_usl' => 'required|numeric|between:0,999.99',
            'thick_target' => 'required|numeric|between:0,999.99',
            'thick_lsl' => 'required|numeric|between:0,999.99',
            'mc_lsl' => 'required|numeric|between:0,999.99',
            'is_active' => 'boolean',
        ]);

        $validated['updated_by'] = Auth::id();

        $plate->update($validated);

        return redirect()->route('plates.index')->with('success', 'Plate specification updated successfully.');
    }

    /**
     * Delete a plate specification
     */
    public function destroy(PlateSpecification $plate)
    {
        $plate->delete();

        return redirect()->route('plates.index')->with('success', 'Plate specification deleted successfully.');
    }
}
