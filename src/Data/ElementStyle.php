<?php

namespace WireTable\Data;

class ElementStyle
{
    public array $classList;

    public string $style;

    private function __construct(string|array $classList, string|array $style)
    {
        $this->classList = is_array($classList)
            ? $classList
            : explode(' ', $classList);

        $this->style = is_array($style)
            ? implode(
                ' ',
                array_map(
                    fn ($key, $val) => "$key: $val;",
                    array_keys($style),
                    $style
                )
            )
            : $style;
    }

    /**
     * @param  string|array  $classList class names for the element. raw string or array of strings
     * @param  string|array  $style custom styling for the element. raw string or dictionary
     * @return static
     */
    public static function create(string|array $classList = '', string|array $style = ''): self
    {
        return new self(classList: $classList, style: $style);
    }

    public static function fromArray(array $data): self
    {
        return new self(classList: $data['classList'] ?? '', style: $data['style'] ?? '');
    }
}
