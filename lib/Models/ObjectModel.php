<?php

namespace Tritrics\Ahoi\v1\Models;

use Kirby\Content\Field;
use Tritrics\Ahoi\v1\Data\FieldsModel;
use Tritrics\Ahoi\v1\Data\Collection;

/**
 * Model for Kirby's fields: object
 */
class ObjectModel extends FieldsModel
{
  /**
   */
  public function __construct(
    Field $model,
    Collection $blueprint,
    string $lang = null,
    array $addFields = [],
    bool $addDetails = false
  ) {
    if (!is_array($addFields) || count($addFields) === 0) {
      $addFields = ['*'];
    }
    parent::__construct($model, $blueprint, $lang, $addFields, $addDetails);
    $this->setData();
  }

  /**
   * Set model data.
   */
  private function setData(): void
  {
    $this->add('type', 'object');

    // fields
    if ($this->fields->count() > 0) {
      $this->add('fields', $this->fields);
    }
  }
}