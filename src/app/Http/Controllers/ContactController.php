<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * 显示留言表单
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * 处理留言提交
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:50'],
            'email'   => ['required', 'email', 'max:100'],
            'phone'   => ['nullable', 'string', 'max:20'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $contact = Contact::create($data);

        // 发邮件通知站点管理员
        try {
            $adminEmail = config('mail.from.address');
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new ContactMail($contact));
            }
        } catch (\Exception $e) {
            // 邮件发失败不影响留言保存
            \Illuminate\Support\Facades\Log::warning('留言邮件发送失败: ' . $e->getMessage());
        }

        return redirect()->route('contact.show')->with('status', 'message-sent');
    }
}
