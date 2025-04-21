 Once you clone this repository**
 Do the following commands to make this application works
 
 Step1:- cd your-laravel-project
 
 Step2:- composer install
 
 Step3:- cp .env.example .env
 
 Step4:- php artisan key:generate
 
 Step5:- Setup your database if you don't want sqllite
 
 Step6:- php artisan migrate --seed

 Step7:- npm install

 Step8:- npm run dev

 Step9:- php artisan storage:link
 
 Step10:- php artisan serve
 
 For Login on web and getting token on API use below credentials
  
  1)Login API
    POST Url = {baseUrl}.api/login
  {
     'email' => 'test@example.com'
	 'password' => 'password'
  }
    Response : - 
  {
    "status": "success",
    "message": "token_created",
    "data": {
        "token": "2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81"
    },
    "errors": null
  }

  We can add column token expires_at too like Laravel passport has
  
  2) Logout token user
     POST Url = {baseUrl}.api/logout
	 Header = Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81
	 
	 Response :- 	 
	 {
		"status": "success",
		"message": "logged_out",
		"data": null,
		"errors": null
	 }
  
  3) Get all Authors with pagination
     GET Url = {baseUrl}.api/authors`
	 Header = Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81
	 
	 Response :- 	 
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
            },
	 }
	 }
  
  4) Get Author by Author Id
     GET Url = {baseUrl}.api/authors/$id`
	 Header = Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81
	 
	 Response :- 	 
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
	
  5) Create Author 
     POST Url = {baseUrl}.api/authors`
	 Header = Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81
	 
	 Request :- 
	 
	  {
            'name' => ['required', 'string','max:45'],
            'email' => ['required', 'email', 'unique:authors'],
            'bio' => ['nullable', 'string', 'max:1000']
        };
	 
	 
	 Response :- 	 
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
  
  6) Update Author 
     PUT Url = {baseUrl}.api/authors/$id
	 Header = Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81
	 
	 Request :- 
	 
	  {
            'name' => ['nullable', 'string', 'max:45', 'required_without_all:email,bio'],
            'email' => ['nullable', 'email', 'unique:authors,email,' . $this->route('author'), 'required_without_all:name,bio'],
            'bio' => ['nullable', 'string', 'max:1000', 'required_without_all:name,email']
        };
	 
	 
	 Response :- 	 
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

   7) Delete Author 
     Delete Url = {baseUrl}.api/authors/$id
	 Header = Authorization: Bearer 2|AyD5V03VRLjUW1Z9F5BmNpQwehHtW81fzA4XtIG12cbeee81
	 
	 
	 
	 Response :- 	 
	 {
    "status": "success",
    "message": "author_deleted",
    "data": [],
    "errors": null
    }
	
	The follwing topics and features, I have covered in this application
	Blade starter kit Installed
	Relational table created using foreign key
	Default data and test data added using seeders and factories
	Relationalship hasMany and belongsTo added on Author and blogpost model
	Softdelete added for blog post
	Image upload added for blog post
	Scope filter added for published and unpublished posts
	Pagination added for all records of author and blogpost
	CRUD APis added for author
	Token based logged in added
	
	Model wise Formrequest and policy has been created for handling validation and authorazation.
 Services has been created for handling logic and db operation so our controller would be clean.
 On controller using try catch block to handle operation because service can throw exception while doing db operation
 so if error occurs we genenerate user-friendly response to the user
 and we also store exception on log for handling debug in production and we can even shoot mail to support team as well.
 
 This project mainly focus on features not much on UI. I guess I cover every aspects of Laravel
