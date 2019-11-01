<?php

use TwigKagg\Sandbox\SecurityNotAllowedFunctionError;

class_exists('TwigKagg\Sandbox\SecurityNotAllowedFunctionError');

if (\false) {
    class TwigKagg_Sandbox_SecurityNotAllowedFunctionError extends SecurityNotAllowedFunctionError
    {
    }
}
