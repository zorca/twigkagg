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
use TwigKagg\Node\Expression\AssignNameExpression;
use TwigKagg\Node\ImportNode;
use TwigKagg\Token;

/**
 * Imports macros.
 *
 *   {% from 'forms.html' import forms %}
 *
 * @final
 */
class FromTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $macro = $this->parser->getExpressionParser()->parseExpression();
        $stream = $this->parser->getStream();
        $stream->expect(Token::NAME_TYPE, 'import');

        $targets = [];
        do {
            $name = $stream->expect(Token::NAME_TYPE)->getValue();

            $alias = $name;
            if ($stream->nextIf('as')) {
                $alias = $stream->expect(Token::NAME_TYPE)->getValue();
            }

            $targets[$name] = $alias;

            if (!$stream->nextIf(Token::PUNCTUATION_TYPE, ',')) {
                break;
            }
        } while (true);

        $stream->expect(Token::BLOCK_END_TYPE);

        $var = new AssignNameExpression($this->parser->getVarName(), $token->getLine());
        $node = new ImportNode($macro, $var, $token->getLine(), $this->getTag());

        foreach ($targets as $name => $alias) {
            if ($this->parser->isReservedMacroName($name)) {
                throw new SyntaxError(sprintf('"%s" cannot be an imported macro as it is a reserved keyword.', $name), $token->getLine(), $stream->getSourceContext());
            }

            $this->parser->addImportedSymbol('function', $alias, 'get'.$name, $var);
        }

        return $node;
    }

    public function getTag()
    {
        return 'from';
    }
}

class_alias('TwigKagg\TokenParser\FromTokenParser', 'TwigKagg_TokenParser_From');
