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

use TwigKagg\Node\BlockNode;
use TwigKagg\Node\Expression\BlockReferenceExpression;
use TwigKagg\Node\Expression\ConstantExpression;
use TwigKagg\Node\PrintNode;
use TwigKagg\Token;

/**
 * Filters a section of a template by applying filters.
 *
 *   {% filter upper %}
 *      This text becomes uppercase
 *   {% endfilter %}
 *
 * @final
 */
class FilterTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $name = $this->parser->getVarName();
        $ref = new BlockReferenceExpression(new ConstantExpression($name, $token->getLine()), null, $token->getLine(), $this->getTag());

        $filter = $this->parser->getExpressionParser()->parseFilterExpressionRaw($ref, $this->getTag());
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse([$this, 'decideBlockEnd'], true);
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        $block = new BlockNode($name, $body, $token->getLine());
        $this->parser->setBlock($name, $block);

        return new PrintNode($filter, $token->getLine(), $this->getTag());
    }

    public function decideBlockEnd(Token $token)
    {
        return $token->test('endfilter');
    }

    public function getTag()
    {
        return 'filter';
    }
}

class_alias('TwigKagg\TokenParser\FilterTokenParser', 'TwigKagg_TokenParser_Filter');
