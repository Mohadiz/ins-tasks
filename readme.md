# Policy Calculator

Here I will describe all required descriptions about all requested tasks.

## Installation

Both tasks one and two are coded with vanilla PHP and could be downloaded directly and run it local or online. You have access to codes directly from Github for only reviewing purposes


## Task One

You can run this task directly by passing a GET argument to the index file. Also, there is an OOP class for this task as well. Running OOP app is as same as index file. You should pass the argument to file oop.php. First simple file (index.php) is wrote by FOR loop and second one (oop.php) had been coded by FOREACH loop

```php
task1/index.php?name=Mohammad
```
```php
task1/oop.php?name=Mohammad
```

## Task Two
Download task2 folder files and run PHP for that folder. it points to index file and you can see the result as well.
The app had been coded as Object-Oriented programming. 

At your request, the program is as simple and functional as possible and has no extra framework (like laravel) or libraries used. Only Boostrap 4 and AngularJs library for UI was included to the main file.


## Task Three
First of all, you need to import the .SQL file that is in task3 folder into an MySQL database. The file will be imported without any issue. You can run this query to get each employee with their own other information in all available languages. For some fixed values like current employee status, it is better to store two number like 0 and 1 instead of yes or no. It is obvious zero stands for not active now and 1 means that employee is active.

```sql
SELECT e.*,d.language,
          d.info_data,
          d.info_type
from employees e
left join employees_data d on d.employee_id = e.id
where e.id = '1'
```

Also, there are two other tables: 'users' and 'employees_logs'. Users table that stores all app users inside and log keeps each action by each user for each employee. If you would like to list a log of actions for each employee or list all action by specific user you can run these queries. First query lists all log related to employee number #1:

```sql
SELECT l.*, e.employee_name 
from employees_logs l
left join employees e on e.id = l.employee_id 
where e.employee_id = '1'
```

Following query lists all action were done by user #1:
```sql
SELECT l.*, e.employee_name 
from employees_logs l
left join employees e on e.id = l.employee_id 
where l.user_id = '1'
```