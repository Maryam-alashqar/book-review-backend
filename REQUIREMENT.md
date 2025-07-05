# 📘 Book Review Platform — Requirements Specification

---

## 1. Introduction

### 1.1 Project Name  
**Book Review Platform**

### 1.2 Project Goal  
To build a web-based platform that allows users to register, browse books, write and manage reviews, and interact with other users' reviews through voting and (optionally) comments.

### 1.3 Target Users  
- Regular users  
- Admin (moderator privileges)

---

## 2. Functional Requirements

| ID   | Feature              | Description                             | Role              |
|------|----------------------|-----------------------------------------|-------------------|
| FR1  | User Registration     | Register with name, email, and password | All users         |
| FR2  | User Login            | Login using email and password          | All users         |
| FR3  | Book Management       | Add, edit, delete books                 | Admin             |
| FR4  | Book Listing          | View list of books with basic info     | All users         |
| FR5  | Review Management     | Add, edit, delete personal reviews      | Registered users  |
| FR6  | View Reviews          | Display reviews for each book           | All users         |
| FR7  | Voting System         | Upvote or downvote a review             | Registered users  |
| FR8  | Commenting (optional) | Add comments to reviews                 | Registered users  |
| FR9  | Search & Filter       | Search by title, author, or category    | All users         |
| FR10 | Role-based Access     | Restrict access based on user role      | Admin/User        |

---

## 3. Non-Functional Requirements

| ID   | Requirement     | Description                                |
|------|------------------|--------------------------------------------|
| NFR1 | Security         | Password hashing, token-based auth         |
| NFR2 | Performance      | Fast and responsive API                    |
| NFR3 | Usability        | Simple and user-friendly interface         |
| NFR4 | API Documentation| Use Postman or Swagger                     |
| NFR5 | Compatibility    | Support for modern browsers                |

---

## 4. Database Schema (Initial)

### Tables Overview

- **Users**: `id`, `name`, `email`, `password`, `role`, `timestamps`
- **Books**: `id`, `title`, `author`, `category`, `description`, `created_by`, `timestamps`
- **Reviews**: `id`, `user_id`, `book_id`, `rating`, `comment`, `timestamps`
- **Votes**: `id`, `user_id`, `review_id`, `vote_type`, `timestamps`
- **Comments** (optional): `id`, `user_id`, `review_id`, `text`, `timestamps`

---

## 5. Suggested API Endpoints

| Method | Endpoint                       | Description              | Access        |
|--------|--------------------------------|--------------------------|---------------|
| POST   | `/api/register`                | Register a new user      | Public        |
| POST   | `/api/login`                   | Login and get token      | Public        |
| GET    | `/api/books`                   | Fetch all books          | Public        |
| POST   | `/api/books`                   | Add a new book           | Admin         |
| PUT    | `/api/books/{id}`              | Update book              | Admin         |
| DELETE | `/api/books/{id}`              | Delete book              | Admin         |
| GET    | `/api/books/{id}/reviews`      | Get reviews for a book   | Public        |
| POST   | `/api/books/{id}/reviews`      | Add a review             | Authenticated |
| PUT    | `/api/reviews/{id}`            | Edit own review          | Authenticated |
| DELETE | `/api/reviews/{id}`            | Delete own review        | Authenticated |
| POST   | `/api/reviews/{id}/vote`       | Vote on a review         | Authenticated |
| GET    | `/api/search?query=...`        | Search for books         | Public        |

---

## 6. User Interface Pages

- User registration and login  
- Book listing with search and filters  
- Book details with reviews and voting  
- Add/edit book form (admin only)  
- Review submission and management  
- User dashboard (for personal reviews)

---

## 7. Technologies Used

| Layer         | Technology                 |
|---------------|----------------------------|
| Backend       | Laravel 11 (API)           |
| Authentication| Laravel Sanctum / Passport |
| Frontend      | React (with ready template)|
| Database      | MySQL / SQLite             |
| API Docs      | Postman / Swagger          |
| Deployment    | GitHub, Railway / Render   |

---

## 8. Timeline (Optional Suggestion)

| Phase | Task                           | Estimated Duration |
|-------|--------------------------------|--------------------|
| 1     | Setup Laravel + DB             | 1-2 days           |
| 2     | Auth & roles                   | 1-2 days           |
| 3     | Book management                | 2-3 days           |
| 4     | Reviews & voting               | 3 days             |
| 5     | Frontend implementation        | 4-5 days           |
| 6     | Testing, polish, documentation | 2-3 days           |

---

## ✅ Notes

- This document serves as a reference for the full development cycle.
- Can be extended with user stories, wireframes, or test cases later.
