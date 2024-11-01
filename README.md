# slim-mvc-example without database

This project demonstrates a simple implementation of the MVC (Model-View-Controller) pattern using the Slim framework. Instead of a traditional database, it uses a JSON file (`users.json`) to manage user data.

## Project Structure

1. **index.php**  
   This file connects the autoloader and initializes the application by including `bootstrap.php`.

2. **bootstrap.php**  
   Here, we set up dependencies and define application routes.

3. **Model - /Models/User.php**  
   The `User` model represents the structure of a single user and may contain basic methods for data manipulation in conjunction with `UserService`.

4. **Service - src/Services/UserService.php**  
   The `UserService` handles operations related to `users.json`, including CRUD (Create, Read, Update, Delete) functionalities by reading and writing user data.

5. **Controller - src/Controllers/UserController.php**  
   The `UserController` processes incoming requests and invokes methods from `UserService` to interact with user data.

## CRUD Operations via CURL Requests on Port 8080

1. **Get all users (GET /users)**  
   Retrieves a list of all users.
   ```bash
   curl -X GET http://localhost:8080/users
    ```
2. **Get a single user by ID (GET /users/{id})**
Retrieves a user by their ID.
```bash
 curl -X GET http://localhost:8080/users/1
```
3. **Create a new user (POST /users)**
   Adds a new user to the list.
```bash
curl -X POST http://localhost:8080/users -H "Content-Type: application/json" -d '{"name": "John Doe", "email": "john@example.com"}'
```
4. **Update user data by ID (PUT /users/{id})**
   Modifies the data of an existing user.
```bash
curl -X PUT http://localhost:8080/users/1 -H "Content-Type: application/json" -d '{"name": "John Smith", "email": "johnsmith@example.com"}'
```
5. **Delete a user by ID (DELETE /users/{id})**
   Removes a user from the list.
```bash
curl -X DELETE http://localhost:8080/users/1
```

### Changes Made