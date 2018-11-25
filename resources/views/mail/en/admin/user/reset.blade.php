<h1>{{ $data->subject }}</h1>

<p>
    Hi, we receive a password reset to that account!
    Use the link above to change the password of your account.
</p>

<p>
    <a href="{{ $data->reset_link }}">Click here to change the secure password of your account</a>
</p>

<hr>

<small>{{ $data->reset_link }}</small>
