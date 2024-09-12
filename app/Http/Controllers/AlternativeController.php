<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criterion;
use App\Models\DecisionMatrix;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AlternativeController extends Controller
{
    protected Collection $criteria;

    public function __construct()
    {
        $this->criteria = Criterion::all();
    }

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

    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];

        foreach ($this->criteria as $criterion) {
            $rules["criterion_$criterion->id"] = ['required', 'numeric'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('alternative.create')->with([
            'title' => 'Add Alternative',
            'criteria' => $this->criteria,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $alternative = Alternative::create([
            'name' => $request->input('name'),
        ]);

        foreach ($this->criteria as $criterion) {
            $inputName = 'criterion_' . $criterion->id;

            if ($request->has($inputName)) {
                $value = $request->input($inputName);

                DecisionMatrix::create([
                    'alternative_id' => $alternative->id,
                    'criterion_id' => $criterion->id,
                    'value' => $value,
                ]);
            }
        }

        return redirect()->route('alternatives.index')->with('success', 'Alternative added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternative $alternative): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $decisionMatrices = $alternative->decisionMatrices()->get();
        $newCriteria = Criterion::whereNotIn('id', $decisionMatrices->pluck('criterion_id'))->get();

        return view('alternative.edit')->with([
            'title' => 'Edit Alternative',
            'decisionMatrices' => $decisionMatrices,
            'newCriteria' => $newCriteria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternative $alternative): RedirectResponse
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $alternative->update([
            'name' => $request->input('name'),
        ]);

        foreach ($this->criteria as $criterion) {
            $inputName = 'criterion_' . $criterion->id;

            if ($request->has($inputName)) {
                $value = $request->input($inputName);

                $decisionMatrix = $alternative->decisionMatrices()
                    ->where('criterion_id', $criterion->id)
                    ->first();

                if ($decisionMatrix) {
                    $decisionMatrix->update(['value' => $value]);
                } else {
                    DecisionMatrix::create([
                        'alternative_id' => $alternative->id,
                        'criterion_id' => $criterion->id,
                        'value' => $value,
                    ]);
                }
            }
        }

        return redirect()->route('alternatives.index')->with('success', 'Alternative updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternative $alternative): RedirectResponse
    {
        $alternative->decisionMatrices()->delete();

        $alternative->delete();

        return redirect()->route('alternatives.index')->with('success', 'Alternative deleted successfully.');
    }
}
