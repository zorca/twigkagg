<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\TokenParser;

use TwigKagg\Error\SyntaxError;
use TwigKagg\Node\Node;
use TwigKagg\Token;

/**
 * Extends a template by another one.
 *
 *  {% extends "base.html" %}
 *
 * @final
 */
class ExtendsTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $stream = $this->parser->getStream();

        if ($this->parser->peekBlockStack()) {
            throw new SyntaxError('Cannot use "extend" in a block.', $token->getLine(), $stream->getSourceContext());
        } elseif (!$this->parser->isMainScope()) {
            throw new SyntaxError('Cannot use "extend" in a macro.', $token->getLine(), $stream->getSourceContext());
        }

        if (null !== $this->parser->getParent()) {
            throw new SyntaxError('Multiple extends tags are forbidden.', $token->getLine(), $stream->getSourceContext());
        }
        $this->parser->setParent($this->parser->getExpressionParser()->parseExpression());

        $stream->expect(Token::BLOCK_END_TYPE);

        return new Node();
    }

    public function getTag()
    {
        return 'extends';
    }
}

class_alias('TwigKagg\TokenParser\ExtendsTokenParser', 'Twig_TokenParser_Extends');
