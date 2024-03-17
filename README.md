# Setup Application

   ```bash
   git clone <repository-url>
   cd <project directory>
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   ```

Do not forget to create database and update the credentials in .env

# API Endpoints

This document outlines the API endpoints available in the project, along with their corresponding routes and
functionality.

## Authentication

### Login

- **Route**: `POST /login`
- **Description**: Endpoint to authenticate users and generate access tokens.
- **Parameters**:
    - `email` (string): User's email address.
    - `password` (string): User's password.
- **Returns**:
    - `token` (string): Bearer token for authenticated user.

## Teacher

### Get Student List

- **Route**: `GET /student-list`
- **Description**: Endpoint to retrieve the list of students.
- **Authorization**: Bearer token required. Example: `Bearer 1|0twZLtzHSZZ84ToGZ3RviopxJwOwVPof7AkxNgMV02c915dc`
- **Returns**: List of student objects.

### Update Student Score

- **Route**: `PUT /student-list/student/{studentId}/activity/{activityId}`
- **Description**: Endpoint to update student score to selected activity.
- **Authorization**: Bearer token required. Example: `Bearer 1|0twZLtzHSZZ84ToGZ3RviopxJwOwVPof7AkxNgMV02c915dc`
- **Sample Payload**:
```json
{
  "score": 85
}
```
- **Returns**: Updated student activity objects.

## Student

### Get Activity List

- **Route**: `GET /activity-list`
- **Description**: Endpoint to retrieve the list of activities.
- **Authorization**: Bearer token required. Example: `3|CENLL5d01KqL057PIB1uljBBLrkU8QxgazqFjFOw74072ccf`
- **Returns**: List of activity objects.

## Admin

### Manage Activities

#### List Activities

- **Route**: `GET /activities`
- **Description**: Endpoint to retrieve a list of activities.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: List of activity objects.

#### Create Activity

- **Route**: `POST /activities`
- **Description**: Endpoint to create a new activity.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**:
  ```json
  {
    "name": "Sample Activity",
    "subject_id": "2",
    "max_score": 100
  }
- **Returns**: Newly created activity object.

#### Update Activity

- **Route**: `PUT /activities/{id}`
- **Description**: Endpoint to update an existing activity.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**:
  ```json
  {
    "name": "Sample Activity",
    "subject_id": "2",
    "max_score": 100
  }
- **Returns**: Updated activity object.

#### Delete Activity

- **Route**: `DELETE /activities/{id}`
- **Description**: Endpoint to delete an activity.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: HTTP Code 204.

### Manage Subjects

#### List Subjects

- **Route**: `GET /subjects`
- **Description**: Endpoint to retrieve a list of subjects.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: List of subject objects.

#### Create Subject

- **Route**: `POST /subjects`
- **Description**: Endpoint to create a new subject.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**:
  ```json
  {
    "name": "Mathematics",
    "code": "M234"
  }
- **Returns**: Newly created subject object.

#### Update Subject

- **Route**: `PUT /subjects/{id}`
- **Description**: Endpoint to update an existing subject.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**:
  ```json
  {
    "name": "Mathematics",
    "code": "M123"
  }
- **Returns**: Updated subject object.

#### Delete Subject

- **Route**: `DELETE /subjects/{id}`
- **Description**: Endpoint to delete a subject.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: HTTP Code 204.
-

### Manage Classes

#### List Classes

- **Route**: `GET /classes`
- **Description**: Endpoint to retrieve a list of classes.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: List of class objects.

#### Create Class

- **Route**: `POST /classes`
- **Description**: Endpoint to create a new class.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**:
  ```json
  {
    "name": "Maths",
    "teacher_id":"2"
  }
- **Returns**: Newly created class object.

#### Update Class

- **Route**: `PUT /classes/{id}`
- **Description**: Endpoint to update an existing subject.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**:
  ```json
  {
    "name": "Science",
    "teacher_id": "2"
  }
- **Returns**: Updated class object.

#### Delete Class

- **Route**: `DELETE /classes/{id}`
- **Description**: Endpoint to delete a class.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: HTTP Code 204.

### Manage Teachers

#### List Teachers

- **Route**: `GET /teachers`
- **Description**: Endpoint to retrieve a list of teachers.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: List of teacher objects.

#### Create Teacher

- **Route**: `POST /teachers`
- **Description**: Endpoint to create a new teacher.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**:
```json
{
    "name": "Teacher name",
    "email": "teacher@mail.com",
    "password": "mypassword",
    "class_ids": [
        1,
        2
    ],
    "street1": "9555",
    "street2": "Black Mountain Rd",
    "city": "San Diego",
    "postl_code": "92126",
    "country_code": 12,
    "phone_number": "(858) 536-1200"
}
```
- **Returns**: Newly created teacher object.

#### Update Teacher

- **Route**: `PUT /teachers/{id}`
- **Description**: Endpoint to update an existing subject.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**: Similar to create teacher payload
- **Returns**: Updated class object.

#### Delete Teacher

- **Route**: `DELETE /teachers/{id}`
- **Description**: Endpoint to delete a class.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: HTTP Code 204.

### Manage Students

#### List Students

- **Route**: `GET /students`
- **Description**: Endpoint to retrieve a list of students.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: List of student objects.

#### Create Student

- **Route**: `POST /students`
- **Description**: Endpoint to create a new student.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**:
```json
{
    "employee_id": "EMP123",
    "name": "Student name",
    "email": "teacher@mail.com",
    "password": "mypassword",
    "class_id": "1",
    "street1": "9555",
    "street2": "Black Mountain Rd",
    "city": "San Diego",
    "postl_code": "92126",
    "country_code": 12,
    "phone_number": "(858) 536-1200",
    "activity_ids": [
        1,
        2
    ]
}
```
- **Returns**: Newly created student object.

#### Update Student

- **Route**: `PUT /student/{id}`
- **Description**: Endpoint to update an existing subject.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload**: Similar to create student payload
- **Returns**: Updated student object.

#### Delete Student

- **Route**: `DELETE /student/{id}`
- **Description**: Endpoint to delete a student.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: HTTP Code 204.

### List Countries

- **Route**: `GET /countries`
- **Description**: Endpoint to retrieve a list of countries.
- **Returns**: List of country objects.

### Profile

#### Get Profile

- **Route**: `GET /profile/`
- **Description**: Endpoint to authenticated profile details.
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Returns**: Authenticated profile details.

#### Update Profile

- **Route**: `PUT /profile`
- **Description**: Endpoint to update the authenticated user's profile. Payload may change as per the user role
- **Authorization**: Bearer token required. Example: `Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725`
- **Sample Payload For Teachers**:

```json
{
    "name": "Teacher name",
    "email": "teacher@mail.com",
    "password": "mypassword",
    "class_ids": [
        1,
        2
    ],
    "street1": "9555",
    "street2": "Black Mountain Rd",
    "city": "San Diego",
    "postl_code": "92126",
    "country_code": 12,
    "phone_number": "(858) 536-1200"
}
```
- **Returns**: Updated profile details.

## Note

Ensure to include appropriate authorization headers as specified for each endpoint.
