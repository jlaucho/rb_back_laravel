---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_9a457884b2c8843eea3675b8fdf41caa -->
## api/v1/datos/{id}
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/datos/{id}" 
```

```javascript
const url = new URL("http://localhost/api/v1/datos/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "ok": "true",
    "empresas": []
}
```

### HTTP Request
`GET api/v1/datos/{id}`


<!-- END_9a457884b2c8843eea3675b8fdf41caa -->

<!-- START_2be1f0e022faf424f18f30275e61416e -->
## Get a JWT via given credentials.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/auth/login" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/auth/login`


<!-- END_2be1f0e022faf424f18f30275e61416e -->

<!-- START_a68ff660ea3d08198e527df659b17963 -->
## Log the user out (Invalidate the token).

> Example request:

```bash
curl -X POST "http://localhost/api/v1/auth/logout" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/auth/logout`


<!-- END_a68ff660ea3d08198e527df659b17963 -->

<!-- START_1c1379ad98c1e4337433460cbb47992e -->
## Refresh a token.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/auth/refresh" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/refresh");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/auth/refresh`


<!-- END_1c1379ad98c1e4337433460cbb47992e -->

<!-- START_eb57393f9f64e9b9f402a183215a05a6 -->
## Get the authenticated User.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/auth/me" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/me");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/auth/me`


<!-- END_eb57393f9f64e9b9f402a183215a05a6 -->

<!-- START_02d045549b2678d1fc27a32573e1b9df -->
## Store the User

> Example request:

```bash
curl -X POST "http://localhost/api/v1/user/store" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/store");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/user/store`


<!-- END_02d045549b2678d1fc27a32573e1b9df -->

<!-- START_12bdabaa7f7cbd5077f2d1473245f11e -->
## GET method, show user from database

> Example request:

```bash
curl -X POST "http://localhost/api/v1/user/reactivar" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/reactivar");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/user/reactivar`


<!-- END_12bdabaa7f7cbd5077f2d1473245f11e -->

<!-- START_ac83781672cc17e20bf4939810c0fc43 -->
## List the Users

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/user/userRegister" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/userRegister");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/user/userRegister`


<!-- END_ac83781672cc17e20bf4939810c0fc43 -->

<!-- START_68b363d77446f008c161c9eb8608ab4a -->
## api/v1/user/conductores
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/user/conductores" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/conductores");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/user/conductores`


<!-- END_68b363d77446f008c161c9eb8608ab4a -->

<!-- START_3194735f9797f63cde19ccf6db65615f -->
## api/v1/user/usuarios
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/user/usuarios" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/usuarios");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/user/usuarios`


<!-- END_3194735f9797f63cde19ccf6db65615f -->

<!-- START_197891a439d44556498edd4a3c21a1fe -->
## List the Users

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/user/{parametro}/{palabra?}" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/{parametro}/{palabra?}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/user/{parametro}/{palabra?}`


<!-- END_197891a439d44556498edd4a3c21a1fe -->

<!-- START_ad3b44e69f2f97d33193276f45379b9f -->
## PUT method, update User for id

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/user/{id}" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`PUT api/v1/user/{id}`


<!-- END_ad3b44e69f2f97d33193276f45379b9f -->

<!-- START_f23e23e5a9b1d819cf366191ee8973b7 -->
## DELETE method, delete user from database

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/user/{id}" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE api/v1/user/{id}`


<!-- END_f23e23e5a9b1d819cf366191ee8973b7 -->

<!-- START_dd3d5501615121fcb8ef0f5ced2a1ecd -->
## GET method, show user from database

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/user/{id}" 
```

```javascript
const url = new URL("http://localhost/api/v1/user/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/user/{id}`


<!-- END_dd3d5501615121fcb8ef0f5ced2a1ecd -->

<!-- START_90c45b7d79eebb708e8ab6471b6b9671 -->
## api/v1/buscar/{collection}/{id?}
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/buscar/{collection}/{id?}" 
```

```javascript
const url = new URL("http://localhost/api/v1/buscar/{collection}/{id?}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/buscar/{collection}/{id?}`


<!-- END_90c45b7d79eebb708e8ab6471b6b9671 -->

<!-- START_1a99e10e110965635130679525c67f79 -->
## Store the Empresa

> Example request:

```bash
curl -X POST "http://localhost/api/v1/empresa/store" 
```

```javascript
const url = new URL("http://localhost/api/v1/empresa/store");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/empresa/store`


<!-- END_1a99e10e110965635130679525c67f79 -->

<!-- START_dfc86740698cd712493e789d74c0f340 -->
## List the Empresas

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/empresa" 
```

```javascript
const url = new URL("http://localhost/api/v1/empresa");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/empresa`


<!-- END_dfc86740698cd712493e789d74c0f340 -->

<!-- START_2d0caef62421b720047022daebfedaac -->
## PUT method, update Empresa for id

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/empresa/{id}" 
```

```javascript
const url = new URL("http://localhost/api/v1/empresa/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`PUT api/v1/empresa/{id}`


<!-- END_2d0caef62421b720047022daebfedaac -->

<!-- START_40a021526c624dba4257dcd305e18104 -->
## DELETE method, delete user from database

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/empresa/{id}" 
```

```javascript
const url = new URL("http://localhost/api/v1/empresa/{id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE api/v1/empresa/{id}`


<!-- END_40a021526c624dba4257dcd305e18104 -->

<!-- START_7510ced3f6ba66f82233fc02392eef64 -->
## Store the CorreosEnviados

> Example request:

```bash
curl -X POST "http://localhost/api/v1/servicio/store" 
```

```javascript
const url = new URL("http://localhost/api/v1/servicio/store");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/servicio/store`


<!-- END_7510ced3f6ba66f82233fc02392eef64 -->

<!-- START_c177f6dc925197d096ba2634c0c97c78 -->
## List the Correos

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/servicio/{option?}" 
```

```javascript
const url = new URL("http://localhost/api/v1/servicio/{option?}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/servicio/{option?}`


<!-- END_c177f6dc925197d096ba2634c0c97c78 -->

<!-- START_c0d75959e6a3fefa977aec9f16c46ea3 -->
## Store the Factura

> Example request:

```bash
curl -X POST "http://localhost/api/v1/factura/store" 
```

```javascript
const url = new URL("http://localhost/api/v1/factura/store");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/factura/store`


<!-- END_c0d75959e6a3fefa977aec9f16c46ea3 -->

<!-- START_81f53c18be1362b95544f2a3316fdfba -->
## api/v1/tabulador
> Example request:

```bash
curl -X POST "http://localhost/api/v1/tabulador" 
```

```javascript
const url = new URL("http://localhost/api/v1/tabulador");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST api/v1/tabulador`


<!-- END_81f53c18be1362b95544f2a3316fdfba -->

<!-- START_52ccd6b1be287e6a7b5478866dd6b98b -->
## api/v1/tabulador
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/tabulador" 
```

```javascript
const url = new URL("http://localhost/api/v1/tabulador");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/tabulador`


<!-- END_52ccd6b1be287e6a7b5478866dd6b98b -->

<!-- START_7642a1808ec490ec35df45d510057ae3 -->
## api/v1/validators/emailtaken/{email}
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/validators/emailtaken/{email}" 
```

```javascript
const url = new URL("http://localhost/api/v1/validators/emailtaken/{email}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/validators/emailtaken/{email}`


<!-- END_7642a1808ec490ec35df45d510057ae3 -->

<!-- START_ef8cfc1b85b864ea9ce089a2e85682a9 -->
## api/v1/validators/empresaexiste/{campo}/{valor}
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/validators/empresaexiste/{campo}/{valor}" 
```

```javascript
const url = new URL("http://localhost/api/v1/validators/empresaexiste/{campo}/{valor}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (401):

```json
{
    "ok": false,
    "error": {
        "token": "Problemas de autenticacion"
    }
}
```

### HTTP Request
`GET api/v1/validators/empresaexiste/{campo}/{valor}`


<!-- END_ef8cfc1b85b864ea9ce089a2e85682a9 -->

<!-- START_f720664e2bbb422f4e71f344b5886e8a -->
## api/v1/practica
> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/practica" 
```

```javascript
const url = new URL("http://localhost/api/v1/practica");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "ok": true,
    "resp": []
}
```

### HTTP Request
`GET api/v1/practica`


<!-- END_f720664e2bbb422f4e71f344b5886e8a -->


