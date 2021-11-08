## Laravel API Starter Kit
Here is a list of the packages installed:

- [Laravel Passport](https://laravel.com/docs/8.x/passport)
- [Laravel Socialite](https://laravel.com/docs/8.x/socialite)
- [Laravel Fractal](https://github.com/spatie/laravel-fractal)
- [Laravel Permission](https://github.com/spatie/laravel-permission)
- [Intervention Image](http://image.intervention.io/)

## Installation

To install the project you can use composer

```bash
composer create-project joselfonseca/laravel-api new-api
```

Modify the .env file to suit your needs

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

When you have the .env with your database connection set up you can run your migrations

```bash
php artisan migrate
```
Then run `php artisan passport:install`

Run `php artisan db:seed` and you should have a new user with the roles and permissions set up

## Tests

Navigate to the project root and run `vendor/bin/phpunit` after installing all the composer dependencies and after the .env file was created.

## API documentation
The project uses API blueprint as API spec and [Aglio](https://github.com/danielgtaylor/aglio) to render the API docs, please install aglio and [merge-apib](https://github.com/ValeriaVG/merge-apib) in your machine and then you can run the following command to compile and render the API docs 
```bash
composer api-docs
```
## API Response codes:
    We will follow the standard HTTP status code registry (https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml)
- ### 200 OK
    The request succeeded. The result meaning of "success" depends on the HTTP method:
        GET: The resource has been fetched and transmitted in the message body.
        HEAD: The representation headers are included in the response without any message body.
        PUT or POST: The resource describing the result of the action is transmitted in the message body.
        TRACE: The message body contains the request message as received by the server.

- ### 201 Created
    The request succeeded, and a new resource created as a result. This is typically the response sent after POST requests, or some PUT requests.

- ### 202 Accepted
    The request has been received but not yet acted upon. It is noncommittal, since there is no way in HTTP to later send an asynchronous response indicating the outcome of the request. It is intended for cases where another process or server handles the request, or for batch processing.

- ### 204 No Content
    There is no content to send for this request, but the headers may be useful. The user agent may update its cached headers for this resource with the new ones.

- ### 400 Bad Request
    The server could not understand the request due to invalid syntax.

- ### 401 Unauthorized
    Although the HTTP standard specifies "unauthorized", semantically this response means "unauthenticated". That is, the client must authenticate itself to get the requested response.

- ### 403 Forbidden
    The client does not have access rights to the content; that is, it is unauthorized, so the server is refusing to give the requested resource. Unlike 401 Unauthorized, the client's identity is known to the server.

- ### 404 Not Found
    The server can not find the requested resource. In the browser, this means the URL is not recognized. In an API, this can also mean that the endpoint is valid but the resource itself does not exist. Servers may also send this response instead of 403 Forbidden to hide the existence of a resource from an unauthorized client. This response code is probably the most well known due to its frequent occurrence on the web.

- ### 405 Method Not Allowed
    The request method is known by the server but is not supported by the target resource. For example, an API may not allow calling DELETE to remove a resource.

- ### 406 Not Acceptable
    This response is sent when the web server, after performing server-driven content negotiation, doesn't find any content that conforms to the criteria given by the user agent.

- ### 411 Length Required
    Server rejected the request because the Content-Length header field is not defined and the server requires it.

- ### 412 Precondition Failed
    The client has indicated preconditions in its headers which the server does not meet.

- ### 413 Payload Too Large
    Request entity is larger than limits defined by server. The server might close the connection or return an Retry-After header field.

- ### 414 URI Too Long
    The URI requested by the client is longer than the server is willing to interpret.

- ### 415 Unsupported Media Type
    The media format of the requested data is not supported by the server, so the server is rejecting the request.

- ### 416 Range Not Satisfiable
    The range specified by the Range header field in the request cannot be fulfilled. It's possible that the range is outside the size of the target URI's data.

- ### 417 Expectation Failed
    This response code means the expectation indicated by the Expect request header field cannot be met by the server.

- ### 422 Unprocessable Entity (WebDAV)
    The request was well-formed but was unable to be followed due to semantic errors.

- ### 429 Too Many Requests
    The user has sent too many requests in a given amount of time ("rate limiting").

- ### 500 Internal Server Error
    The server has encountered a situation it does not know how to handle.

- ### 502 Bad Gateway
    This error response means that the server, while working as a gateway to get a response needed to handle the request, got an invalid response.

- ### 503 Service Unavailable
    The server is not ready to handle the request. Common causes are a server that is down for maintenance or that is overloaded. Note that together with this response, a user-friendly page explaining the problem should be sent. This response should be used for temporary conditions and the Retry-After HTTP header should, if possible, contain the estimated time before the recovery of the service. The webmaster must also take care about the caching-related headers that are sent along with this response, as these temporary condition responses should usually not be cached.

- ### 504 Gateway Timeout
    This error response is given when the server is acting as a gateway and cannot get a response in time.

- ### 505 HTTP Version Not Supported
    The HTTP version used in the request is not supported by the server.

## License

The Laravel API Starter kit is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
