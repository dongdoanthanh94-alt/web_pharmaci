# PharmaCare Pharmacy Management

This workspace contains the existing MediCare dashboard and the requested separated application layout:

- `pharma-backend/` — Java 25 (LTS), Spring Boot 3.5, PostgreSQL, Flyway, Redis configuration, Spring Security and JWT.
- `pharma-frontend/` — PHP frontend configuration, session-backed API client, public entry points, shared templates and Tailwind build setup.
- `assets/` and `index.php` — existing dashboard kept in place for backwards compatibility.

## Backend

Requirements: JDK 25 (LTS), Maven 3.9+, PostgreSQL, and Redis.

Create a PostgreSQL database and set environment variables before running:

```powershell
$env:DATABASE_URL = "jdbc:postgresql://localhost:5432/pharmacare"
$env:DATABASE_USERNAME = "pharmacare"
$env:DATABASE_PASSWORD = "<your-local-database-password>"
$env:JWT_SECRET = "<base64-encoded-random-secret-of-at-least-32-bytes>"
```

Generate a local JWT signing secret with:

```powershell
 $bytes = [byte[]]::new(32)
 [Security.Cryptography.RandomNumberGenerator]::Fill($bytes)
 [Convert]::ToBase64String($bytes)
```

Then start the API from `pharma-backend/`:

```powershell
mvn spring-boot:run
```

Flyway creates the initial schema on startup. Swagger UI is available at `/swagger-ui.html`.

Implemented API examples:

- `GET /api/medicines/barcode/{barcode}` and `POST /api/medicines/barcode/scan`
- `GET /api/inventory/batches` (FEFO ordered)
- `GET /api/inventory/medicines/{medicineId}/batches`
- `POST /api/inventory/receipts`
- `POST /api/pos/orders` (creates the order, allocates batches FEFO, and decrements inventory in one transaction)

The JWT bearer filter validates signed access tokens. Demo catalog rows are inserted by Flyway and are for local development only. OTP delivery, refresh-token persistence, account lookup, payment-provider settlement, prescription object storage, and reminder notifications need provider-specific configuration and are not represented as working integrations yet. The POS checkout needs an authenticated PHARMACIST or ADMIN JWT. Do not deploy this starter until those flows, authorization policies and operational secrets are configured.

## PHP frontend

Use `pharma-frontend/public` as the PHP document root. Configure `BACKEND_API_URL` to the Spring API URL. PHP cURL is required by `config/api_client.php`; that helper attaches a JWT stored in the server-side session. The sample dashboard does not yet include a login flow to populate that session.

Tailwind assets can be built from `pharma-frontend/`:

```powershell
Set-Location .\pharma-frontend
npm install
npm run build:css
```

For the separated PHP frontend, start the server from the project root:

```powershell
php -S localhost:8000 -t .\pharma-frontend\public
```

The existing styled MediCare dashboard remains available from the workspace root with:

```powershell
php -S localhost:8000 -t .
```

The new public entry points keep navigation URLs available. The operational dashboard still uses sample data until its screens are switched to authenticated API-backed rendering.
