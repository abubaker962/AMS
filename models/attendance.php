<?php

class Attendance
{
    private $empId;
    private $empName;
    private $empEmail;
    private $attendanceDate;
    private $timeIn;
    private $timeOut;
    private $status;

    function __construct($data)
    {
        $this->empId = $data['emp_id'];
        $this->attendanceDate = $data['attendance_date'];
        $this->timeIn = $data['time_in'];
        $this->timeOut = $data['time_out'];
        $this->empName = $data['emp_name'];
        $this->empEmail = $data['emp_email'];
        $this->status = $data['status'];
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
     * Get the value of attendanceDate
     */
    public function getAttendanceDate()
    {
        return $this->attendanceDate;
    }

    /**
     * Set the value of attendanceDate
     *
     * @return  self
     */
    public function setAttendanceDate($attendanceDate)
    {
        $this->attendanceDate = $attendanceDate;

        return $this;
    }

    /**
     * Get the value of timeIn
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * Set the value of timeIn
     *
     * @return  self
     */
    public function setTimeIn($timeIn)
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * Get the value of timeOut
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * Set the value of timeOut
     *
     * @return  self
     */
    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;

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
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
