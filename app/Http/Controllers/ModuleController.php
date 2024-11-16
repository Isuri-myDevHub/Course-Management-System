<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Store a newly created module.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'code' => 'required|string|unique:modules,code',
            'name' => 'required|string|max:255',
            'semester' => 'required|integer',
            'description' => 'nullable|string',
            'credit' => 'required|integer',
            'type' => 'required|in:Mandatory,Elective',
            'status' => 'required|in:draft,publish',
        ]);

        // Create the module
        Module::create($request->all());

        return response()->json(['message' => 'Module created successfully']);
    }

    /**
     * Update an existing module.
     */
    public function update(Request $request, Module $module)
    {
        // Check if the module can be updated based on its status and time
        if ($module->status == 'publish' && now()->diffInHours($module->updated_at) > 6) {
            return response()->json(['error' => 'Cannot update after 6 hours of publishing'], 403);
        }

        // Validate request data
        $request->validate([
            'code' => 'sometimes|required|string|unique:modules,code,' . $module->id,
            'name' => 'sometimes|required|string|max:255',
            'semester' => 'sometimes|required|integer',
            'description' => 'nullable|string',
            'credit' => 'sometimes|required|integer',
            'type' => 'sometimes|required|in:Mandatory,Elective',
            'status' => 'sometimes|required|in:draft,publish',
        ]);

        // Update the module
        $module->update($request->all());

        return response()->json(['message' => 'Module updated successfully']);
    }

    /**
     * Delete an existing module.
     */
    public function delete(Module $module)
    {
        $module->delete();

        return response()->json(['message' => 'Module deleted successfully']);
    }
}
