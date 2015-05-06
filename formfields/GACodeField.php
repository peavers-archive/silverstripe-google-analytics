<?php

/**
 * Class GACodeField
 */
class GACodeField extends TextField
{
    /**
     * @return string
     */
    public function Type()
    {
        return 'text';
    }

    /**
     * @param $validator
     * @return bool
     */
    public function validate($validator)
    {

        $parts = explode("-", $this->value);

        if ($parts[0] === "GTM" && mb_strlen($parts[1]) === 6) {
            return true;

        } else if (($parts[0] === "UA") && mb_strlen($parts[1]) === 8 && mb_strlen($parts[2]) === 1) {
            return true;

        } else {
            $validator->validationError($this->name, "<strong>ERROR:</strong> Isn't a valid Universal or Tag Manager code. Must be in either <strong>UA-XXXXXXXX-X</strong> or
            <strong>GTM-XXXXXX</strong> format.", "validation", false);
        }

        return false;
    }
}
