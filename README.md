- tech:
  - brezee
  - spatie multitenant
  - unit test (pest)
  - migate : php artisan migrate --path=database/migrations/landlord
  - migrate tenant : php artisan tenants:artisan "migrate --database=tenant"

- fitur:
  - Auth
    Role :
    - 0. User Biasa (hanya bisa melihat-lihat).
    - 1. Pencipta Lagu (Composer).
    - 2. Cover Creator.
    - 3. Artis Resmi (Official Artist).
    - 4. Admin.
    - 5. Super Admin.
