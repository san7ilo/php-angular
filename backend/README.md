# 📡 PHP REST API - Gestión de Usuarios + Imágenes

Este proyecto es una API RESTful creada en PHP puro, sin frameworks, siguiendo buenas prácticas y estructura modular. Permite realizar operaciones CRUD sobre usuarios y subir imágenes de perfil.

---

## 🚀 Requisitos

- Docker
- Docker Compose

---

## 🐳 Levantar el entorno

```bash
docker-compose up -d
```

- API: http://localhost:8000
- phpMyAdmin: http://localhost:8080 (usuario: root / contraseña: root)

---

## 🛠️ Migración de la base de datos

Visita en el navegador:

```
http://localhost:8000/../config/migration.php
```

Esto creará la tabla `users`.

---

## 🔌 Endpoints disponibles

### ✅ Crear usuario
`POST /users`
```json
{
  "names": "Lucas",
  "lastnames": "Martinez"
}
```

---

### 📥 Subir imagen de perfil
`POST /users/{id}/upload`

- Tipo: **multipart/form-data**
- Campo: `image` (archivo .jpg o .png)

---

### 🔍 Obtener todos los usuarios
`GET /users`

---

### 📄 Obtener un usuario por ID
`GET /users/{id}`

---

### ✏️ Actualizar un usuario
`PUT /users/{id}`
```json
{
  "names": "Luciano",
  "lastnames": "Martinez"
}
```

---

### ❌ Eliminar un usuario
`DELETE /users/{id}`

---

## 🖼️ Acceso a imágenes
Las imágenes se almacenan en `/uploads/`. Puedes mostrarlas así:

```html
<img src="http://localhost:8000/uploads/filename.jpg" />
```

---

## 📂 Estructura del backend

```
backend/
├── public/               # index.php (entrypoint)
├── config/               # DB + migration
├── src/
│   ├── Controllers/
│   ├── Models/
│   ├── Routes/
│   └── Services/
├── uploads/              # Imágenes subidas
└── README.md
```

---
