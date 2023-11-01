# Live Test 05

1.Create a class called 'Person' with the following attributes and methods:

 

Attributes:

- name (string)

- age (integer)

 

Methods:

- __construct(name (string), age (integer)): Initialize the 'name' and 'age' attributes with the given values.

- introduce(): Print a message introducing the person with their name and age.

 

Template: (This is a template, so implement the things as directed above.)

<?php

class Person {

// attributes

public $name;

public $age;

 

// constructor

public function __construct($name, $age) {

     

}

 

// method

public function introduce() {

     

}

}

 

Example:

$person = new Person("John", 30);

$person->introduce();

 

Expected Output:

My name is John and I am 30 years old.




2. Create a child class called 'Student' that extends the 'Person' class. The 'Student' class should have an additional attribute called 'mark' (string) and an additional method called 'calculate_grade_percentage()' that returns the mark percentage (string). Assume that the mark is out of 100.

 

Template: (This is a template, so implement the things as directed above.)

<?php

class Student extends Person {

// attribute

    

// constructor

    

// method

    

// method override )

    

// additional method

public function calculate_grade_percentage() {

     // Assume that the mark is out of 100

     // Implement your logic to calculate the mark percentage here

     

}

 

    

}

Example:

$student = new Student("Alice", 18, “85”);

$student->introduce();

$gradePercentage = $student->calculate_grade_percentage();

echo "My grade percentage is {$gradePercentage}\n";

 

Expected Output:

My name is Alice, I am 18 years old.

My grade percentage is 85%.