<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $data = session('form_data', []);
        return view('index', compact('data'));
    }

    public function confirm(ContactRequest $request)
    {
        $request->session()->put('form_data', $request->only(['name', 'gender', 'email', 'tel', 'address', 'building', 'content_type', 'content']));
        
        $contact = $request->only(['name', 'gender', 'email', 'tel', 'address', 'building', 'content_type', 'content']);
        return view('confirm', ['contact' => $contact]);
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['name', 'gender', 'email', 'tel', 'address', 'building', 'content_type', 'content']);
        Contact::create($contact);
        
        $request->session()->forget('form_data');

        return view('thanks');
    }

    public function clearSession(Request $request)
    {
        $request->session()->forget('form_data');
        
        return redirect()->route('contacts.index');
    }

    public function getContacts()
    {
        $contacts = Contact::paginate(7);
        return view('admin', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
    
        return view('contact.details', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['success' => true]);
    }
    

}