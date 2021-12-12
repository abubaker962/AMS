<?php

class Employee
{
    private $empId;
    private $empName;
    private $empEmail;
    private $empSalary;
    private $deptId;
    private $empBoss;
    private $empDesignation;
    private $empProfilePic;
    private $isAdmin;
    private $empPassword;

    function __construct($data)
    {
        $this->empId = $data['emp_id'];
        $this->empName = $data['emp_name'];
        $this->empEmail = $data['emp_email'];
        $this->empSalary = $data['emp_salary'];
        $this->deptId = $data['dept_id'];
        $this->empBoss = $data['emp_boss'];
        $this->empDesignation = $data['emp_designation'];
        $this->empProfilePic = $data['emp_profile_pic'];
        $this->isAdmin = $data['is_admin'];
        $this->empPassword = $data['emp_password'];
    }

    /**
     * Get the value of empId
     */
    public function getEmpId()
    {
        return $this->empId;
    }

    /**
     * Set the value of empId
     *
     * @return  self
     */
    public function setEmpId($empId)
    {
        $this->empId = $empId;

        return $this;
    }

    /**
     * Get the value of empName
     */
    public function getEmpName()
    {
        return $this->empName;
    }

    /**
     * Set the value of empName
     *
     * @return  self
     */
    public function setEmpName($empName)
    {
        $this->empName = $empName;

        return $this;
    }

    /**
     * Get the value of empEmail
     */
    public function getempEmail()
    {
        return $this->empEmail;
    }

    /**
     * Set the value of empEmail
     *
     * @return  self
     */
    public function setempEmail($empEmail)
    {
        $this->empEmail = $empEmail;

        return $this;
    }

    /**
     * Get the value of empSalary
     */
    public function getEmpSalary()
    {
        return $this->empSalary;
    }

    /**
     * Set the value of empSalary
     *
     * @return  self
     */
    public function setEmpSalary($empSalary)
    {
        $this->empSalary = $empSalary;

        return $this;
    }

    /**
     * Get the value of deptId
     */
    public function getDeptId()
    {
        return $this->deptId;
    }

    /**
     * Set the value of deptId
     *
     * @return  self
     */
    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;

        return $this;
    }

    /**
     * Get the value of empBoss
     */
    public function getEmpBoss()
    {
        return $this->empBoss;
    }

    /**
     * Set the value of empBoss
     *
     * @return  self
     */
    public function setEmpBoss($empBoss)
    {
        $this->empBoss = $empBoss;

        return $this;
    }

    /**
     * Get the value of empDesignation
     */
    public function getEmpDesignation()
    {
        return $this->empDesignation;
    }

    /**
     * Set the value of empDesignation
     *
     * @return  self
     */
    public function setEmpDesignation($empDesignation)
    {
        $this->empDesignation = $empDesignation;

        return $this;
    }

    /**
     * Get the value of empProfilePic
     */
    public function getEmpProfilePic()
    {
        return $this->empProfilePic;
    }

    /**
     * Set the value of empProfilePic
     *
     * @return  self
     */
    public function setEmpProfilePic($empProfilePic)
    {
        $this->empProfilePic = $empProfilePic;

        return $this;
    }

    /**
     * Get the value of isAdmin
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get the value of empPassword
     */
    public function getEmpPassword()
    {
        return $this->empPassword;
    }

    /**
     * Set the value of empPassword
     *
     * @return  self
     */
    public function setEmpPassword($empPassword)
    {
        $this->empPassword = $empPassword;

        return $this;
    }
}
