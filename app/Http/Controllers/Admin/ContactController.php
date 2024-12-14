<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
        $messages = Messages::paginate(10);
        return view('admin.pages.contact.index', compact('messages'));
    }

    public function destroy($messageId)
    {
        $message = Messages::findOrFail($messageId);
        $message->delete();
        return redirect()->route('admin.message.show')->with('success', 'Message Delete Successfully');
    }
}
