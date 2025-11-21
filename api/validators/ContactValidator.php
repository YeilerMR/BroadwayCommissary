<?php

namespace Api\Validators;

class ContactValidator
{
    /**
     * Validate contact form data
     */
    public static function validate(array $data): array
    {
        $errors = [];
        
        // Validate name
        if (empty($data['name'] ?? '')) {
            $errors['name'] = 'The name is required';
        } elseif (strlen($data['name']) < 2) {
            $errors['name'] = 'The name must be at least 2 characters long';
        } elseif (strlen($data['name']) > 100) {
            $errors['name'] = 'The name cannot exceed 100 characters';
        }
        
        // Validate email
        $emailValidation = EmailValidator::validate($data['email'] ?? '');
        if (!$emailValidation['valid']) {
            $errors['email'] = $emailValidation['message'];
        }
        
        // Validate phone
        if (empty($data['phone'] ?? '')) {
            $errors['phone'] = 'Telephone is required';
        } elseif (!preg_match('/^[\d\-\s\+\(\)]+$/', $data['phone'])) {
            $errors['phone'] = 'The phone number format is invalid.';
        } elseif (strlen($data['phone']) < 7) {
            $errors['phone'] = 'The phone number must have at least 7 characters.';
        }
        
        // Validate subject
        if (empty($data['subject'] ?? '')) {
            $errors['subject'] = 'The subject is required';
        } elseif (strlen($data['subject']) < 3) {
            $errors['subject'] = 'The subject line must be at least 3 characters long';
        } elseif (strlen($data['subject']) > 100) {
            $errors['subject'] = 'The subject line cannot exceed 100 characters.';
        }
        
        // Validate message
        if (empty($data['message'] ?? '')) {
            $errors['message'] = 'The message is required';
        } elseif (strlen($data['message']) < 10) {
            $errors['message'] = 'The message must be at least 10 characters long';
        } elseif (strlen($data['message']) > 5000) {
            $errors['message'] = 'The message cannot exceed 5000 characters';
        }
        
        return [
            'valid' => count($errors) === 0,
            'errors' => $errors
        ];
    }
}
