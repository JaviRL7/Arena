<div class="following-user" style="width: 800px; display: flex; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
    <img src="{{ asset($following->user_photo) }}" alt="User Photo" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 15px;">
    <div style="flex-grow: 1;">
        <p style="margin: 0; font-size: 18px; font-weight: bold;">{{ $following->name }}</p>
        <p style="margin: 0; color: #555;">@{{ $following->nick }}</p>
    </div>
    @if($isMutual)
        <span style="margin-right: 20px; color: green;">Mutuals</span>
    @endif
</div>
