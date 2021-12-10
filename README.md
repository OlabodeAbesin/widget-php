# Simple Widget Commerce App with Vanilla php

Acme Widget Co are the leading provider of made up widgets, and they’ve contracted you to
create a proof of concept for their new sales system

Please read https://www.dropbox.com/s/dcrlgiul2dr26bm/architech-labs-code-test.pdf?dl=0 to learn more about the task.

### Prerequisites

- [PHP](https://www.php.net/downloads.php)
- [Composer](http://getcomposer.org/)
- [Postman](https://www.postman.com/downloads/) --Optional

## Getting Started

Clone this project with the following commands:

```bash
git clone https://github.com/shahbaz17/php-rest-api.git
cd php-rest-api
```
## Assumptions
- I assumed this is a small test app so I didn't connect to storage system
- As above, I implemented the system as a REST API, as against a command-line (Since Symfony framework is not allowed.

## Development

Clone the project dependencies and start the PHP server as below:

```bash
composer install
```

```bash
php -S localhost:8000 -t api
```

## Your APIs

| API                       |    CRUD    |                                Description |
| :-------------------------| :--------: | -----------------------------------------: |
| GET /widget/get-catalogue |  **READ**  |        Get a list of products              |
| GET /widget/get-rules     |  **READ**  |        Get a list of delivery charge rules |
| GET /widget/get-offers    |  **READ**  |        Get a list of available offers      |
| GET /widget/total         |  **READ** |         Returns total cost of basket + offers +rules |

Once the app is started, test the API endpoints using your browser [Postman](https://www.postman.com/).
