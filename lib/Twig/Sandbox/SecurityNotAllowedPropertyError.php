<?php

use TwigKagg\Sandbox\SecurityNotAllowedPropertyError;

class_exists('TwigKagg\Sandbox\SecurityNotAllowedPropertyError');

if (\false) {
    class TwigKagg_Sandbox_SecurityNotAllowedPropertyError extends SecurityNotAllowedPropertyError
    {
    }
}
