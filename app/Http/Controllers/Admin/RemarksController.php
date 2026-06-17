<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeightRemarks;
use App\Models\ThicknessRemarks;
use App\Models\MoistureRemarks;
use Illuminate\Http\Request;

class RemarksController extends Controller
{
    public function index()
    {
        $weightRemarks = WeightRemarks::all();
        $thicknessRemarks = ThicknessRemarks::all();
        $moistureRemarks = MoistureRemarks::all();

        return view('admin.remarks.index', compact('weightRemarks', 'thicknessRemarks', 'moistureRemarks'));
    }

    public function store(Request $request)
    {
        $type = $request->input('type');

        $validated = $request->validate([
            'type' => 'required|in:weight,thickness,moisture',
            'remark_name' => 'required|string|max:255',
        ]);

        $data = [
            'remark_name' => $validated['remark_name'],
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        match ($type) {
            'weight' => WeightRemarks::create($data),
            'thickness' => ThicknessRemarks::create($data),
            'moisture' => MoistureRemarks::create($data),
        };

        return redirect()->route('remarks.index')->with('success', ucfirst($type) . ' remark added successfully');
    }

    public function update(Request $request, $type, $id)
    {
        $validated = $request->validate([
            'type' => 'required|in:weight,thickness,moisture',
            'remark_name' => 'required|string|max:255',
        ]);

        $data = [
            'remark_name' => $validated['remark_name'],
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        $model = match ($type) {
            'weight' => WeightRemarks::findOrFail($id),
            'thickness' => ThicknessRemarks::findOrFail($id),
            'moisture' => MoistureRemarks::findOrFail($id),
        };

        $model->update($data);

        return redirect()->route('remarks.index')->with('success', ucfirst($type) . ' remark updated successfully');
    }

    public function destroy($type, $id)
    {
        $model = match ($type) {
            'weight' => WeightRemarks::findOrFail($id),
            'thickness' => ThicknessRemarks::findOrFail($id),
            'moisture' => MoistureRemarks::findOrFail($id),
        };

        $model->delete();

        return redirect()->route('remarks.index')->with('success', ucfirst($type) . ' remark deleted successfully');
    }
}
