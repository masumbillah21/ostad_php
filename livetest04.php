<?php
class Person {
    
    public $name;
    public $age;

    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age = $age;
    }
    
    public function introduce() {

        echo "My name is {$this->name} and I am {$this->age} years old.\n";
    }
    
}
$person = new Person("John", 30);

$person->introduce();


class Student extends Person {
    private $mark;

    public function __construct(string $name, int $age, string $mark) {
        parent::__construct($name, $age);
        $this->mark = $mark;
    }

    public function calculate_grade_percentage(): string {
        return number_format(((int) $this->mark / 100) * 100, 0) . "%";
    }

}

$student = new Student("Alice", 18, "85");

$student->introduce();

$gradePercentage = $student->calculate_grade_percentage();

echo "My grade percentage is {$gradePercentage}\n";