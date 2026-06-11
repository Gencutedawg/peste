<?php

namespace App\Http\Controllers\Admin;

use App\Models\CuringBooth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CuringBoothController extends Controller
{
    /**
     * Display a listing of curing booths
     */
    public function index(Request $request)
    {
        $query = CuringBooth::query();

        // Search by booth name
        if ($request->filled('search')) {
            $query->where('curing_booth', 'like', '%' . $request->search . '%');
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
        $booths = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        $boothNames = CuringBooth::where('is_active', 1)
            ->orderBy('curing_booth')
            ->pluck('curing_booth')
            ->values();

        return view('admin.booths.index', compact('booths', 'boothNames'));
    }

    /**
     * Show the form for creating a new curing booth
     */
    public function create()
    {
        return view('admin.booths.create');
    }

    /**
     * Store a newly created curing booth
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'curing_booth' => 'required|string|max:100|unique:curing_booth',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['is_active'] = true;

        CuringBooth::create($validated);

        return redirect()->route('booths.index')->with('success', 'Curing booth created successfully.');
    }

    /**
     * Show the form for editing a curing booth
     */
    public function edit(CuringBooth $booth)
    {
        return view('admin.booths.edit', compact('booth'));
    }

    /**
     * Update the curing booth
     */
    public function update(Request $request, CuringBooth $booth)
    {
        $validated = $request->validate([
            'curing_booth' => 'required|string|max:100|unique:curing_booth,curing_booth,' . $booth->id,
            'is_active' => 'boolean',
        ]);

        $validated['updated_by'] = Auth::id();

        $booth->update($validated);

        return redirect()->route('booths.index')->with('success', 'Curing booth updated successfully.');
    }

    /**
     * Delete a curing booth
     */
    public function destroy(CuringBooth $booth)
    {
        $booth->delete();

        return redirect()->route('booths.index')->with('success', 'Curing booth deleted successfully.');
    }
}
