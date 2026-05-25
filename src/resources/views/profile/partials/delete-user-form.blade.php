<section>
    <header>
        <h2 style="font-size:16px;font-weight:600;color:#dc2626;margin-bottom:4px;">删除账号</h2>
        <p style="font-size:13px;color:#8b6f5e;margin-bottom:16px;">
            账号删除后所有数据将永久丢失，无法恢复。请谨慎操作。
        </p>
    </header>

    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            style="padding:10px 20px;border:1.5px solid #fecaca;border-radius:10px;font-size:14px;font-weight:600;color:#dc2626;background:#fff;cursor:pointer;">
        删除账号
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding:24px;">
            @csrf
            @method('delete')

            <h2 style="font-size:17px;font-weight:700;color:#4a3728;margin-bottom:8px;">确认删除账号？</h2>
            <p style="font-size:13px;color:#8b6f5e;margin-bottom:20px;">
                此操作不可撤销。请输入密码确认删除。
            </p>

            <div style="margin-bottom:20px;">
                <input id="delete-password" name="password" type="password" required
                       placeholder="请输入密码"
                       style="width:100%;padding:10px 14px;border:1.5px solid #fecaca;border-radius:12px;font-size:14px;color:#4a3728;outline:none;">
                @error('password', 'userDeletion')
                    <div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;">
                <button type="button" x-on:click="$dispatch('close')"
                        style="padding:10px 20px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;font-weight:500;color:#8b6f5e;background:#fff;cursor:pointer;">
                    取消
                </button>
                <button type="submit"
                        style="padding:10px 20px;border:none;border-radius:10px;font-size:14px;font-weight:600;color:#fff;background:#dc2626;cursor:pointer;">
                    确认删除
                </button>
            </div>
        </form>
    </x-modal>
</section>
