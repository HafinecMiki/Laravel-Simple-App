@component('mail::message_no_default')
<div class="verify-code-main-div">
<h2>
    Hi! <br />
    Your two-factor authentication code:
</h2>
<div class="verify-code-div">
    <h1 class="verify-code-text">{{ $code }}</h1>
</div>
</div>
@endcomponent
