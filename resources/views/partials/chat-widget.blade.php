{{-- AI Chat Widget --}}
<div id="np-chat-widget">

    {{-- Call FAB --}}
    <a id="np-call-bubble" href="tel:{{ config('site.contact.phone_e164') }}" aria-label="Call us" title="{{ config('site.contact.phone_display') }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd"/>
        </svg>
    </a>

    {{-- Bubble trigger --}}
    <button id="np-chat-bubble" aria-label="Open chat" title="Chat with us">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
        </svg>
    </button>

    {{-- Chat window --}}
    <div id="np-chat-window" role="dialog" aria-label="NP Dental Chat" hidden>

        <div id="np-chat-header">
            <span>NP Dental — Ask us anything</span>
            <div style="display:flex;align-items:center;gap:8px;">
                <button id="np-chat-reset" aria-label="Reset chat" title="Start a new conversation">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                        <path d="M3 3v5h5"/>
                    </svg>
                </button>
                <button id="np-chat-close" aria-label="Close chat">&times;</button>
            </div>
        </div>

        {{-- Step 1: contact form --}}
        <div id="np-contact-step">
            <p id="np-contact-intro">Before we start, please share your details so our team can follow up if needed.</p>
            <form id="np-contact-form" autocomplete="off" novalidate>
                <div class="np-field">
                    <label for="np-field-name">Your name <span class="np-req">*</span></label>
                    <input id="np-field-name" type="text" placeholder="John Smith" autocomplete="name" />
                    <span class="np-err" id="np-err-name"></span>
                </div>
                <div class="np-field">
                    <label for="np-field-phone">Phone number <span class="np-req">*</span></label>
                    <input id="np-field-phone" type="tel" placeholder="+44 7700 900000" autocomplete="tel" />
                    <span class="np-err" id="np-err-phone"></span>
                </div>
                <div class="np-field">
                    <label for="np-field-email">Email <span class="np-opt">(optional)</span></label>
                    <input id="np-field-email" type="email" placeholder="john@example.com" autocomplete="email" />
                    <span class="np-err" id="np-err-email"></span>
                </div>
                <button type="submit" id="np-contact-submit">Start Chat</button>
            </form>
        </div>

        {{-- Step 2: chat interface --}}
        <div id="np-chat-step" hidden>
            <div id="np-chat-messages" aria-live="polite"></div>

            <form id="np-chat-form" autocomplete="off">
                <input id="np-chat-input" type="text" placeholder="Type your question…" autocomplete="off" />
                <button type="submit" aria-label="Send">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3.478 2.405a.75.75 0 0 0-.926.94l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.405Z"/>
                    </svg>
                </button>
            </form>
        </div>

    </div>
</div>

<style>
#np-chat-widget {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9999;
    font-family: system-ui, sans-serif;
}

/* ── Bubble ── */
#np-chat-bubble {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #b8960c;
    color: #fff;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 16px rgba(0,0,0,.3);
    transition: background .2s, transform .2s;
}
#np-chat-bubble:hover { background: #9a7d0a; transform: scale(1.05); }
#np-chat-bubble svg { width: 28px; height: 28px; }
#np-chat-bubble.np-hidden { display: none; }

/* ── Call FAB ── */
#np-call-bubble {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #2d2d4e;
    color: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,.3);
    margin-bottom: 12px;
    transition: background .2s, transform .2s;
    text-decoration: none;
}
#np-call-bubble:hover { background: #1a1a35; transform: scale(1.05); }
#np-call-bubble svg { width: 26px; height: 26px; }

/* ── Window ── */
#np-chat-window {
    position: absolute;
    bottom: 70px;
    right: 0;
    width: 340px;
    background: #1a1a2e;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,.4);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}
#np-chat-window[hidden] { display: none; }

/* ── Header ── */
#np-chat-header {
    background: #b8960c;
    color: #fff;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    font-size: 14px;
    flex-shrink: 0;
}
#np-chat-close {
    background: none;
    border: none;
    color: #fff;
    font-size: 22px;
    cursor: pointer;
    line-height: 1;
    padding: 0;
}
#np-chat-reset {
    background: none;
    border: none;
    color: rgba(255,255,255,.75);
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    transition: color .2s;
}
#np-chat-reset:hover { color: #fff; }
#np-chat-reset svg { width: 15px; height: 15px; }

/* ── Contact form step ── */
#np-contact-step {
    padding: 16px;
}
#np-contact-intro {
    color: #c8c8e0;
    font-size: 13px;
    margin: 0 0 14px;
    line-height: 1.5;
}
.np-field {
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.np-field label {
    color: #aaa;
    font-size: 12px;
}
.np-req { color: #b8960c; }
.np-opt { color: #666; font-size: 11px; }
.np-field input {
    background: #12122a;
    border: 1px solid #2d2d4e;
    border-radius: 8px;
    color: #e8e8e8;
    padding: 8px 10px;
    font-size: 13px;
    outline: none;
    transition: border-color .2s;
}
.np-field input:focus { border-color: #b8960c; }
.np-field input.np-invalid { border-color: #e05555; }
.np-err { color: #e05555; font-size: 11px; min-height: 14px; }
#np-contact-submit {
    width: 100%;
    margin-top: 6px;
    background: #b8960c;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
}
#np-contact-submit:hover { background: #9a7d0a; }

/* ── Chat step ── */
#np-chat-step {
    display: flex;
    flex-direction: column;
    max-height: 460px;
}
#np-chat-step[hidden] { display: none; }

#np-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.np-msg {
    max-width: 85%;
    padding: 8px 12px;
    border-radius: 12px;
    font-size: 13px;
    line-height: 1.5;
    word-break: break-word;
}
.np-msg.user      { background: #b8960c; color: #fff; align-self: flex-end; border-bottom-right-radius: 2px; }
.np-msg.assistant { background: #2d2d4e; color: #e8e8e8; align-self: flex-start; border-bottom-left-radius: 2px; }
.np-msg.typing    { color: #999; font-style: italic; }

.np-wa-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    width: 100%;
    padding: 11px 16px;
    background: #25d366;
    border-radius: 10px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    box-sizing: border-box;
    transition: background .2s;
    margin-top: 4px;
}
.np-wa-btn:hover { background: #1ebd5a; }
.np-wa-btn svg { width: 22px; height: 22px; flex-shrink: 0; }

#np-chat-form {
    display: flex;
    border-top: 1px solid #2d2d4e;
    background: #12122a;
    flex-shrink: 0;
}
#np-chat-input {
    flex: 1; background: transparent; border: none;
    color: #e8e8e8; padding: 10px 14px; font-size: 13px; outline: none;
}
#np-chat-input::placeholder { color: #666; }
#np-chat-form button[type=submit] {
    background: none; border: none; color: #b8960c;
    cursor: pointer; padding: 0 14px;
    display: flex; align-items: center;
}
#np-chat-form button[type=submit]:hover { color: #d4a80e; }
#np-chat-form button[type=submit] svg { width: 18px; height: 18px; }

@media (max-width: 400px) {
    #np-chat-window { width: calc(100vw - 32px); right: 0; }
}
</style>

<script>
(function () {
    const WELCOME     = 'Hello! I\'m the NP Dental assistant. How can I help you today?';
    const API_URL     = '{{ url("/api/chat") }}';
    const TOKEN_KEY   = 'np_chat_token';
    const DONE_KEY    = 'np_chat_contact_done';
    const MSGS_KEY    = 'np_chat_messages';
    const TIME_KEY    = 'np_chat_time';
    const TTL         = 24 * 60 * 60 * 1000; // 24 hours

    // ── Elements ──────────────────────────────────────────────────────────
    const bubble      = document.getElementById('np-chat-bubble');
    const win         = document.getElementById('np-chat-window');
    const closeBtn    = document.getElementById('np-chat-close');
    const contactStep = document.getElementById('np-contact-step');
    const contactForm = document.getElementById('np-contact-form');
    const chatStep    = document.getElementById('np-chat-step');
    const msgBox      = document.getElementById('np-chat-messages');
    const chatForm    = document.getElementById('np-chat-form');
    const chatInput   = document.getElementById('np-chat-input');

    // ── Session restore / expiry ──────────────────────────────────────────
    function generateUUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            const r = Math.random() * 16 | 0;
            return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });
    }

    function clearSession() {
        localStorage.removeItem(TOKEN_KEY);
        localStorage.removeItem(DONE_KEY);
        localStorage.removeItem(MSGS_KEY);
        localStorage.removeItem(TIME_KEY);
    }

    const savedTime = parseInt(localStorage.getItem(TIME_KEY) || '0');
    if (savedTime && (Date.now() - savedTime) > TTL) {
        clearSession();
    }

    let sessionToken = localStorage.getItem(TOKEN_KEY);
    let contactDone  = localStorage.getItem(DONE_KEY) === '1';
    let messages     = JSON.parse(localStorage.getItem(MSGS_KEY) || '[]');
    let contactInfo  = {};

    if (!sessionToken) {
        sessionToken = generateUUID();
        localStorage.setItem(TOKEN_KEY, sessionToken);
        localStorage.setItem(TIME_KEY, Date.now().toString());
    }

    function saveMessages() {
        localStorage.setItem(MSGS_KEY, JSON.stringify(messages));
    }

    const WA_URL = 'https://wa.me/359887570020';
    const WA_SVG = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>';

    function showWhatsApp() {
        if (document.querySelector('.np-wa-btn')) return; // only once
        const a = document.createElement('a');
        a.className   = 'np-wa-btn';
        a.href        = WA_URL;
        a.target      = '_blank';
        a.rel         = 'noopener';
        a.innerHTML   = WA_SVG + ' Contact us on WhatsApp';
        msgBox.appendChild(a);
        msgBox.scrollTop = msgBox.scrollHeight;
    }

    // ── Helpers ───────────────────────────────────────────────────────────
    function appendMsg(role, text) {
        const div = document.createElement('div');
        div.className = 'np-msg ' + role;
        div.textContent = text;
        msgBox.appendChild(div);
        msgBox.scrollTop = msgBox.scrollHeight;
        return div;
    }

    function restoreMessages() {
        messages.forEach(function (m) {
            appendMsg(m.role, m.content);
        });
        msgBox.scrollTop = msgBox.scrollHeight;
    }

    function showChat() {
        contactStep.hidden = true;
        chatStep.hidden    = false;
        if (messages.length === 0) {
            appendMsg('assistant', WELCOME);
        } else {
            restoreMessages();
        }
        chatInput.focus();
    }

    function openWidget() {
        win.hidden = false;
        bubble.classList.add('np-hidden');
        if (contactDone) {
            showChat();
        }
    }

    function closeWidget() {
        win.hidden = true;
        bubble.classList.remove('np-hidden');
    }

    // ── Contact form ──────────────────────────────────────────────────────
    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const nameEl   = document.getElementById('np-field-name');
        const phoneEl  = document.getElementById('np-field-phone');
        const emailEl  = document.getElementById('np-field-email');
        const errName  = document.getElementById('np-err-name');
        const errPhone = document.getElementById('np-err-phone');
        const errEmail = document.getElementById('np-err-email');

        let valid = true;
        nameEl.classList.remove('np-invalid');
        phoneEl.classList.remove('np-invalid');
        emailEl.classList.remove('np-invalid');
        errName.textContent  = '';
        errPhone.textContent = '';
        errEmail.textContent = '';

        if (!nameEl.value.trim()) {
            nameEl.classList.add('np-invalid');
            errName.textContent = 'Please enter your name.';
            valid = false;
        }
        if (!phoneEl.value.trim()) {
            phoneEl.classList.add('np-invalid');
            errPhone.textContent = 'Please enter your phone number.';
            valid = false;
        }
        const emailVal = emailEl.value.trim();
        if (emailVal && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) {
            emailEl.classList.add('np-invalid');
            errEmail.textContent = 'Please enter a valid email address.';
            valid = false;
        }
        if (!valid) return;

        contactInfo = {
            name:  nameEl.value.trim(),
            phone: phoneEl.value.trim(),
            email: emailEl.value.trim() || null,
        };

        contactDone = true;
        localStorage.setItem(DONE_KEY, '1');
        showChat();
    });

    // ── Chat form ─────────────────────────────────────────────────────────
    chatForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const text = chatInput.value.trim();
        if (!text) return;

        chatInput.value = '';
        appendMsg('user', text);
        messages.push({ role: 'user', content: text });
        saveMessages();

        const typing = appendMsg('assistant typing', '…');

        const payload = { session_token: sessionToken, messages: messages };

        if (Object.keys(contactInfo).length > 0) {
            payload.name  = contactInfo.name;
            payload.phone = contactInfo.phone;
            if (contactInfo.email) payload.email = contactInfo.email;
            contactInfo = {};
        }

        try {
            const res  = await fetch(API_URL, {
                method:  'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body:    JSON.stringify(payload),
            });
            const data = await res.json();
            typing.remove();

            const reply = data.message || 'Sorry, something went wrong.';
            appendMsg('assistant', reply);
            messages.push({ role: 'assistant', content: reply });
            saveMessages();

            if (data.suggest_whatsapp) {
                showWhatsApp();
            }
        } catch (err) {
            typing.remove();
            appendMsg('assistant', 'Sorry, I\'m having trouble connecting. Please try again shortly.');
        }
    });

    // ── Reset ─────────────────────────────────────────────────────────────
    document.getElementById('np-chat-reset').addEventListener('click', function () {
        clearSession();
        sessionToken = generateUUID();
        contactDone  = false;
        messages     = [];
        contactInfo  = {};
        localStorage.setItem(TOKEN_KEY, sessionToken);
        localStorage.setItem(TIME_KEY, Date.now().toString());
        msgBox.innerHTML        = '';
        chatStep.hidden         = true;
        contactStep.hidden      = false;
        document.getElementById('np-contact-form').reset();
    });

    // ── Bubble / close ────────────────────────────────────────────────────
    bubble.addEventListener('click', openWidget);
    closeBtn.addEventListener('click', closeWidget);
}());
</script>
