<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        // セッションからデータを取得
        $data = session('form_data', []);
        return view('index', compact('data'));
    }

    public function confirm(ContactRequest $request)
    {
        // 入力データをセッションに保存
        $request->session()->put('form_data', $request->only(['name', 'gender', 'email', 'tel', 'address', 'building', 'content_type', 'content']));
        
        $contact = $request->only(['name', 'gender', 'email', 'tel', 'address', 'building', 'content_type', 'content']);
        return view('confirm', ['contact' => $contact]);
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['name', 'gender', 'email', 'tel', 'address', 'building', 'content_type', 'content']);
        Contact::create($contact);
        
        // セッションからデータを削除
        $request->session()->forget('form_data');

        return view('thanks');
    }

    public function clearSession(Request $request)
    {
        // 他のボタンが押された場合、セッションをクリア
        $request->session()->forget('form_data');
        
        return redirect()->route('contacts.index'); // 必要に応じてリダイレクト先を変更
    }

    public function getContacts()
    {
        // 全てのコンタクトを取得
        $contacts = Contact::paginate(7);
        return view('admin', compact('contacts'));
    }

    public function show($id)
    {
        // 指定されたIDのコンタクトを取得
        $contact = Contact::findOrFail($id);
    
        return view('contact.details', compact('contact')); // 詳細ビューに渡す
    }
    
    public function destroy($id) {
    $contact = Contact::find($id);

    if (!$contact) {
        return response()->json(['success' => false, 'message' => 'コンタクトが見つかりません。'], 404);
    }

    $contact->delete();
    return response()->json(['success' => true]);
    }
}