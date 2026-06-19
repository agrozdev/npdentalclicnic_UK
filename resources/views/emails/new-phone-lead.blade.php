<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Phone Lead</title>
<style>
  body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
  .card { background: #fff; border-radius: 8px; max-width: 620px; margin: 0 auto; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
  h2 { color: #b8860b; margin-top: 0; }
  .label { font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
  .value { font-size: 15px; color: #222; margin-bottom: 16px; word-break: break-word; }
  .badge { display: inline-block; background: #f9f6ee; border: 1px solid #b8860b; color: #b8860b; border-radius: 4px; padding: 3px 10px; font-size: 13px; font-weight: bold; margin-bottom: 16px; }
  .admin-btn { display: inline-block; margin: 0 0 20px; padding: 10px 20px; background: #b8860b; color: #fff !important; text-decoration: none; border-radius: 5px; font-size: 14px; font-weight: bold; }
  .divider { border: none; border-top: 1px solid #eee; margin: 20px 0; }
  .footer { font-size: 12px; color: #aaa; margin-top: 24px; text-align: center; }
</style>
</head>
<body>
<div class="card">
  <h2>📞 New Phone Lead</h2>
  <div class="badge">Submitted during call</div>

  <a class="admin-btn" href="{{ url('/backoffice/phone-leads/' . $record->id) }}">View in Admin →</a>

  @if($lead['name'])
  <div class="label">Name</div>
  <div class="value">{{ $lead['name'] }}</div>
  @endif

  <div class="label">Caller Number</div>
  <div class="value">{{ $lead['caller_number'] }}</div>

  @if($lead['callback_number'] && $lead['callback_number'] !== $lead['caller_number'])
  <div class="label">Callback Number</div>
  <div class="value">{{ $lead['callback_number'] }}</div>
  @endif

  @if($lead['email'])
  <div class="label">Email</div>
  <div class="value">{{ $lead['email'] }}</div>
  @endif

  <hr class="divider">

  @if($lead['reason'])
  <div class="label">Reason for Calling</div>
  <div class="value">{{ $lead['reason'] }}</div>
  @endif

  @if($lead['preferred_time'])
  <div class="label">Preferred Appointment / Callback Time</div>
  <div class="value">{{ $lead['preferred_time'] }}</div>
  @endif

  <div class="footer">NP Dental Clinic — Phone Lead Notification</div>
</div>
</body>
</html>
