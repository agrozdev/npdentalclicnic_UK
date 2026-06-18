<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Chat Enquiry</title>
<style>
  body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
  .card { background: #fff; border-radius: 8px; max-width: 600px; margin: 0 auto; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
  h2 { color: #b8860b; margin-top: 0; }
  .label { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
  .value { font-size: 15px; color: #222; margin-bottom: 16px; word-break: break-word; }
  .msg-box { background: #f9f6ee; border-left: 4px solid #b8860b; padding: 12px 16px; border-radius: 4px; margin-bottom: 16px; white-space: pre-wrap; }
  .footer { font-size: 12px; color: #aaa; margin-top: 24px; text-align: center; }
</style>
</head>
<body>
<div class="card">
  <h2>New Chat Enquiry</h2>

  <div class="label">Received</div>
  <div class="value">{{ $lead->created_at->format('d M Y, H:i') }} UTC</div>

  @if($lead->name)
  <div class="label">Name</div>
  <div class="value">{{ $lead->name }}</div>
  @endif

  @if($lead->phone)
  <div class="label">Phone</div>
  <div class="value">{{ $lead->phone }}</div>
  @endif

  @if($lead->email)
  <div class="label">Email</div>
  <div class="value">{{ $lead->email }}</div>
  @endif

  <div class="label">First message</div>
  <div class="msg-box">{{ $lead->first_message }}</div>

  <div class="label">AI reply</div>
  <div class="msg-box">{{ $aiReply }}</div>

  <div class="footer">NP Dental Clinic — Chat Notification</div>
</div>
</body>
</html>
