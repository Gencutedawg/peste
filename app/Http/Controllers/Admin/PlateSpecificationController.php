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
            'weight_usl' => 'required|numeric|min:0|max:999.99',
            'weight_target' => 'required|numeric|min:0|max:999.99',
            'weight_lsl' => 'required|numeric|min:0|max:999.99',
            'thick_usl' => 'required|numeric|min:0|max:999.99',
            'thick_target' => 'required|numeric|min:0|max:999.99',
            'thick_lsl' => 'required|numeric|min:0|max:999.99',
            'mc_lsl' => 'required|numeric|min:0|max:999.99',
        ], [
            'weight_usl.required' => 'Weight USL is required',
            'weight_target.required' => 'Weight target is required',
            'weight_lsl.required' => 'Weight LSL is required',
            'thick_usl.required' => 'Thickness USL is required',
            'thick_target.required' => 'Thickness target is required',
            'thick_lsl.required' => 'Thickness LSL is required',
        ]);

        $validated['plate_code'] = strtoupper($validated['plate_code']);

        if ($validated['weight_lsl'] >= $validated['weight_usl']) {
            return back()->withErrors(['weight_lsl' => 'Weight LSL must be lower than USL'])->withInput();
        }

        if ($validated['weight_target'] < $validated['weight_lsl'] || $validated['weight_target'] > $validated['weight_usl']) {
            return back()->withErrors(['weight_target' => 'Weight target must be between LSL and USL'])->withInput();
        }

        if ($validated['thick_lsl'] >= $validated['thick_usl']) {
            return back()->withErrors(['thick_lsl' => 'Thickness LSL must be lower than USL'])->withInput();
        }

        if ($validated['thick_target'] < $validated['thick_lsl'] || $validated['thick_target'] > $validated['thick_usl']) {
            return back()->withErrors(['thick_target' => 'Thickness target must be between LSL and USL'])->withInput();
        }

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
            'weight_usl' => 'required|numeric|min:0|max:999.99',
            'weight_target' => 'required|numeric|min:0|max:999.99',
            'weight_lsl' => 'required|numeric|min:0|max:999.99',
            'thick_usl' => 'required|numeric|min:0|max:999.99',
            'thick_target' => 'required|numeric|min:0|max:999.99',
            'thick_lsl' => 'required|numeric|min:0|max:999.99',
            'mc_lsl' => 'required|numeric|min:0|max:999.99',
            'is_active' => 'boolean',
        ]);

        $validated['plate_code'] = strtoupper($validated['plate_code']);

        if ($validated['weight_lsl'] >= $validated['weight_usl']) {
            return back()->withErrors(['weight_lsl' => 'Weight LSL must be lower than USL'])->withInput();
        }

        if ($validated['weight_target'] < $validated['weight_lsl'] || $validated['weight_target'] > $validated['weight_usl']) {
            return back()->withErrors(['weight_target' => 'Weight target must be between LSL and USL'])->withInput();
        }

        if ($validated['thick_lsl'] >= $validated['thick_usl']) {
            return back()->withErrors(['thick_lsl' => 'Thickness LSL must be lower than USL'])->withInput();
        }

        if ($validated['thick_target'] < $validated['thick_lsl'] || $validated['thick_target'] > $validated['thick_usl']) {
            return back()->withErrors(['thick_target' => 'Thickness target must be between LSL and USL'])->withInput();
        }

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
