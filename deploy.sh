#!/bin/bash
set -euo pipefail

echo "=== Sistema de Votación - Deploy ==="

# 1. Build image
echo "[1/7] Building Docker image..."
docker compose -f docker-compose.prod.yml build app

# 2. Start services
echo "[2/7] Starting services..."
docker compose -f docker-compose.prod.yml up -d

# 3. Wait for MySQL
echo "[3/7] Waiting for MySQL..."
sleep 10

# 4. Run migrations
echo "[4/7] Running migrations..."
docker compose -f docker-compose.prod.yml exec -T app php artisan migrate --force

# 5. Seed roles
echo "[5/7] Seeding roles..."
docker compose -f docker-compose.prod.yml exec -T app php artisan db:seed --class=RolesSeeder --force

# 6. Storage link
echo "[6/7] Creating storage link..."
docker compose -f docker-compose.prod.yml exec -T app php artisan storage:link

# 7. Clear caches
echo "[7/7] Caching configuration..."
docker compose -f docker-compose.prod.yml exec -T app php artisan config:cache
docker compose -f docker-compose.prod.yml exec -T app php artisan route:cache
docker compose -f docker-compose.prod.yml exec -T app php artisan view:cache

echo "=== Deploy complete ==="
echo "App: http://localhost:8080"
echo "Admin: http://localhost:8080/admin"
