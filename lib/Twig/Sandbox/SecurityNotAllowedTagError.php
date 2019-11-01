<?php

use TwigKagg\Sandbox\SecurityNotAllowedTagError;

class_exists('TwigKagg\Sandbox\SecurityNotAllowedTagError');

if (\false) {
    class TwigKagg_Sandbox_SecurityNotAllowedTagError extends SecurityNotAllowedTagError
    {
    }
}
