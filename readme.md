# Forum App

Simple API project as a base for a forum app.

## Technologies

- Laravel
- React
- MySQL

## Requirements

- PHP 7.2+
- Composer
- MySQL
- Node 8+

## Installation

Make sure you have a database set up with valid credentials. Make a copy of
`.env.example` and name it `.env`, and fill in the values. In particular, pay
attention to `DB_*` and `APP_URL`. Note that Redis, AWS, Pusher etc. are currently
not used.

Run the following commands to get up and running:

- `composer install`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan storage:link`
- `npm install`
- `nmp run watch` (or `npm run dev` for a one-time build)

You may use `php artisan serve` as a development server.

## API

All responses are in a JSON format.

### Types

#### Comment

```json
{
    "id": 1,
    "user_id": 1,
    "text": "Duis malesuada.",
    "created_at":"2019-01-01 00:00:00",
    "updated_at":"2019-01-01 00:00:00",
    "user": {
        // User object
    }
}
```

#### Post

```json
{
    "id": 1,
    "user_id": 1,
    "text": "Non labore ea dolorum sit.",
    "created_at": "2019-01-01 00:00:00",
    "updated_at": "2019-01-01 00:00:00",
    "image_url": "http:\/\/www.example.com\/images\/image.jpeg",
    "user": {
        // User object
    },
    "comments": [
        {
            // Comment objects
        }
    ]
}
```

#### User

```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@example.org",
    "email_verified_at": "2019-01-01 00:00:00",
    "created_at": "2019-01-01 00:00:00",
    "updated_at": "2019-01-01 00:00:00"
}
```

### `GET /posts?page=1`

Gets a paginated list of posts.

Return data:

```json
{
    "current_page": 1,
    "data": [
        {
            // Post objects
        }
    ],
    "first_page_url": "http:\/\/www.example.org\/posts?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http:\/\/www.example.org\/posts?page=2",
    "next_page_url": "http:\/\/www.example.org\/posts?page=2",
    "path": "http:\/\/www.example.org\/posts",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 20
}
```

### `POST /posts`

Create a new post. Supply the following input:

- `text`: string
- `image`: optional, image file

Returns a single post object.

### `GET /posts/1`

Get a single post.

Returns a single post object.

### `DELETE /posts/1`

Delete a single post.

Return data:

```json
{
    "ok": true
}
```

If you try to delete someone else's post, false is returned.

### `POST /comments`

Create a new comment. Supply the following input:

- `post_id`: integer
- `text`: string

### `DELETE /comments/1`

Delete a single comment.

Return data:

```json
{
    "ok": true
}
```

If you try to delete someone else's comment, false is returned.
