# Setup Instructions

After cloning this repository, run the following commands to set up the application:

1. `cd your-laravel-project`
2. `composer install`
3. `cp .env.example .env`
4. `php artisan key:generate`
5. Set up your database (if not using SQLite).
6. `php artisan migrate --seed`
7. `npm install`
8. `npm run dev`
9. `php artisan storage:link`
10. `php artisan serve`

## API Authentication

### Login API
  - **POST Url** = '{baseUrl}.api/login'
#### Request

```json
  {
     "email" : "test@example.com"
	   "password" : "password"
  }
```
#### Response
```json
{
"status": "success",
  "message": "token_created",
  "data": {
    "token": "2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81"
  },
  "errors": null
}
```
### 2) Logout Token User
- **POST Url** = `{baseUrl}/api/logout`
- **Header** = `Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81`

#### Response
```json
{
  "status": "success",
  "message": "logged_out",
  "data": null,
  "errors": null
}
```
### 3) Get All Authors with Pagination
- **GET Url** = `{baseUrl}/api/authors`
- **Header** = `Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81`

#### Response
```json
{
  "status": "success",
  "message": "authors_retrieved",
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 10,
        "name": "Dr. Stanford Homenick MD",
        "email": "kassulke.reba@heller.info",
        "bio": "Voluptates voluptates est sed ut. Et quidem sit et iste quas nostrum in nisi. Nemo sapiente cum ut ad hic corrupti laborum.",
        "created_at": "2025-04-21T10:17:24.000000Z",
        "updated_at": "2025-04-21T10:17:24.000000Z"
      }
    ]
  }
}
```
### 4) Get Author by Author ID
- **GET Url** = `{baseUrl}/api/authors/{id}`
- **Header** = `Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81`

#### Response
```json
{
  "status": "success",
  "message": "author_retrieved",
  "data": {
    "id": 10,
    "name": "Dr. Stanford Homenick MD",
    "email": "kassulke.reba@heller.info",
    "bio": "Voluptates voluptates est sed ut. Et quidem sit et iste quas nostrum in nisi. Nemo sapiente cum ut ad hic corrupti laborum.",
    "created_at": "2025-04-21T10:17:24.000000Z",
    "updated_at": "2025-04-21T10:17:24.000000Z"
  },
  "errors": null
}
```
### 5) Create Author
- **POST Url** = `{baseUrl}/api/authors`
- **Header** = `Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81`

#### Request
```json
{
  "name": ["required", "string", "max:45"],
  "email": ["required", "email", "unique:authors"],
  "bio": ["nullable", "string", "max:1000"]
}
```
#### Response
```json
{
"status": "success",
    "message": "author_retrieved",
    "data": {
        "id": 10,
        "name": "Dr. Stanford Homenick MD",
        "email": "kassulke.reba@heller.info",
        "bio": "Voluptates voluptates est sed ut. Et quidem sit et iste quas nostrum in nisi. Nemo sapiente cum ut ad hic corrupti laborum.",
        "created_at": "2025-04-21T10:17:24.000000Z",
        "updated_at": "2025-04-21T10:17:24.000000Z"
    },
    "errors": null
}
```
### 6) Update Author
- **PUT Url** = `{baseUrl}/api/authors/{id}`
- **Header** = `Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81`

#### Request
```json
{
  "name": ["nullable", "string", "max:45", "required_without_all:email,bio"],
  "email": ["nullable", "email", "unique:authors,email,{id}", "required_without_all:name,bio"],
  "bio": ["nullable", "string", "max:1000", "required_without_all:name,email"]
}
```
#### Response
```json
{
"status": "success",
    "message": "author_updated",
    "data": {
        "id": 1,
        "name": "Test2",
        "email": "test2@gmail.com",
        "bio": "Error adipisci deserunt reiciendis. Aut repellat sequi voluptatem aut neque facere dolorum et. Molestias temporibus impedit libero tempora tempore velit. Ut atque et et voluptates et.",
        "created_at": "2025-04-21T10:17:23.000000Z",
        "updated_at": "2025-04-21T11:08:50.000000Z"
    },
    "errors": null
}
```
### 7) Delete Author
- **DELETE Url** = `{baseUrl}/api/authors/{id}`
- **Header** = `Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81`

#### Response
```json
{
  "status": "success",
  "message": "author_deleted",
  "data": [],
  "errors": null
}
```

### Features and Topics Covered in This Application

- **Blade Starter Kit**: Installed for frontend scaffolding.
- **Relational Tables**: Created using foreign keys to establish relationships.
- **Default and Test Data**: Added using seeders and factories for testing purposes.
- **Model Relationships**: Implemented `hasMany` and `belongsTo` relationships between the `Author` and `BlogPost` models.
- **Soft Deletes**: Added to the `BlogPost` model for soft deletion of posts.
- **Image Upload**: Enabled for `BlogPost` to allow image attachments.
- **Scope Filters**: Implemented filters to manage published and unpublished posts.
- **Pagination**: Added pagination to retrieve records for authors and blog posts efficiently.
- **CRUD APIs**: Created for managing authors.
- **Token-Based Authentication**: Implemented for secure login and API access.

### Validation and Business Logic

- **Form Requests & Policies**: Created for handling model validation and authorization at the application level.
- **Service Layer**: Designed to handle business logic and database operations, ensuring a clean and maintainable controller structure.
- **Error Handling**: Used `try-catch` blocks in the controller to manage exceptions that may occur during database operations. In case of an error:
  - A user-friendly response is generated.
  - Exceptions are logged for debugging in a production environment.
  - Automated email notifications are sent to the support team for critical errors.

### Focus of the Project

This project primarily focuses on implementing core features in Laravel, with less emphasis on UI/UX. I have covered a wide range of Laravel features and best practices, ensuring a solid foundation for any future development.

I believe I have addressed all essential aspects of Laravel, from routing and authentication to advanced features like relationships, pagination, and exception handling.

