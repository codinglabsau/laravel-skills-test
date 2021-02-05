# Laravel Skills Test Kieran

## How long it took me to complete this task
I did not complete this task however I worked on it over 2 days approximately between work shifts

## What I found easy
I found working with the SQL code within the migration file easy as it is something I have done before in classes in university.
```php
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('User ID');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });
    }
```


## What I found hard
I had many issues with this test as it was my first time working with a PHP based framework.
I installed many things such as composer, Laravel, TablePlus, DBngin etc to be able to work on the test. 
Unfortunately my main issues came from connecting to the local mySQL database to be able to make migrations to the database. I followed many tutorials, read many posts on stackoverflow.com and emailed with Jerrell unfortunately I wasn't able to resolve my errors.