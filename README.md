# TeamLiquid Test

## Notes
- I use the csv ID to see if the row already exists in db and do a upsert.
- In CSV if the ID is 0 then the row will be inserted as new
- env production will disable printing of the trace on errors
- I stripped html tags from CSVs since it was a mess to parse them with htmlspecialchars without a string delimiter
- I commited csv files in storage dir so you could see which files I used for testing

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

## TODOS
- post data validators
- template error bag
- add logger formatters to format log messages
