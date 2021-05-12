<?php

class Valid
{
    private $name;
    private $nickname;
    private $email;
    private $text;
    private $hashtag;
    private $data;

    public function __construct($value)
    {
        $this->name = $value['name'];
        $this->nickname = $value['nickname'];
        $this->email = $value['email'];
        $this->text = $value['text'];
        $this->hashtag = $value['hashtag'];
        $this->data = $value;
    }

    public function validation()
    {
        if ($this->name == '') {
            throw new Exception('Enter your name!');
        } else {
            $reg = "/^[^0-9 ]+$/i";
            if (preg_match_all($reg, $this->name) == false) {
                throw new Exception('Pleace delete space!');
            }
        }
        if ($this->nickname == '') {
            throw new Exception('Enter your nickname');
        } else {
            $reg = "/^[^0-9 ]+$/i";
            if (preg_match_all($reg, $this->nickname) == false) {
                throw new Exception('Pleace delete space!');
            }
        }
        if ($this->email == '') {
            throw new Exception('Enter your email!');
        } else {
            $regeemail ="/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i";
            if (preg_match_all($regeemail, $this->email) == false) {
                throw new Exception('Email entered incorrectly!');
            }
        }
        if ($this->text == '') {
            throw new Exception('Enter your text comment!');
        }
        if ($this->hashtag == '') {
            throw new Exception('Enter your hashtag!');
        } else {
            $reg = "/#\b.*[a-z]+.*\b/i";
            if (preg_match_all($reg, $this->hashtag)== false) {
                throw new Exception('Enter "#"!');
            } else {
                $regexp = "/^[^0-9 ]+$/i";
                if (preg_match_all($regexp, $this->hashtag) == false) {
                    throw new Exception('Pleace delete space!');
                }
            }
        }
    }
}
