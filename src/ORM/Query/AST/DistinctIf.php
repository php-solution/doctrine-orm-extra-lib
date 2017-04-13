<?php
namespace PhpSolution\Doctrine\ORM\Query\AST;

use Doctrine\ORM\Query\AST\ArithmeticExpression;
use Doctrine\ORM\Query\AST\ConditionalExpression;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 * DistinctIf
 */
class DistinctIf extends FunctionNode
{
    /**
     * @var ConditionalExpression
     */
    private $condition;
    /**
     * @var ArithmeticExpression
     */
    private $then;
    /**
     * @var ArithmeticExpression
     */
    private $else;

    /**
     * @return string
     */
    protected function getSqlTemplate(): string
    {
        return 'DISTINCT IF(%s, %s, %s)';
    }

    /**
     * {@inheritdoc}
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return sprintf(
            $this->getSqlTemplate(),
            $sqlWalker->walkConditionalExpression($this->condition),
            $sqlWalker->walkArithmeticPrimary($this->then),
            $sqlWalker->walkArithmeticPrimary($this->else)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->condition = $parser->ConditionalExpression();
        $parser->match(Lexer::T_COMMA);
        $this->then = $parser->ArithmeticExpression();
        $parser->match(Lexer::T_COMMA);
        $this->else = $parser->ArithmeticExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}