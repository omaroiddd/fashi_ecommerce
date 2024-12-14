<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $settings = Setting::get();
        return view('admin.pages.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
            'youtube' => 'nullable|string',
        ]);

        Setting::create($data);

        return redirect()->route('admin.social.index')->with('success', 'Settings Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $social)
    {
        return view('admin.pages.settings.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $social)
    {
        $data = $request->validate([
            'facebook' => 'required|string',
            'twitter' => 'required|string',
            'instagram' => 'required|string',
            'youtube' => 'required|string',
        ]);

        $social->update($data);

        return redirect()->route('admin.social.index')->with('success', 'Setting Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $social)
    {
        $social->delete();
        return redirect()->route('admin.social.index')->with('success', 'Setting Deleted Successfully');
    }
}
