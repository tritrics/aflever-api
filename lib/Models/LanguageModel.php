<?php

namespace Tritrics\Tric\v1\Models;

use Tritrics\Tric\v1\Data\Collection;
use Tritrics\Tric\v1\Helper\LanguagesHelper;

/**
 * Model for Kirby's language object
 */
class LanguageModel extends BaseModel
{
  /**
   * Get additional field data (besides type and value)
   * Method called by setModelData()
   */
  protected function getProperties(): Collection
  {
    $code = trim(strtolower($this->model->code()));

    $res = new Collection();
    $meta = $res->add('meta');
    $meta->add('code', $code);
    $meta->add('title', $this->model->name());
    $meta->add('default', $this->model->isDefault());
    $meta->add('locale', LanguagesHelper::getLocale($code));
    $meta->add('direction', $this->model->direction());
    return $res;
  }

  /**
   * Value for language (=terms) are only added in top node of request /language
   * This is the language returned in request /info.
   */
}
