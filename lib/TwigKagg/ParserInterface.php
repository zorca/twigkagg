<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use TwigKagg\Error\SyntaxError;
use TwigKagg\Node\ModuleNode;
use TwigKagg\TokenStream;

/**
 * Interface implemented by parser classes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 3.0)
 */
interface TwigKagg_ParserInterface
{
    /**
     * Converts a token stream to a node tree.
     *
     * @return ModuleNode
     *
     * @throws SyntaxError When the token stream is syntactically or semantically wrong
     */
    public function parse(TokenStream $stream);
}
