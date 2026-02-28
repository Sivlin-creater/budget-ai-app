# Expense Tracking App

A Laravel + Livewire application for managing categories, budgets, and expenses.  
Includes recurring expenses, history tracking, and email notifications. Built with Livewire components for dynamic interaction.

---

## Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Setup Instructions](#setup-instructions)
- [Environment Variables](#environment-variables)
- [Migrations & Models](#migrations--models)
- [Livewire Components](#livewire-components)
- [AI Integration](#ai-integration)
- [Running the App](#running-the-app)
- [License](#license)

---

## Features
- Manage **Categories**, **Budgets**, and **Expenses**
- Track **history of categories and budgets**
- Generate **recurring expenses** automatically
- Dashboard overview with statistics
- Email notifications using Gmail SMTP
- Fully dynamic interface using **Livewire**
- AI integration for enhanced analytics (Google Gemini)

---

## Tech Stack
- **Backend:** Laravel 10, PHP 8+
- **Frontend:** Blade, Tailwind CSS, Livewire
- **Database:** MySQL
- **Icons:** Blade Heroicons
- **AI:** Google Gemini PHP package

---
## Setup Env.
APP_NAME="ExpenseApp"
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3304
DB_DATABASE=expense_db_laravel
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=learningeverything85@gmail.com
MAIL_PASSWORD="your-app-password"
MAIL_FROM_ADDRESS="learningeverything85@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

## Setup Instructions

1. Clone the repository
```bash
git clone <your-repo-url>
cd expense-tracking-app
