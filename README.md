# 🚀 SEVIMA TEST

This Project dedicate to Fulfilling Technical test for SEVIMA company Recruitment.

---

## ✨ Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### 📋 Prerequisites

Before you begin, ensure you have the following installed on your system:

* **PHP 8.2**
* **Composer 2.8.9**
* **MySQL**
* **Node 22.14.0**

### 💻 Installation

Follow these steps to set up your development environment:

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/ahsanreis/sevima_test.git
    cd sevima_test
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    npm install
    ```

3.  **Set Up Environment File:**
    * Duplicate the example environment file:
        ```bash
        cp .env.example .env
        ```
    * **Generate an application key:**
        ```bash
        php artisan key:generate
        ```
    * Edit the newly created `.env` file to configure your **Database credentials** and other settings (e.g., `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4.  **Run Database Migrations:**
    ```bash
    php artisan migrate
    ```

5.  **Serve the Application:**
    Start the local development server:
    ```bash
    php artisan serve
    npm run dev
    ```
    The application should now be accessible at `http://127.0.0.1:8000`.

---

## 🛠️ Built With

* [**Laravel**](https://laravel.com/).
* [**Composer**](https://getcomposer.org/).
* [**Tailwind CSS**](https://tailwindcss.com/)

---

## ✍️ Authors

* **[Ahsani Afif Muhammad Zaen]** - *Initial work* - ([My GitHub Profile Link](https://github.com/ahsanreis))
