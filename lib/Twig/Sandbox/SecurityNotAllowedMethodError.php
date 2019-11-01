<?php

use TwigKagg\Sandbox\SecurityNotAllowedMethodError;

class_exists('TwigKagg\Sandbox\SecurityNotAllowedMethodError');

if (\false) {
    class TwigKagg_Sandbox_SecurityNotAllowedMethodError extends SecurityNotAllowedMethodError
    {
    }
}
