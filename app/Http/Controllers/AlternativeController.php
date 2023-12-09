<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $alternatives = Alternative::all();

        return view('alternative.index')->with([
            'title' => 'Alternatives',
            'prev_step' => route('criteria.index'),
            'next_step' => route('decision_matrices'),
            'alternatives' => $alternatives
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alternative.create')->with([
            'title' => 'Tambah Alternatif',
            'prev_step' => route('criteria.index'),
            'next_step' => route('alternative.index'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $criterion = new Alternative();
        $criterion->name = $validatedData['name'];
        $criterion->save();

        return redirect()->route('alternative.index')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternative $alternative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternative $alternative)
    {
        return view('alternative.edit')->with([
            'title' => 'Edit Kriteria',
            'alternative' => $alternative,
            'prev_step' => route('alternative.index'),
            'next_step' => route('alternative.update', $alternative->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternative $alternative)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update data kriteria berdasarkan data yang divalidasi
        $alternative->update($validatedData);
        return redirect()->route('alternative.index')->with('success', 'Alternatif berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternative $alternative)
    {
        $alternative->delete();
        return redirect()->route('alternative.index')->with('success', 'Alternative berhasil dihapus.');
    }
}
