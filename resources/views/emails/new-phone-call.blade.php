<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Phone Call</title>
<style>
  body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
  .card { background: #fff; border-radius: 8px; max-width: 620px; margin: 0 auto; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
  h2 { color: #b8860b; margin-top: 0; }
  .label { font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 2px; }
  .value { font-size: 15px; color: #222; margin-bottom: 16px; word-break: break-word; }
  .divider { border: none; border-top: 1px solid #eee; margin: 20px 0; }
  .admin-btn { display: inline-block; margin: 0 10px 20px 0; padding: 10px 20px; background: #b8860b; color: #fff !important; text-decoration: none; border-radius: 5px; font-size: 14px; font-weight: bold; }
  .recording-btn { display: inline-block; margin: 0 0 20px; padding: 10px 20px; background: #555; color: #fff !important; text-decoration: none; border-radius: 5px; font-size: 14px; font-weight: bold; }
  .summary-box { background: #f9f6ee; border-left: 4px solid #b8860b; padding: 12px 16px; border-radius: 4px; font-size: 14px; color: #333; line-height: 1.6; white-space: pre-wrap; }
  .footer { font-size: 12px; color: #aaa; margin-top: 24px; text-align: center; }
</style>
</head>
<body>
<div class="card">
  <h2>📞 New Phone Call</h2>

  <a class="admin-btn" href="{{ url('/backoffice/phone-leads/' . $record->id) }}">View Full Call in Admin →</a>
  @if($callData['recording_url'])
  <a class="recording-btn" href="{{ $callData['recording_url'] }}" target="_blank">🎧 Listen to Recording</a>
  @endif

  <div class="label">Caller Number</div>
  <div class="value">{{ $callData['caller_number'] }}</div>

  @if($callData['started_at'])
  <div class="label">Call Started</div>
  <div class="value">{{ \Carbon\Carbon::parse($callData['started_at'])->format('d M Y, H:i') }} UTC</div>
  @endif

  @if($callData['ended_at'])
  <div class="label">Call Ended</div>
  <div class="value">{{ \Carbon\Carbon::parse($callData['ended_at'])->format('d M Y, H:i') }} UTC</div>
  @endif

  <div class="label">Ended Reason</div>
  <div class="value">{{ $callData['ended_reason'] }}</div>

  @if($callData['summary'])
  <hr class="divider">
  <div class="label">AI Summary</div>
  <div class="summary-box">{{ $callData['summary'] }}</div>
  @endif

  <div class="footer">NP Dental Clinic — Phone Call Notification</div>
</div>
</body>
</html>
