<?php

class ValidationService {
    public static function validateUserInput($data) {
        if (!isset($data['names'], $data['lastnames'])) {
            return "Both 'names' and 'lastnames' are required";
        }

        if (strlen($data['names']) < 2 || strlen($data['lastnames']) < 2) {
            return "Names and lastnames must be at least 2 characters long";
        }

        return null;
    }
}
