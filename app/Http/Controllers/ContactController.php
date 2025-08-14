<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name', 'email', 'message'));

        return redirect()->back()->with('success', 'Gửi liên hệ thành công! Chúng tôi sẽ phản hồi sớm qua email của bạn.');
    }
    public function index()
    {
        // Lấy tất cả phản hồi từ khách hàng
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        // Trả về view để hiển thị trong admin dashboard
        return view('admin.contacts.index', compact('contacts'));
    }
    public function show($id)
{
    $contact = \App\Models\Contact::findOrFail($id);

    if (!$contact->is_read) {
        $contact->is_read = true;
        $contact->save();
    }

    return view('admin.contacts.show', compact('contact'));
}
public function reply(Request $request, $id)
{
    $contact = Contact::findOrFail($id);
     return view('admin.contacts.reply', compact('contact'));
    // Gửi mail
    Mail::to($contact->email)->send(new ContactReplyMail($request->reply));

    return redirect()->back()->with('success', 'Phản hồi đã được gửi thành công!');
}

// public function reply($id)
// {
//     $contact = Contact::findOrFail($id);
//     return view('admin.contacts.reply', compact('contact'));
// }

public function sendReply(Request $request, $id)
{
    $request->validate([
        'message' => 'required|string'
    ]);

    $contact = Contact::findOrFail($id);

    // Gửi mail cho khách hàng
    Mail::to($contact->email)->send(new ContactReplyMail($request->message));

    // Cập nhật trạng thái đã phản hồi
    $contact->is_replied = true;
    $contact->save();

    return redirect()->route('admin.contacts.show', $id)
        ->with('success', 'Đã gửi phản hồi cho khách hàng.');
}



}
