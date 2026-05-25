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
        $messages = Contact::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('contact', compact('messages'));
    }

    /**
     * 处理留言提交（姓名/邮箱自动从当前登录用户获取）
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $user = $request->user();
        $data['user_id'] = $user->id;
        $data['name']    = $user->name;
        $data['email']   = $user->email;

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
