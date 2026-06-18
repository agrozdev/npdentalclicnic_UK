<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Chat Enquiry</title>
<style>
  body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
  .card { background: #fff; border-radius: 8px; max-width: 620px; margin: 0 auto; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
  h2 { color: #b8860b; margin-top: 0; }
  .label { font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
  .value { font-size: 15px; color: #222; margin-bottom: 16px; word-break: break-word; }
  .divider { border: none; border-top: 1px solid #eee; margin: 20px 0; }
  .conversation-title { font-size: 13px; font-weight: bold; color: #555; margin-bottom: 12px; text-transform: uppercase; letter-spacing: .5px; }
  .bubble { padding: 10px 14px; border-radius: 6px; margin-bottom: 10px; font-size: 14px; line-height: 1.5; white-space: pre-wrap; word-break: break-word; }
  .bubble-user { background: #f0f0f0; border-left: 4px solid #999; color: #333; }
  .bubble-assistant { background: #f9f6ee; border-left: 4px solid #b8860b; color: #222; }
  .bubble-role { font-size: 10px; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 4px; }
  .role-user { color: #888; }
  .role-assistant { color: #b8860b; }
  .view-link { display: inline-block; margin: 0 0 20px; padding: 10px 20px; background: #b8860b; color: #fff !important; text-decoration: none; border-radius: 5px; font-size: 14px; font-weight: bold; }
  .footer { font-size: 12px; color: #aaa; margin-top: 24px; text-align: center; }
</style>
</head>
<body>
<div class="card">
  <h2>New Chat Enquiry</h2>

  <a class="view-link" href="{{ url('/backoffice/chat-leads/' . $lead->id) }}">View Full Conversation →</a>

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

  <hr class="divider">

  <div class="conversation-title">Full conversation</div>

  @foreach($messages as $msg)
  <div class="bubble {{ $msg['role'] === 'user' ? 'bubble-user' : 'bubble-assistant' }}">
    <div class="bubble-role {{ $msg['role'] === 'user' ? 'role-user' : 'role-assistant' }}">
      {{ $msg['role'] === 'user' ? 'Patient' : 'AI Assistant' }}
    </div>
    {{ $msg['content'] }}
  </div>
  @endforeach

  {{-- append the latest AI reply if not already the last message --}}
  @php $lastMsg = !empty($messages) ? $messages[array_key_last($messages)] : null; @endphp
  @if(!$lastMsg || $lastMsg['role'] !== 'assistant')
  <div class="bubble bubble-assistant">
    <div class="bubble-role role-assistant">AI Assistant</div>
    {{ $aiReply }}
  </div>
  @endif

  <div class="footer">NP Dental Clinic — Chat Notification</div>
</div>
</body>
</html>
