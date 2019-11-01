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

use TwigKagg\Node\Expression\AssignNameExpression;
use TwigKagg\Node\ImportNode;
use TwigKagg\Token;

/**
 * Imports macros.
 *
 *   {% import 'forms.html' as forms %}
 *
 * @final
 */
class ImportTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $macro = $this->parser->getExpressionParser()->parseExpression();
        $this->parser->getStream()->expect(Token::NAME_TYPE, 'as');
        $var = new AssignNameExpression($this->parser->getStream()->expect(Token::NAME_TYPE)->getValue(), $token->getLine());
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        $this->parser->addImportedSymbol('template', $var->getAttribute('name'));

        return new ImportNode($macro, $var, $token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'import';
    }
}

class_alias('TwigKagg\TokenParser\ImportTokenParser', 'TwigKagg_TokenParser_Import');
