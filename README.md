# Установка

### Server
```bash
docker-compose build
docker-compose up -d
```

### NCANode
```bash
docker volume create ncanode_cache
docker run -p 14579:14579 -v ncanode_cache:/app/cache -d malikzh/ncanode
```
