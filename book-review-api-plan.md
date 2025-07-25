
# 📘 Book Review Platform – Backend API Plan

## Phase 1: Basic Setup
1. Initialize Laravel project 
2. Setup `.env` and database connection
3. Create Migrations:
   - `users` (already exists)
   - `books`
   - `reviews`
   - `comments` 
   - `likes` or `votes`

---

## Phase 2: Models & Relationships
- Create Models:
  - `Book`
  - `Review`
  - `Comment` 
  - `User`
- Relationships:
  - User has many Reviews & Comments
  - Book has many Reviews & Comments
  - Review belongs to Book and User
  - Comment belongs to Review and User

---

## Phase 3: API Routes (`routes/api.php`)
- `GET /books`
- `GET /books/{id}`
- `POST /books` *(Admin only)*
- `GET /books/{id}/reviews`
- `POST /books/{id}/reviews`
- `PUT /reviews/{id}`
- `DELETE /reviews/{id}`
- `POST /reviews/{id}/comments` 
- `POST /reviews/{id}/like`

---

## Phase 4: Controllers
- `BookController`
  - `index()`
  - `store()`
  - `show()`
- `ReviewController`
  - `store()`
  - `update()`
  - `destroy()`
- `CommentController` 
- `LikeController` 

---

## Phase 5: Authentication (Sanctum)
- `POST /register`
- `POST /login`
- `POST /logout`
- Protect routes using `auth:sanctum` middleware

---

## Phase 6: Authorization
- Admin role check for Book creation
- Authenticated users for creating/editing/deleting reviews & comments
- Use `Policy` or manual checks for ownership

---

## Phase 7: API Documentation (optional)
- Use Postman Collection or Swagger to document all endpoints

---

## Phase 8: Frontend Integration
