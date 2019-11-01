<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Arnaud Le Blanc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use TwigKagg\TokenParser\TokenParserInterface;

/**
 * Interface implemented by token parser brokers.
 *
 * Token parser brokers allows to implement custom logic in the process of resolving a token parser for a given tag name.
 *
 * @author Arnaud Le Blanc <arnaud.lb@gmail.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
interface TwigKagg_TokenParserBrokerInterface
{
    /**
     * Gets a TokenParser suitable for a tag.
     *
     * @param string $tag A tag name
     *
     * @return TokenParserInterface|null A TwigKagg_TokenParserInterface or null if no suitable TokenParser was found
     */
    public function getTokenParser($tag);

    /**
     * Calls TwigKagg\TokenParser\TokenParserInterface::setParser on all parsers the implementation knows of.
     */
    public function setParser(TwigKagg_ParserInterface $parser);

    /**
     * Gets the TwigKagg_ParserInterface.
     *
     * @return TwigKagg_ParserInterface|null A TwigKagg_ParserInterface instance or null
     */
    public function getParser();
}
