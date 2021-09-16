# basic-api

This is a basic API for User and Post Contain CRUD, Role & Permission

first run seeder php artisan db:seed for post data and role/permission

LOGIN & REGISTER
- first step register users by this request
{url}/api/register
required field : - 
1) name
2) email
3) password
4) role = super-admin, admin, user
5) permission = All Access, Monitor, view only

- second login registered user
{url}/api/register
required field : - 
1) email
2) password

after login u will get a token from json response please copy this in order to access Post and update User endpoint

example token:-
10|FAJp8LcBo1DzyceLV2SShuHMlgo9xysiNzaGAUVO

USER & POST (CRUD) 

TOKEN REQUIRED FOR HEADER!!
{url}/api/posts
{url}/api/posts/{id}
{url}/api/user/
{url}/api/user/{id}



