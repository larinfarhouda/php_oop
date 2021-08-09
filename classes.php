<?php
abstract class person
{

    private $name;
    private $age;


    public function __construct($name, $age)
    {
        $this->setName($name);
        $this->setAge($age);
    }

    #setters------------
    function setName($name)
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            header("Location: index.php?error=invalidname");
            exit();
        } else {
            $this->name = $name;
        }
    }

    function setAge($age)
    {
        if ($age > 0 && $age < 100) {
            $this->age = $age;
        } else {
            header("Location: index.php?error=invalidage");
            exit();
        }
    }

    #getters----------
    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    abstract public function printINFO();
} //end of person class--------------------------------------------------------------------

class Doctor extends Person
{

    private $officeFee;
    private $specialty;

    public function __construct($name, $age, $officeFee, $specialty)
    {
        parent::__construct($name, $age);
        $this->setofficeFee($officeFee);
        $this->setspecialty($specialty);
    }

    #setters------------
    function setspecialty($specialty)
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $specialty)) {
            header("Location: newdoctor.php?error=invalidspecialty");
            exit();
        } else {
            $this->specialty = $specialty;
        }
    }

    function setofficeFee($officeFee)
    {
        if ($officeFee >= 0) {
            $this->officeFee = $officeFee;
        } else {
            header("Location: newdoctor.php?error=invalidofficeFee");
            exit();
        }
    }

    #getters----------
    public function getofficeFee()
    {
        return $this->officeFee;
    }

    public function getspecialty()
    {
        return $this->specialty;
    }
    #print info ----------
    public function printINFO()
    {
        print "<strong> Dr.</strong>" . $this->getName() . "<strong> Specialty: </strong>" . $this->getspecialty();
    }
} //end of doctor class ------------------------------------------------------

class Patient extends Person
{

    private $ssn; // social security number

    public function __construct($name, $age, $ssn)
    {
        parent::__construct($name, $age);
        $this->ssn = $ssn;
    }

    #setters------------
    function setssn($ssn)
    {
        $this->ssn = $ssn;
    }

    #getters----------
    public function getssn()
    {
        return $this->ssn;
    }

    #print info ----------
    public function printINFO()
    {
        print "<strong> patient : </strong>" . $this->getName() . "<strong> Ssn : </strong>" . $this->getssn();
    }
} //end of patient class ------------------------------------------------------

class Billing
{

    private $Doctor;
    private $Patient;
    private $date;
    private $billingAmount;


    public function __construct(Doctor $Doctor, Patient $Patient, $date)
    {
        $this->Doctor = $Doctor;
        $this->Patient = $Patient;
        $this->date = $date;
        $this->billingAmount = $Doctor->getOfficeFee();
    }


    #setters------------
    function setDoctor($Doctor)
    {
        $this->Doctor = $Doctor;
    }

    function setPatient($Patient)
    {
        $this->Patient = $Patient;
    }

    function setdate($date)
    {
        $this->date = $date;
    }

    function setBillingAmount($billingAmount)
    {
        $this->billingAmount = $billingAmount;
    }

    #getters----------
    function getDoctor()
    {
        return $this->Doctor;
    }

    function getPatient()
    {
        return $this->Patient;
    }

    function getdate()
    {
        return $this->date;
    }

    function getBillingAmount()
    {
        return $this->billingAmount;
    }

    #print info ----------
    public function billINFO()
    {
        print "<strong> doc : </strong>" . $this->getDoctor()->getName() . "<strong> pat : </strong>" . $this->getPatient()->getName() . "<strong> price : </strong>" . $this->getBillingAmount() . "<strong> date : </strong>" . $this->getdate();
    }
} //end of billing class ------------------------------------------------------
