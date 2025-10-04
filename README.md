cd C:\Users\HP\Desktop\forum_blog

echo "# Forum Blog Laravel Project

## Project Overview
This is a forum/blog web application built using **Laravel**, **PHP**, **HTML**, **CSS**, **Bootstrap**, and **Node.js**.  
The project allows users to create posts, comment on discussions, and view content in a forum-style layout.

## Features
- User registration and authentication
- Create, edit, and delete posts
- Comment system for discussions
- Responsive design with Bootstrap
- Database management with Laravel Eloquent

## Technologies Used
- **Backend:** Laravel, PHP  
- **Frontend:** HTML, CSS, Bootstrap, JavaScript  
- **Database:** MySQL (configured via Railway)  
- **Build tools:** Node.js, NPM for front-end assets

## Database
- Database is completed and running via **Railway**  
- All tables and migrations have been set up  
- Database connection configured in \`.env\` file

## Installation & Setup (Local)
1. Clone the repository:
    \`\`\`bash
    git clone https://github.com/HanNiKyawZin/forum_blog.git
    cd forum_blog
    \`\`\`

2. Install PHP dependencies:
    \`\`\`bash
    composer install
    \`\`\`

3. Install Node dependencies and build front-end assets:
    \`\`\`bash
    npm install
    npm run build
    \`\`\`

4. Copy \`.env.example\` to \`.env\` and configure your environment variables, including database credentials.

5. Generate application key:
    \`\`\`bash
    php artisan key:generate
    \`\`\`

6. Run database migrations:
    \`\`\`bash
    php artisan migrate
    \`\`\`

7. Serve the application locally:
    \`\`\`bash
    php artisan serve
    \`\`\`

- The application will be accessible at \`http://localhost:8000\`.

## Contribution
- Contributions are welcome via pull requests.
- Please follow Laravel conventions for code and structure.

## License
This project is open source under the MIT License." > README.md
