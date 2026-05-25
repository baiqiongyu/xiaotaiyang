<x-guest-layout>
    <div class="auth-title">联系我们 💬</div>
    <div class="auth-subtitle" style="margin-bottom:24px;">
        有疑问或建议？欢迎留言，我们会尽快回复你
    </div>

    @if (session('status') === 'message-sent')
        <div style="padding:12px 16px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;font-size:13px;color:#166534;margin-bottom:20px;text-align:center;">
            ✅ 留言已发送，感谢你的反馈！我们会尽快联系你 🌸
        </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf

        <div class="auth-field">
            <label for="name" class="auth-label">姓名 <span style="color:#e85d5d;">*</span></label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                   class="auth-input" placeholder="你的名字">
            @error('name')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div class="auth-field">
            <label for="email" class="auth-label">邮箱 <span style="color:#e85d5d;">*</span></label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                   class="auth-input" placeholder="用于接收回复">
            @error('email')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div class="auth-field">
            <label for="phone" class="auth-label">电话</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                   class="auth-input" placeholder="选填">
        </div>

        <div class="auth-field">
            <label for="subject" class="auth-label">主题 <span style="color:#e85d5d;">*</span></label>
            <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required
                   class="auth-input" placeholder="如：合作咨询、功能建议">
            @error('subject')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div class="auth-field">
            <label for="message" class="auth-label">留言内容 <span style="color:#e85d5d;">*</span></label>
            <textarea id="message" name="message" required rows="5"
                      class="auth-input" style="resize:vertical;min-height:120px;line-height:1.6;"
                      placeholder="请详细描述你的问题或想法...">{{ old('message') }}</textarea>
            @error('message')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="auth-btn">发送留言</button>

        <div class="auth-footer">
            <a href="/">← 返回首页</a>
        </div>
    </form>
</x-guest-layout>
