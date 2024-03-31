## ENUM in PHP
1. define an enum first in [RoleType](./app/Enums/RoleType.php). define your enum values inside this file.

2. add a migration to add this columns inside the users table. [migration_to_add_enum](./database/migrations/2024_03_31_215901_add_role_field_to_users.php)

3. add an accessor in [User.php](./app/models/User.php) model to alter role interger into name i.e 
    * 1 => ADMIN
    * 2 => USER
