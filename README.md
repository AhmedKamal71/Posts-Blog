# Laravel Blog Application

This is a simple blog application built with Laravel for the backend and Bootstrap for frontend styling. It allows users to create, read, update, and delete posts, as well as manage comments associated with each post. It includes authentication and user authorization features.

## Features

- **User Authentication**: Users can register, login, and manage their accounts.
- **Post Management**: Users can create, edit, delete, and view posts.
- **Comments**: Each post can have multiple comments, and users can add, edit, or delete comments.
- **Pagination**: Posts are paginated for better navigation.
- **Authorization**: Only the post owner or admin can edit or delete posts.

## Technologies Used

- **Laravel**: Backend framework.
- **MySQL**: Database management.
- **Bootstrap**: Frontend framework.
- **jQuery**: For client-side interactivity (used for forms and confirmation modals).
- **SweetAlert2**: For user-friendly confirmation dialogs.

## Setup

### Prerequisites

Make sure you have the following installed:

- PHP >= 8.x
- Composer
- MySQL or another database
- Node.js and NPM (for frontend build)

### Installation

1. Clone the repository:

    ```bash
    https://github.com/AhmedKamal71/Posts-Blog.git
    cd Posts-Blog
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env` and configure your database settings:

    ```bash
    cp .env.example .env
    ```

    Then, set your database credentials in the `.env` file.

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Run the database migrations:

    ```bash
    php artisan migrate
    ```

6. Install JavaScript dependencies:

    ```bash
    npm install
    ```

7. Build the frontend assets:

    ```bash
    npm run dev
    ```

8. Seed the database with sample data (optional):

    ```bash
    php artisan db:seed
    ```

9. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

   The application should now be running at `http://localhost:8000`.

## Usage

1. **Authentication**: 
   - Register an account to access the full features.
   - Use the login page to authenticate.

2. **Post Management**:
   - Navigate to the **Posts** section where you can create, view, edit, and delete posts.
   - Each post has an associated **Comments** section where users can leave comments.
   - Only admin can controll all posts -> admin@gmail.com
   - Only admin and post's owner can edit and delete the post
   - Only admin and post's owner can edit and delete the comment

3. **Admin Access**:
   - Admin users can manage all posts and comments.

## Screenshots

### Home Page

![Home Page](https://via.placeholder.com/800x400?text=Home+Page+Image)

### Post Creation Page

![Post Creation](https://via.placeholder.com/800x400?text=Post+Creation+Page)

### Post Details Page

![Post Details](https://via.placeholder.com/800x400?text=Post+Details+Page)

### Comment Section

![Comment Section](https://via.placeholder.com/800x400?text=Comment+Section)


