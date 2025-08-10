# BCP School Registrar System  
A web-based system designed to assist the college registrar’s office in managing student records, enrollment schedules, document deficiencies, and online document requests.  
  
The system features role-based access for administrators, registrars, teachers, and students, each with dedicated tools and workflows. It streamlines administrative tasks, improves record accuracy, and allows students to process requests remotely.

## Features

- **Unified Authentication** – Single login system for administrators, registrars, teachers, and students with role-specific dashboards.
- **Student Portal** – View enrollment status, schedules, grades, and document deficiencies.
- **Document Requests** – Submit and track online requests for official documents (e.g., transcripts, certificates).
- **Registrar Portal** – Manage student records, enrollment, grades, schedules, and reports.
- **Document Deficiency Management** – Post document deficiencies with deadlines and send automatic notifications to students.
- **Teacher Portal** – Upload and import student grades with full audit trail tracking.
- **Course & Section Management** – Assign subjects, manage timetables, and oversee courses offerings.
- **Enrollment Reports** – Generate system reports for enrollment statistics by course, year level, and gender.
- **Audit Logs** – Track grade changes made by authorized users.
- **User Management** – Admin tools to manage system accounts and roles.
- **Profile Settings** – Update personal information and account credentials.

## Tech Stack

- **Front-end:** HTML5, CSS3, JavaScript, Bootstrap
- **Back-end:** PHP (Laravel framework 10.37.3)  
- **Database:** MariaDB (MySQL-compatible)
- **Tools:** XAMPP, Composer, Visual Studio Code  
- **Methodology:** Agile methodology (academic implementation)

## Screenshots

### Login Page
The system uses a unified login page for all user types (admin, registrar, teacher, student).

![Login](screenshots/login.png)

### Student Dashboard  
The student can view their course, section, and any pending or in-process document requests submitted to the registrar.

![Student Dashboard Part 1](screenshots/student-dashboard.png)
![Student Dashboard Part 2](screenshots/student-dashboard2.png)

### Student Notifications  
The student can receive notifications when their document requests are being prepared or completed, and when new document deficiencies with deadlines are posted by the registrar for submission.

![Student Notifications](screenshots/student-notif.png)

### Student Enrollment Status  
The student can view their enrollment status.

![Student Enrollment Status](screenshots/student-enrollmentstatus.png)

### Student Timetable
The student can view their timetable.

![Student Timetable](screenshots/student-timetable.png)

### Student Document Requests Hub  
The student can request official documents online and track their progress. The hub displays all pending, in-process, and completed requests, with the option to view request details.

![Student Pending Document Requests](screenshots/student-pendingreq.png)
![Student In-process Document Requests](screenshots/student-inprocessreq.png)
![Student Finished Document Requests](screenshots/student-finishedreq.png)
![Student Requested Document Details](screenshots/student-reqdetails.png)
![Student Document Request Form Part 1](screenshots/student-docreqform.png)
![Student Document Request Form Part 2](screenshots/student-docreqform2.png)
![Student Document Request Form Part 3](screenshots/student-docreqform3.png)
![Student Document Request Form Part 4](screenshots/student-docreqform4.png)

### Student Document Deficiencies  
The student can view documents they are required to submit posted by the registrar, along with their submission deadlines.

![Student Document Deficiencies List](screenshots/student-docdeficiencies.png)

### Student Settings  
The student can view and update their profile information and account settings.

![Student Profile Settings](screenshots/student-profilesettings.png)
![Student Account Settings](screenshots/student-accountsettings.png)

### Registrar Dashboard  
The registrar can view the total number of students, courses, and document requests, as well as a list of active student document requests.

![Registrar Dashboard Part 1](screenshots/registrar-dashboard.png)
![Registrar Dashboard Part 2](screenshots/registrar-dashboard2.png)

### Students List 
The registrar can view a list of students along with their basic academic information.

![Registrar Students List Part 1](screenshots/registrar-studentslist.png)
![Registrar Students List Part 2](screenshots/registrar-studentslist2.png)

### Student Profile  
The registrar can view a student's basic details, contact information, parent or guardian info, educational background, and system account details by clicking the "View" button from the student list.

![Registrar Student Profile Part 1](screenshots/registrar-studentprofile.png)
![Registrar Student Profile Part 2](screenshots/registrar-studentprofile2.png)
![Registrar Student Profile Part 3](screenshots/registrar-studentprofile3.png)

### Student Enrollment Status
The registrar can view a student's current enrollment information.

![Registrar Student Enrollment Info Part 1](screenshots/registrar-studentenrollmentstatus.png)
![Registrar Student Enrollment Info Part 2](screenshots/registrar-studentenrollmentstatus2.png)

### Student Enrollment Status – Updating  
The registrar can update a student’s current enrollment information in the system.

![Registrar Updating of Student  Enrollment Status](screenshots/registrar-studentenrollmentupdate.png)

### Student Grades  
The registrar can view a student's academic records, including grades per subject and semester.

![Registrar Student Academic Grades Part 1](screenshots/registrar-studentacademicrecords.png)  
![Registrar Student Academic Grades Part 2](screenshots/registrar-studentacademicrecords2.png)

### Student Timetable  
The registrar can view a student's timetable and print it as a Certificate of Registration (COR).

![Registrar Student Timetable](screenshots/registrar-studenttimetable.png)
![Registrar Student COR](screenshots/registrar-studentcor.png)

### Student Document Requests  
The registrar can view and manage document requests submitted by students. They can send messages during processing and view request details, including proof of payment.

![Registrar Student Pending Document Request](screenshots/registrar-studentpendingreq.png)
![Registrar Student In-Process Document Request](screenshots/registrar-studentinprocessdocreq.png)
![Registrar Student Finished Document Request](screenshots/registrar-student-finisheddocreq.png)
![Registrar Student Document Request Details](screenshots/registrar-studentreqviewdetails.png)
![Registrar Starting to Process a Student Document Request Part 1](screenshots/registrar-studentreqstartprocess.png)
![Registrar Starting to Process a Student Document Request Part 2](screenshots/registrar-studentreqstartprocess2.png)

### Student Document Deficiencies  
The registrar can post document deficiencies that students need to submit, along with their submission deadlines.

![Registrar Student Document Deficiencies](screenshots/registrar-studentdeficiencies.png)
![Registrar Student Document Deficiencies Posting](screenshots/registrar-studentdeficiencies2.png)

### Courses List  
The registrar can view existing courses and add new ones to the system.

![Registrar Courses List](screenshots/registrar-courseslist.png)
![Registrar Add Course Part 1](screenshots/registrar-addcourse.png)
![Registrar Add Course Part 2](screenshots/registrar-addcourse2.png)

### Course Information  
The registrar can view course information, including associated year levels.

![Registrar Course Information](screenshots/registrar-courseinfo.png)

### Year-Level Information  
The registrar can view subjects and sections under each year level. They can add subjects, view section timetables, and access section details including the list of enrolled students.

![Registrar Click Year-Level](screenshots/registrar-courseinfo2.png)
![Registrar Year-Level Subjects](screenshots/registrar-coursesubjects.png)
![Registrar Year-Level Sections](screenshots/registrar-coursesections.png)
![Registrar Add Subject](screenshots/registrar-addsubject.png)
![Registrar Click View Section Timetable](screenshots/registrar-sectiontimetable.png)
![Registrar View Section Timetable](screenshots/registrar-sectiontimetable2.png)
![Registrar Click Section Details](screenshots/registrar-sectiondetails.png)
![Registrar Section Details](screenshots/registrar-sectiondetails2.png)

### Student Grades List  
The registrar can view a list of student grades.

![Registrar Student Grades List Part 1](screenshots/registrar-gradeslist.png)
![Registrar Student Grades List Part 2](screenshots/registrar-gradeslist2.png)

### Enrollment Report  
The registrar can view total student enrollment for the academic year, filter by year, and see total number of students enrolled per course, year level, and gender. Reports can also be printed for documentation.

![Registrar Enrollment Report Part 1](screenshots/registrar-enrollmentreport.png)
![Registrar Enrollment Report Part 2](screenshots/registrar-enrollmentreport2.png)
![Registrar Enrollment Report Part 3](screenshots/registrar-enrollmentreport3.png)
![Registrar Enrollment Report Part 4](screenshots/registrar-enrollmentreport4.png)
![Registrar Print Enrollment Report](screenshots/registrar-printenrollmentreport.png)

### Audit Trail  
The registrar can view audit logs related to student grades for tracking changes and accountability.

![Registrar Audit Logs Part 1](screenshots/registrar-auditlogs.png)
![Registrar Audit Logs Part 2](screenshots/registrar-auditlogs2.png)

### Registrar Settings  
The registrar can view and update their profile information and account settings.

![Registrar Profile Settings](screenshots/registrar-profilesettings.png)
![Registrar Account Settings](screenshots/registrar-accountsettings.png)

### Teacher Dashboard

![Teacher Dashboard](screenshots/teacher-dashboard.png)

### Student Grades List  
The teacher can view a list of student grades, manually add grades, or import them from an Excel file.

![Teacher Student Grades List Part 1](screenshots/teacher-gradeslist.png)
![Teacher Student Grades List Part 2](screenshots/teacher-gradeslist2.png)
![Teacher Add Student Grades Part 1](screenshots/teacher-addstudentgrade.png)
![Teacher Add Student Grades Part 2](screenshots/teacher-addstudentgrade2.png)
![Teacher Add Student Grades Part 3](screenshots/teacher-addstudentgrade3.png)
![Teacher Import Student Grades Part 1](screenshots/teacher-importgrades.png)
![Teacher Import Student Grades Part 2](screenshots/teacher-importgrades2.png)
![Teacher Import Student Grades Part 3](screenshots/teacher-importgrades3.png)

### Audit Trail  
The teacher can view audit logs related to student grades for tracking changes and accountability.

![Teacher Audit Logs Part 1](screenshots/teacher-auditlogs.png)
![Teacher Audit Logs Part 2](screenshots/teacher-auditlogs2.png)

### Teacher Settings  
The teacher can view and update their profile information and account settings.

![Teacher Profile Settings](screenshots/teacher-profilesettings.png)
![Teacher Account Settings](screenshots/teacher-accountsettings.png)

### System Admin Dashboard  
The system admin can view the total number of users, including registrars, teachers, and students.

![System Admin Dashboard](screenshots/systemadmin-dashboard.png)

### User Management  
The system admin can view, add, and delete user accounts.

![System Admin Users List](screenshots/systemadmin-userslist.png)
![System Admin Add User Part 1](screenshots/systemadmin-adduseracc.png)
![System Admin Add User Part 2](screenshots/systemadmin-adduseracc2.png)
![System Admin Click View User Account](screenshots/systemadmin-viewuseracc.png)
![System Admin View User Account Part 1](screenshots/systemadmin-viewuseracc2.png)
![System Admin View User Account Part 2](screenshots/systemadmin-viewuseracc3.png)

### Audit Trail  
The system admin can view audit logs related to student grades for tracking changes and accountability.

![System Admin Audit Logs Part 1](screenshots/systemadmin-auditlogs.png)
![System Admin Audit Logs Part 2](screenshots/systemadmin-auditlogs2.png)

### System Admin Settings  
The system admin can view and update their profile information and account settings.

![System Admin Profile Settings](screenshots/systemadmin-profilesettings.png)
![System Admin Account Settings](screenshots/systemadmin-accountsettings.png)

## Getting Started (with XAMPP)
Follow the steps below to run the BCP Registrar System locally using XAMPP.

**Prerequisites**

- XAMPP (Apache & MySQL)
- Composer
- PHP 8.1 or higher

**Setup Instructions**

1. Clone the repository
```bash
git clone https://github.com/blnstrixie/registrar-system.git
```
2. Move the project folder to your `xampp/htdocs` directory.

3. Open XAMPP and start **Apache** and **MySQL**.

4. Create a new MySQL database via phpMyAdmin  
Database name:
```bash
bcp_registrar_system_db
```
5. Copy the `.env` file  
```bash
cp .env.example .env
```
6. Update .env with your database credentials  
```bash
DB_DATABASE=bcp_registrar_system_db
DB_USERNAME=root
DB_PASSWORD=
```
7. Install dependencies  
```bash
composer install
```
8. Generate application key  
```bash
php artisan key:generate
```
9. Run migrations and (optional) seeders  
```bash
php artisan migrate --seed
```
10. Serve the application  
```bash
php artisan serve
```
11. Access the system in your browser  
```bash
http://localhost:8000
```

## Demo Login Credentials
You may log in using any of the following dummy accounts to test the system's features. These accounts contain only sample data and are for **demonstration purposes** only.

- **Student**  
  - Username: `belnastrixie`  
  - Password: `Student1234`

- **Registrar** 
  - Username: `ehurangoanthony`
  - Password: `Registrar1234`

- **Teacher** 
  - Username: `dalisaycardo`
  - Password: `Teacher1234`

- **System Admin**
  - Username: `system_admin`
  - Password: `Admin1234`

## About this Project
This project was developed as part of our capstone requirement for the Bachelor of Science in Information Systems program at Bestlink College of the Philippines - San Jose Del Monte. It is intended for academic demonstration purposes only and is not yet optimized for production use.

## My Contributions
- Designed and implemented the front-end interface using HTML5, CSS3, and JavaScript.  
- Designed the database schema using MySQL Workbench, integrated it with MariaDB, and wrote SQL queries for data management.  
- Contributed to the preparation and writing of the capstone documentation.
