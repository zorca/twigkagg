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

use TwigKagg\Node\FlushNode;
use TwigKagg\Token;

/**
 * Flushes the output to the client.
 *
 * @see flush()
 *
 * @final
 */
class FlushTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        return new FlushNode($token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'flush';
    }
}

class_alias('TwigKagg\TokenParser\FlushTokenParser', 'TwigKagg_TokenParser_Flush');
