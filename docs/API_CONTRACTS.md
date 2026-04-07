# API Contracts

All endpoints live under `/api/v1`.

Public:

- `GET /api/v1/pages/{slug}`
- `GET /api/v1/news`
- `GET /api/v1/news/{slug}`
- `GET /api/v1/partners`
- `GET /api/v1/services`
- `GET /api/v1/courses`
- `GET /api/v1/courses/{slug}`

Auth:

- `POST /api/v1/auth/login`
- `POST /api/v1/auth/logout`
- `GET /api/v1/auth/me`

Student:

- `GET /api/v1/me/courses`
- `GET /api/v1/me/lessons/{lesson}`
- `POST /api/v1/me/lessons/{lesson}/complete`

Commerce:

- `POST /api/v1/orders`
- `GET /api/v1/orders/{order}`

Responses use `data`, with `meta` and `links` for paginated collections.
