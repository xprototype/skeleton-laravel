<h1>{{ $data->subject }}</h1>

<p>
    Hi <strong>{{ $data->name }}</strong>, we are grateful to have you with us!
    Use the link above to activate your account.
</p>

<p>
    <a href="{{ $data->activation_link }}">Click here to activate your account</a>
</p>

<hr>

<small>{{ $data->activation_link }}</small>
