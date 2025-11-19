<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif;">

<h1>Renewal Reminder</h1>

<p>Your <strong>{{ $name }}</strong> subscription will renew in 3 days.</p>

<p>
    <a href="{{ $url }}"
       style="display: inline-block; padding: 10px 20px; background: #3b82f6; color: white; text-decoration: none; border-radius: 5px;">
        Cancel Subscription
    </a>
</p>

<p>Thanks,<br>{{ config('app.name') }}</p>

</body>
</html>
