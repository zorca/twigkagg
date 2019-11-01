<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\TokenParser;

use TwigKagg\Error\SyntaxError;
use TwigKagg\Parser;
use TwigKagg\Token;

/**
 * Interface implemented by token parsers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface TokenParserInterface
{
    /**
     * Sets the parser associated with this token parser.
     */
    public function setParser(Parser $parser);

    /**
     * Parses a token and returns a node.
     *
     * @return \Twig_NodeInterface
     *
     * @throws SyntaxError
     */
    public function parse(Token $token);

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag();
}

class_alias('TwigKagg\TokenParser\TokenParserInterface', 'Twig_TokenParserInterface');

// Ensure that the aliased name is loaded to keep BC for classes implementing the typehint with the old aliased name.
class_exists('TwigKagg\Token');
class_exists('TwigKagg\Parser');
