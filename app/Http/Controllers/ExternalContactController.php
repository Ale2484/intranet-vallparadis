<?php

namespace App\Http\Controllers;

use App\Models\ExternalContact;
use App\Models\Center;
use Illuminate\Http\Request;

class ExternalContactController extends Controller
{
    protected $paginateNumber = 21;

    public function index()
    {
        $externalContacts = ExternalContact::with('center')->orderBy('created_at', 'desc')->paginate($this->paginateNumber);
        return view('external_contacts.index', compact('externalContacts'));
    }

    public function create()
    {
        $centers = Center::all();
        $externalContact = new ExternalContact();
        return view('external_contacts.create', compact('externalContact', 'centers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'center_id' => 'required|exists:centers,id',
            'category' => 'required|in:assistencial,"serveis generals"',
            'reason' => 'required|string|max:255',
            'company_or_department' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'observations' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        ExternalContact::create($validated);

        return redirect()->route('external-contacts.index')->with('success', 'Contacte extern creat correctament.');
    }

    public function show(ExternalContact $externalContact)
    {
        return view('external_contacts.show', compact('externalContact'));
    }

    public function edit(ExternalContact $externalContact)
    {
        $centers = Center::all();
        return view('external_contacts.edit', compact('externalContact', 'centers'));
    }

    public function update(Request $request, ExternalContact $externalContact)
    {
        $validated = $request->validate([
            'center_id' => 'required|exists:centers,id',
            'category' => 'required|in:assistencial,"serveis generals"',
            'reason' => 'required|string|max:255',
            'company_or_department' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'observations' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $externalContact->update($validated);

        return redirect()->route('external-contacts.index')->with('success', 'Contacte extern actualitzat correctament.');
    }

    public function destroy(ExternalContact $externalContact)
    {
        $externalContact->delete();
        return redirect()->route('external-contacts.index')->with('success', 'Contacte extern eliminat correctament.');
    }
}
