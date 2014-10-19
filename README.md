### About
Rested Cats is a very simple Rest API for
finding, adding, creating, updating and deleting cats.

I've used two libraries to build this.

For simple routing:
https://github.com/Respect/Rest

And for some simple database abstraction:
https://github.com/lichtner/fluentpdo

### Installing

Clone project
```
git clone https://github.com/sebek/RestedCats.git
```

In project root, run composer
```
composer install
```

And also in project root, run the database create and seed script
```
php database/create_and_seed.php
```

### Running
Use the built in server
```
php -S localhost:8000 public/index.php
```

### Usage

There's just one resource, /cats/, and it supports GET/POST/PUT/DELETE

**Use JSON-encoded parameters for POST and PUT**

*Form-encoded is not supported*

#### Finding cats

##### All
```
curl -i -H "Content-Type: application/json" http://localhost:8000/cats/
```

##### By id
```
curl -i -H "Content-Type: application/json" http://localhost:8000/cats/:id
```

##### By name
```
curl -i -H "Content-Type: application/json" http://localhost:8000/cats/:name/byName
```

### Adding cats
```
curl -i -H "Content-Type: application/json" -d '{"name":"The Unsinkable Sam","age":"10","color":"red"}' -X POST http://localhost:8000/cats
```

### Updating cats
```
curl -i -H "Content-Type: application/json" -d '{"name":"The Sinkable Sam","age":"10","color":"blue"}' -X PUT http://localhost:8000/cats/:id
```

### Deleting cats
```
curl -i -H "Content-Type: application/json" -X DELETE http://localhost:8000/cats/:id
```


