# TeamLiquid Test

## Usage
To make it run correctly a small setup is needed.

First of all duplicated the `.env.example` file and call the new file `.env`.
Here it is possible to add DB configs.

Second, the following commands must be run:
- `composer install`
- `npm install`
- `npm run build`

## Docker
I added some docker images that I used during the development process.
They are **NOT** safe for production environments (eg. php errors are not disabled).

## TODOS
- logger
- remove show error from php.ini, log unhandled exceptions to apache error.log
