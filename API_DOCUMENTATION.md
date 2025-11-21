# Broadway Commissary - API Documentation

## Setup Instructions

### 1. Install Dependencies
```bash
cd c:\xampp\htdocs\BroadwayCommissary
composer install
```

### 2. Configure Email Settings
Edit `api/config/config.php` and update the following:
- `MAIL_HOST`: Your SMTP server (e.g., smtp.gmail.com)
- `MAIL_USERNAME`: Your email address
- `MAIL_PASSWORD`: Your app-specific password (for Gmail, use app passwords)
- `MAIL_FROM_ADDRESS`: Sender email address
- `MAIL_FROM_NAME`: Sender name

#### Gmail Configuration Example:
1. Enable 2-Factor Authentication on your Google account
2. Go to https://myaccount.google.com/apppasswords
3. Create an app password for Mail
4. Use that password in the config

### 3. File Permissions
Ensure the `storage/` directory is writable:
```bash
# On Windows, typically handled by file ownership
# The directory will be created automatically on first use
```

## API Endpoints

### Email Subscription API

#### Subscribe to Notifications
- **URL**: `/api/email/subscribe`
- **Method**: `POST`
- **Content-Type**: `application/json`

**Request Body:**
```json
{
  "email": "user@example.com"
}
```

**Success Response (201):**
```json
{
  "success": true,
  "message": "Te has suscrito exitosamente a nuestras notificaciones",
  "email": "user@example.com"
}
```

**Error Responses:**
- **400**: Invalid email or missing field
- **409**: Email already subscribed

---

#### Unsubscribe from Notifications
- **URL**: `/api/email/unsubscribe`
- **Method**: `POST`
- **Content-Type**: `application/json`

**Request Body:**
```json
{
  "email": "user@example.com"
}
```

**Success Response:**
```json
{
  "success": true,
  "message": "Te has desuscrito exitosamente"
}
```

---

#### Get All Subscribers (Admin)
- **URL**: `/api/email/subscribers`
- **Method**: `GET`

**Response:**
```json
{
  "success": true,
  "total": 5,
  "subscribers": [
    {
      "email": "user@example.com",
      "subscribed_at": "2025-11-17 10:30:00",
      "active": true
    }
  ]
}
```

---

### Contact Form API

#### Submit Contact Form
- **URL**: `/api/contact/submit`
- **Method**: `POST`
- **Content-Type**: `application/json`

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "+1 (555) 123-4567",
  "subject": "Inquiry about services",
  "message": "I would like to know more about your services..."
}
```

**Field Validations:**
- `name`: Required, 2-100 characters
- `email`: Required, valid email format, max 255 characters
- `phone`: Required, 7+ characters, valid phone format
- `subject`: Required, 3-100 characters
- `message`: Required, 10-5000 characters

**Success Response (201):**
```json
{
  "success": true,
  "message": "Tu mensaje ha sido enviado exitosamente. Pronto nos pondremos en contacto contigo.",
  "email_sent": true
}
```

**Error Response (400):**
```json
{
  "success": false,
  "message": "Validación fallida",
  "errors": {
    "name": "El nombre es requerido",
    "email": "El formato del correo electrónico no es válido",
    "phone": "El teléfono es requerido",
    "subject": "El asunto es requerido",
    "message": "El mensaje es requerido"
  }
}
```

---

#### Get All Submissions (Admin)
- **URL**: `/api/contact/submissions`
- **Method**: `GET`

**Response:**
```json
{
  "success": true,
  "total": 3,
  "submissions": [
    {
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+1 (555) 123-4567",
      "subject": "Inquiry about services",
      "message": "Message content...",
      "submitted_at": "2025-11-17 10:30:00",
      "ip_address": "192.168.1.1"
    }
  ]
}
```

---

### Health Check

#### API Health Status
- **URL**: `/api/health`
- **Method**: `GET`

**Response:**
```json
{
  "status": "ok",
  "timestamp": "2025-11-17 10:30:00"
}
```

---

## Frontend Integration

### JavaScript Example for Email Subscription

```javascript
async function subscribeToNotifications(email) {
  try {
    const response = await fetch('/BroadwayCommissary/api/email/subscribe', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ email })
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Subscribed successfully!');
    } else {
      console.error('Error:', data.message);
    }
  } catch (error) {
    console.error('Request failed:', error);
  }
}
```

### JavaScript Example for Contact Form

```javascript
async function submitContactForm(formData) {
  try {
    const response = await fetch('/BroadwayCommissary/api/contact/submit', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData)
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Form submitted successfully!');
      // Clear form or show success message
    } else {
      console.error('Validation errors:', data.errors);
    }
  } catch (error) {
    console.error('Request failed:', error);
  }
}
```

---

## File Structure

```
BroadwayCommissary/
├── .htaccess                 # URL rewriting rules
├── .gitignore               # Git ignore file
├── composer.json            # PHP dependencies
├── index.php                # Main page
├── api/
│   ├── router.php           # Main API router
│   ├── config/
│   │   └── config.php       # Configuration file (email, database, etc)
│   ├── controllers/
│   │   ├── EmailSubscriptionController.php
│   │   └── ContactFormController.php
│   └── validators/
│       ├── EmailValidator.php
│       └── ContactValidator.php
├── storage/
│   ├── subscribers.json     # Email subscribers (auto-generated)
│   └── submissions.json     # Contact form submissions (auto-generated)
└── ...other files
```

---

## Error Codes

| Code | Meaning |
|------|---------|
| 200 | OK - Request successful |
| 201 | Created - Resource created successfully |
| 400 | Bad Request - Invalid input or validation failed |
| 404 | Not Found - Endpoint not found |
| 405 | Method Not Allowed - Wrong HTTP method |
| 409 | Conflict - Email already exists |
| 500 | Internal Server Error |

---

## Security Considerations

1. **Validate all inputs** - Both frontend and backend validation is implemented
2. **Store credentials safely** - Update `api/config/config.php` with real credentials
3. **Use HTTPS** - Always use HTTPS in production
4. **Rate limiting** - Consider implementing rate limiting for production
5. **CORS** - Currently allows all origins; restrict in production
6. **File permissions** - Ensure `storage/` directory is not publicly accessible

---

## Troubleshooting

### PHPMailer not found
```bash
composer install
```

### SMTP Connection Error
- Verify credentials in `api/config/config.php`
- Check firewall/antivirus blocking SMTP port
- Enable "Less secure app access" (Gmail) or use app passwords

### Files not being saved
- Check `storage/` directory permissions
- Ensure directory exists and is writable

### CORS Issues
- The API allows CORS by default
- Modify `.htaccess` to restrict origins in production

---

## Support

For issues or questions about the API, check the error logs or contact the development team.
