<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        // dd(Chirp::with('user')->latest()->get());

        return view('pages.comment.index',[
            "comments" => Chirp::with('user')
                            ->latest()
                            ->paginate(3),
        ]);

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
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirps()->create($validate);

        return redirect(route('comment.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $comment): View
    {
        Gate::authorize('update', $comment);


        return view('pages.comment.edit', [
            'comment' => $comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $comment): RedirectResponse
    {
        Gate::authorize('update', $comment);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $comment->update($validated);

        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $comment)
    {
        //
    }
}
