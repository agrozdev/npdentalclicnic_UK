# NP Dental Clinic — AI Chat Project

## Project Stack
- Laravel (existing project)
- MySQL database
- Blade templates
- Claude API (already integrated)
- Twilio (configured)
- Filament v4 (installed — v3 is incompatible with Laravel 13)

## Server
- VM: 192.168.99.10
- Nginx reverse proxy: 192.168.99.200
- Domain: npdentalclinic.co.uk

## What we're building
AI chat widget with knowledge base for npdentalclinic.co.uk

### Features:
1. Chat widget (vanilla JS) embedded in Blade layout
2. Laravel backend — /api/chat endpoint
3. Knowledge base — chat_knowledge table in MySQL
4. Filament v3 admin panel at /backoffice (not /admin)
5. WhatsApp handoff button after 2-3 messages
6. Lead logging in DB

## Database tables to create

### chat_knowledge
- id
- type (enum: faq, case_study, service, pricing)
- title
- keywords (text, comma separated)
- content (longtext)
- is_active (boolean, default true)
- priority (int, default 0)
- timestamps

### chat_leads
- id
- source (enum: chat, phone, whatsapp)
- name (nullable)
- phone (nullable)
- email (nullable)
- first_message (text)
- status (enum: new, contacted, booked, default: new)
- timestamps

## Filament Admin Panel
- Install Filament v3
- Custom path: /backoffice (NOT /admin)
- Custom login URL: /backoffice/login
- Resources:
  - ChatKnowledgeResource (full CRUD)
    - Table columns: title, type, priority, is_active
    - Form fields: type, title, keywords, content (rich editor), priority, is_active
    - Filters: by type, by is_active
    - Bulk actions: activate, deactivate
  - ChatLeadResource (read only + status update)
    - Table columns: source, name, phone, first_message, status, created_at
    - Action: change status (new → contacted → booked)
    - No create/delete — leads come from chat only

## Filament Configuration
In AppServiceProvider or PanelProvider:
->path('backoffice')
->loginRouteSlug('login')
->brandName('NP Dental — Backoffice')
->colors(['primary' => Color::Amber])  // gold to match clinic branding

## API Endpoint
POST /api/chat
- Input: { messages: [...] }  // full conversation history
- Output: { message: string, suggest_whatsapp: boolean }

## ChatController Logic
1. Get last user message
2. Call KnowledgeService::findRelevant($message, limit: 3)
3. Build system prompt with clinic info + KB context
4. Call Claude API (claude-sonnet-4-6, max_tokens: 1024)
5. Detect if WhatsApp should be suggested
6. Log lead if first message
7. Return { message, suggest_whatsapp }

## KnowledgeService
- findRelevant(string $message, int $limit = 3): string
- Search in: keywords, title, content (LIKE)
- Order by priority DESC
- Return formatted string for system prompt injection

## System Prompt for Claude API
You are a helpful assistant for NP Dental Clinic (npdentalclinic.co.uk).
Always answer in the same language the client uses (English or Bulgarian).
Be warm, professional and concise.
Clinic info:
- Location: [ADDRESS]
- WhatsApp: wa.me/44XXXXXXXXXX
- Services: dental implants, veneers, whitening, general dentistry

Suggest WhatsApp for: specific pricing, booking appointments, 
complex cases, urgent matters.

Use the KNOWLEDGE BASE section below to give accurate answers.
If not covered — answer generally and offer WhatsApp for details.

## Widget Behavior
- Floating bubble bottom-right
- Dark/gold colors (clinic branding)
- Welcome message on open
- After 2-3 exchanges → show WhatsApp banner
- Input: Enter key or send button
- Loading indicator (...)

## Implementation Order
Step 1: Install Filament v3, configure /backoffice path
Step 2: Migrations — chat_knowledge, chat_leads
Step 3: Models + Filament Resources (ChatKnowledge, ChatLead)
Step 4: KnowledgeService
Step 5: ChatController + /api/chat route
Step 6: JS Widget + embed in Blade layout
Step 7: Seed initial knowledge base (FAQ, services, case studies)

## Start Here
Run in order:
composer require filament/filament:"^4.0"  ← v3 incompatible with Laravel 13
php artisan filament:install --panels
→ Then configure panel path to 'backoffice'
→ Then proceed with migrations