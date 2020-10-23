class Employee {
	public Department WorkDepartment{ get; private set; }
}

class Department{
	public string ChargeCode { get; private set; }
	public Employee Manager { get; private set; }
}

class Test{
	void Test(){
		var john = new Employee();
		var johnsManager = john.WorkDepartment.Manager;
	}
}




class Employee {
	private Department WorkDepartment{ get; private set; }
	public Employee Manager{ 
		get { return WorkDepartment.Manager; }
	}
}

class Department{
	public string ChargeCode { get; private set; }
	public Employee Manager { get; private set; }
}

class Test{
	void Test(){
		var john = new Employee();
		var johnsManager = john.Manager;
	}
}



public class BankAccount {
	public int AccountAge {get; private set;}
	public int CreditScore {get; private set;}
	public AccountInterest AccountInterest {get; private set;}
	public BankAccount(int accountAge, int creditScore, AccountInterest accountInterest){
		AccountAge = accountAge;
		CreditScore = creditScore;
		AccountInterest = accountInterest;
	}
	public double CalculateInterestRate(){
		if(CreditScore > 800) return 0.02;
		if(AccountAge > 10) return 0.03;
		return 0.05;
	}
}

public class AccountInterest{
	public BankAccount Account {get; private set;}
	public AccountInterest(BankAccount bankAccount){
		Account = bankAccount;
	}
	public double Interesetrate{
		get {return Account.CalculateInterestRate();}
	}
	public bool IntroductoryRate{
		get {return Account.CalculateInterestRate() < 0.05;}
	}
}



public class BankAccount {
	public int AccountAge {get; private set;}
	public int CreditScore {get; private set;}
	public AccountInterest AccountInterest {get; private set;}
	public BankAccount(int accountAge, int creditScore, AccountInterest accountInterest){
		AccountAge = accountAge;
		CreditScore = creditScore;
		AccountInterest = accountInterest;
	}
}

public class AccountInterest{
	public BankAccount Account {get; private set;}
	public AccountInterest(BankAccount bankAccount){
		Account = bankAccount;
	}
	public double Interesetrate{
		get {return CalculateInterestRate();}
	}
	public bool IntroductoryRate{
		get {return CalculateInterestRate() < 0.05;}
	}
	public double CalculateInterestRate(){
		if(Account.CreditScore > 800) return 0.02;
		if(Account.AccountAge > 10) return 0.03;
		return 0.05;
	}
}