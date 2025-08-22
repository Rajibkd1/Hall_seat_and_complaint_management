# Database Seeding Guide

This guide explains how to seed superadmins and admins in the Hall Seat and Complaint Management System.

## Overview

The system includes three types of seeders:

-   **SuperAdminSeeder**: Creates a single super administrator account
-   **AdminSeeder**: Creates hall administrators (Provosts, Co-Provosts, Staff, and System Admins)
-   **DatabaseSeeder**: Orchestrates all seeders

## Available Accounts

### Super Administrator

| Email                     | Password    | Role        |
| ------------------------- | ----------- | ----------- |
| superadmin@university.edu | password123 | Super Admin |

### Hall Administrators (Provosts)

| Email                              | Password     | Hall                   | Department |
| ---------------------------------- | ------------ | ---------------------- | ---------- |
| provost.shahidullah@university.edu | Provost@2024 | Shahidullah Hall       | English    |
| provost.salimullah@university.edu  | Provost@2024 | Salimullah Muslim Hall | Physics    |
| provost.fazlulhuq@university.edu   | Provost@2024 | A.F. Rahman Hall       | Chemistry  |

### Assistant Hall Administrators (Co-Provosts)

| Email                                | Password       | Hall                   | Department       |
| ------------------------------------ | -------------- | ---------------------- | ---------------- |
| coprovost.shahidullah@university.edu | CoProvost@2024 | Shahidullah Hall       | Mathematics      |
| coprovost.salimullah@university.edu  | CoProvost@2024 | Salimullah Muslim Hall | Computer Science |

### Hall Staff

| Email                            | Password   | Hall                   | Role       |
| -------------------------------- | ---------- | ---------------------- | ---------- |
| staff.shahidullah@university.edu | Staff@2024 | Shahidullah Hall       | Hall Staff |
| staff.salimullah@university.edu  | Staff@2024 | Salimullah Muslim Hall | Hall Staff |
| staff.fazlulhuq@university.edu   | Staff@2024 | A.F. Rahman Hall       | Hall Staff |

### System Administrators

| Email                | Password   | Department    |
| -------------------- | ---------- | ------------- |
| admin@university.edu | Admin@2024 | IT Department |

### Test Accounts (Legacy)

| Email                 | Password | Role            |
| --------------------- | -------- | --------------- |
| provost@example.com   | password | Test Provost    |
| coprovost@example.com | password | Test Co-Provost |
| staff@example.com     | password | Test Staff      |
| admin@example.com     | password | Test Admin      |

## How to Run Seeders

### Method 1: Run All Seeders

```bash
php artisan db:seed
```

### Method 2: Run Specific Seeders

```bash
# Run only SuperAdmin seeder
php artisan db:seed --class=SuperAdminSeeder

# Run only Admin seeder
php artisan db:seed --class=AdminSeeder

# Run both
php artisan db:seed --class=SuperAdminSeeder
php artisan db:seed --class=AdminSeeder
```

### Method 3: Fresh Migration with Seeding

```bash
# Drop all tables and re-run all migrations with seeding
php artisan migrate:fresh --seed
```

## Troubleshooting

### Common Issues

1. **"Class not found" error**

    - Run: `composer dump-autoload`

2. **"Cannot insert duplicate entry" error**

    - Clear existing data: `php artisan migrate:fresh`
    - Or truncate tables: `php artisan tinker` then `Admin::truncate()` and `SuperAdmin::truncate()`

3. **Password not working**
    - Ensure you're using the correct password from the table above
    - Check for case sensitivity

### Verification

After running seeders, verify the data:

```bash
# Check Super Admins
php artisan tinker
>>> \App\Models\SuperAdmin::all()

# Check Admins
php artisan tinker
>>> \App\Models\Admin::all()
```

## Security Notes

-   **Change default passwords** before deploying to production
-   **Use strong passwords** in production environments
-   **Consider using environment variables** for sensitive data
-   **Implement proper password policies** for real users

## Customization

To add more accounts, edit the respective seeder files:

-   `database/seeders/SuperAdminSeeder.php`
-   `database/seeders/AdminSeeder.php`

Remember to run `composer dump-autoload` after making changes to seeder files.
