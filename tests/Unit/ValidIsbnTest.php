<?php

namespace Tests\Unit;

use App\Rules\ValidIsbn;
use PHPUnit\Framework\TestCase;

class ValidIsbnTest extends TestCase
{
    /**
     * @var ValidIsbn
     */
    protected $rule;

    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new ValidIsbn();
    }

    public function test_if_isbn_length_is_not_equal_to_10_validation_fails()
    {
        $invalidIsbn = '010200303030';

        $this->assertFalse($this->rule->passes('isbn', $invalidIsbn));
    }

    public function test_if_isbn_is_not_numeric_validation_fails()
    {
        $invalidIsbn = 'o005534186';

        $this->assertFalse($this->rule->passes('isbn', $invalidIsbn));
    }

    public function test_if_isbn_is_not_a_valid_isbn_format_validation_fails()
    {
        $invalidIsbn = '0005534189';

        $this->assertFalse($this->rule->passes('isbn', $invalidIsbn));
    }

    public function test_valid_isbn_validation_passes()
    {
        $validIsbn = '0005534186';

        $this->assertTrue($this->rule->passes('isbn', $validIsbn));
    }
}
