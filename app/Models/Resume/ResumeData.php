<?php


namespace App\Models\Resume;


class ResumeData
{
    public $name = '';
    public $second_name = '';
    public $last_name = '';
    public $phone = '';
    public $email = '';

    public function __construct($name,$second_name,$last_name,$phone,$email)
    {
        $this->name = $name;
        $this->second_name = $second_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
    }
}
