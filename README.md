## Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# 📚 API Endpoints - SmartFeed

## 🔷 Trends
- `GET /api/trends` - Recupera tutti i trend
- `GET /api/trends/today` - Recupera tutti i trend di oggi
- `GET /api/trends/{id}` - Dettaglio di un trend
- `POST /api/trends` - Crea un nuovo trend
- `PUT /api/trends/{id}` - Aggiorna un trend esistente
- `DELETE /api/trends/{id}` - Elimina un trend

## 🔷 News
- `GET /api/news` - Recupera tutte le news
- `GET /api/news/{id}` - Dettaglio di una news
- `POST /api/news` - Crea una nuova news
- `PUT /api/news/{id}` - Aggiorna una news
- `DELETE /api/news/{id}` - Elimina una news

## 🔷 Contents
- `GET /api/contents` - Recupera tutti i contenuti
- `GET /api/contents/{id}` - Dettaglio di un contenuto
- `POST /api/contents` - Crea un contenuto
- `PUT /api/contents/{id}` - Aggiorna un contenuto
- `DELETE /api/contents/{id}` - Elimina un contenuto

## 🔷 Newsletter Logs
- `GET /api/newsletter-logs` - Visualizza log invii newsletter
- `GET /api/newsletter-logs/{id}` - Dettaglio log specifico

## 🔷 Custom Inputs
- `GET /api/custom-inputs` - Lista input personalizzati
- `POST /api/custom-inputs` - Aggiungi input personalizzato
- `DELETE /api/custom-inputs/{id}` - Elimina input personalizzato

## 🔷 AI Feedback
- `GET /api/ai-feedback` - Visualizza feedback AI
- `POST /api/ai-feedback` - Registra un feedback
- `DELETE /api/ai-feedback/{id}` - Elimina feedback

## 🔷 Discarded Ideas
- `GET /api/discarded-ideas` - Lista idee scartate
- `POST /api/discarded-ideas` - Aggiungi idea scartata
- `DELETE /api/discarded-ideas/{id}` - Elimina idea scartata

## 🔷 Logs
- `GET /api/logs` - Visualizza log di sistema
