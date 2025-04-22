<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Starter Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        h1, h2, h3 {
            color: #2c3e50;
        }
        code {
            background-color: #f4f4f4;
            padding: 0.2rem;
            border-radius: 5px;
        }
        pre {
            background-color: #2d2d2d;
            color: #fff;
            padding: 1rem;
            border-radius: 5px;
            overflow-x: auto;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 10px;
        }
        .note {
            background-color: #e7f7d4;
            padding: 10px;
            border-left: 4px solid #4caf50;
            margin-bottom: 20px;
        }
        .important {
            color: #e74c3c;
            font-weight: bold;
        }
        .api-example {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <h1>📘 Laravel Starter Project</h1>

    <h2>🔧 Getting Started</h2>
    <p>After cloning the repository, follow these steps to get the application up and running:</p>

    <pre><code># Step 1: Go to the project directory
cd your-laravel-project

# Step 2: Install PHP dependencies
composer install

# Step 3: Copy environment file
cp .env.example .env

# Step 4: Generate application key
php artisan key:generate

# Step 5: Configure your database in the `.env` file
# (Skip this if you want to use SQLite)

# Step 6: Run migrations and seed the database
php artisan migrate --seed

# Step 7: Install Node dependencies
npm install

# Step 8: Compile assets
npm run dev

# Step 9: Create symbolic link for storage
php artisan storage:link

# Step 10: Start the development server
php artisan serve
    </code></pre>

    <h2>🔐 Authentication</h2>

    <h3>1. Login (API)</h3>
    <p><strong>Endpoint:</strong> <code>POST {baseUrl}/api/login</code></p>
    <p><strong>Payload:</strong></p>
    <pre><code>{
  "email": "test@example.com",
  "password": "password"
}</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
  "status": "success",
  "message": "token_created",
  "data": {
    "token": "2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81"
  },
  "errors": null
}</code></pre>

    <div class="note">
        <p><strong>Note:</strong> You can optionally add a <code>token_expires_at</code> field like Laravel Passport does.</p>
    </div>

    <h3>2. Logout (API)</h3>
    <p><strong>Endpoint:</strong> <code>POST {baseUrl}/api/logout</code></p>
    <p><strong>Headers:</strong></p>
    <pre><code>Authorization: Bearer {your_token}</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
  "status": "success",
  "message": "logged_out",
  "data": null,
  "errors": null
}</code></pre>

    <h2>📚 Author Management (API)</h2>

    <h3>3. Get All Authors (Paginated)</h3>
    <p><strong>Endpoint:</strong> <code>GET {baseUrl}/api/authors</code></p>
    <p><strong>Headers:</strong></p>
    <pre><code>Authorization: Bearer {your_token}</code></pre>

    <h3>4. Get Author by ID</h3>
    <p><strong>Endpoint:</strong> <code>GET {baseUrl}/api/authors/{id}</code></p>
    <p><strong>Headers:</strong></p>
    <pre><code>Authorization: Bearer {your_token}</code></pre>

    <h3>5. Create Author</h3>
    <p><strong>Endpoint:</strong> <code>POST {baseUrl}/api/authors</code></p>
    <p><strong>Headers:</strong></p>
    <pre><code>Authorization: Bearer {your_token}</code></pre>
    <p><strong>Request:</strong></p>
    <pre><code>{
  "name": "required|string|max:45",
  "email": "required|email|unique:authors",
  "bio": "nullable|string|max:1000"
}</code></pre>

    <h3>6. Update Author</h3>
    <p><strong>Endpoint:</strong> <code>PUT {baseUrl}/api/authors/{id}</code></p>
    <p><strong>Headers:</strong></p>
    <pre><code>Authorization: Bearer {your_token}</code></pre>
    <p><strong>Request:</strong></p>
    <pre><code>{
  "name": "nullable|string|max:45|required_without_all:email,bio",
  "email": "nullable|email|unique:authors,email,{id}|required_without_all:name,bio",
  "bio": "nullable|string|max:1000|required_without_all:name,email"
}</code></pre>

    <h3>7. Delete Author</h3>
    <p><strong>Endpoint:</strong> <code>DELETE {baseUrl}/api/authors/{id}</code></p>
    <p><strong>Headers:</strong></p>
    <pre><code>Authorization: Bearer {your_token}</code></pre>
    <p><strong>Response:</strong></p>
    <pre><code>{
  "status": "success",
  "message": "author_deleted",
  "data": [],
  "errors": null
}</code></pre>

    <h2>✅ Features Covered</h2>
    <ul>
        <li>✔️ Blade starter kit installed</li>
        <li>✔️ Relational tables with foreign keys</li>
        <li>✔️ Seeders and factories for default/test data</li>
        <li>✔️ `hasMany` and `belongsTo` relationships (Author ↔ BlogPost)</li>
        <li>✔️ Soft deletes for blog posts</li>
        <li>✔️ Image upload support for blog posts</li>
        <li>✔️ Scope filters for published/unpublished posts</li>
        <li>✔️ Pagination for authors and blog posts</li>
        <li>✔️ Full CRUD APIs for authors</li>
        <li>✔️ Token-based login system</li>
    </ul>

    <h2>🧠 Architecture & Best Practices</h2>
    <ul>
        <li>✅ <strong>Form Requests & Policies:</strong> Validation and authorization handled per model</li>
        <li>✅ <strong>Service Layer:</strong> Business logic is isolated to services to keep controllers clean</li>
        <li>✅ <strong>Error Handling:</strong> Try-catch used in controllers to manage exceptions thrown by services</li>
        <li>✅ <strong>Logging:</strong> Errors are logged for easier debugging in production</li>
        <li>✅ <strong>Notifications:</strong> Exceptions can trigger support emails (optional feature)</li>
    </ul>

    <div class="note">
        <p><strong>Note:</strong> This project focuses on back-end features and architecture over UI/UX.</p>
    </div>

</body>
</html>
