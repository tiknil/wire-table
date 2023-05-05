<?php

namespace WireTable\Data;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Str;
use Illuminate\View\View;

class Column
{
    private function __construct(
        public string $label,
        public string $key,
        public bool $sort,
        public string $cellView,
        public array|ElementStyle|null $thStyle,
        public array|ElementStyle|null $tdStyle,
        public string|null $dateFormat,
        public Closure|null $map,
        public bool $isRaw = false,
    ) {
        if (empty($this->key)) {
            $this->key = Str::slug($this->label);
        }

        if (is_array($this->thStyle)) {
            $this->thStyle = ElementStyle::fromArray($this->thStyle);
        }

        if (is_array($this->tdStyle)) {
            $this->tdStyle = ElementStyle::fromArray($this->tdStyle);
        }
    }

    /**
     * Creates a new column definition for the table
     *
     * @param  string  $label  Column label, rendered as the column th
     * @param  string  $key  Column identifier, by default considered the data field name for sorting & displaying
     * @param  bool  $sort  True when the table can be sorted by this column. Requires WithSorting trait
     * @param  string  $cellView  View for cell rendering
     * @param  array|ElementStyle|null  $thStyle  Styling for th element
     * @param  array|ElementStyle|null  $tdStyle  Styling for td element
     * @param  string|null  $dateFormat  Carbon date format
     * @param  Closure|null  $map  Map the row data to the cell contents
     * @param  bool  $isRaw  Dangerous. True if data contains some html that should not be escaped.
     * Not required when using a custom view
     * @return static
     */
    public static function create(
        string $label,
        string $key = '',
        bool $sort = false,
        string $cellView = '',
        array|ElementStyle|null $thStyle = null,
        array|ElementStyle|null $tdStyle = null,
        string|null $dateFormat = null,
        Closure|null $map = null,
        bool $isRaw = false
    ): self {
        return new self(
            label: $label,
            key: $key,
            sort: $sort,
            cellView: $cellView,
            thStyle: $thStyle,
            tdStyle: $tdStyle,
            dateFormat: $dateFormat,
            map: $map,
            isRaw: $isRaw
        );
    }

    /**
     * Renders the cell content based on the column definition
     */
    public function render(mixed $item): string|View
    {
        if (!empty($this->cellView)) {
            return view($this->cellView)->with(['item' => $item]);
        }

        if ($this->map !== null) {
            return $this->map->__invoke($item);
        }

        $cellContent = $item->{$this->key};

        if ($cellContent instanceof Carbon) {
            $cellContent = $cellContent->translatedFormat($this->dateFormat ?: config('wire-table.date-format'));
        }

        return $cellContent ?? '';
    }
}
