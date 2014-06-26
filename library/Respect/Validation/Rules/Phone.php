<?php
namespace Respect\Validation\Rules;

class Phone extends AbstractRule
{
    public function validate($input)
    {
        $countryCode = '[+]?([\d]{0,3})?';
        $separator = '\.\-\s';
        $space = "[${separator}]?";
        $openSeparator = "[\(${separator}]";
        $endSeparator = "[\)${separator}]";

        $_99_99_99_99 = "([\d]{2}${space}){4}"; // Allows: 99-99-99-99 or 99999999
        $_9999 = "([\d]{4})"; // Allows: 9999
        $phoneSufix = "${_9999}|${_99_99_99_99}";

        $countryAndAreaCode = "${countryCode}${openSeparator}?([\d]{1,3})${endSeparator}";
        $phonePrefix = "(\d{3,5})";
        $phone = "(${phonePrefix}${space}${phoneSufix})";

        return !empty($input) && preg_match("/^${countryAndAreaCode}*${phone}$/", $input);
    }
}
