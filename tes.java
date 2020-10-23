class Employee {
    Department department;

    public Employee(final Department department) {
        this.department = department;
    }

    public Department getDepartment() {
       return department;
    }
}

class Department{
    Employee manager;

    public Department(final Employee manager) {
        this.manager = manager;
    }

    Employee getManager() {
        return manager;
    }
}

class Sample {
    Employee john;
    Employee johnsManager = john.getDepartment().getManager();
}



class Employee {
    Department department;

    public Employee(final Department department) {
        this.department = department;
    }

    public Department getDepartment() {
       return department;
    }

    Employee getManager() {
        return manager;
    }
}

class Department{
    Employee manager;

    public Department(final Employee manager) {
        this.manager = manager;
    }

    Employee getManager() {
        return manager;
    }
}

class Sample {
    Employee john;
    Employee johnsManager = john.getDepartment().getManager();
}