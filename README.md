
# doc RESTful Api

cara menggunakan Api



## API Reference

#### Get jwt login

```http
  GET /api/login

```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**.  |
| `password`      | `string` | **Required**.  |

#### Get jwt login

generate acces token manual menggunakan authorize oauth 2.0 post man

```http
  GET /api/login/google/callback


```


#### Get jwt register

```http
  GET /api/register

```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**.  |
| `email`      | `string` | **Required**.  |
| `password`      | `string` | **Required**.  |
| `password_confirmation`      | `string` | **Required**.  |

#### view categories
```http
  GET /api/categories

```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `authorize JWT Token`      | `string` | **Required**.  |

#### add categories
##### wajib mengisi  jwt token di authorize di setiap request 

```http
  POST /api/categories

```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**.  |


 

#### add products
```http
  GET /api/products

```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `authorize JWT Token`      | `string` | **Required**.  |


## API Reference

#### Get jwt login

```http
  GET /api/login

```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**.  |
| `password`      | `string` | **Required**.  |

#### Get jwt register

```http
  GET /api/register

```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**.  |
| `email`      | `string` | **Required**.  |
| `password`      | `string` | **Required**.  |
| `password_confirmation`      | `string` | **Required**.  |


