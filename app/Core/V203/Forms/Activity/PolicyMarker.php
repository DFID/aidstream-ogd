<?php namespace App\Core\V203\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class PolicyMarker
 * @package App\Core\V202\Forms\Activity
 */
class PolicyMarker extends BaseForm
{

    public function buildForm()
    {
        $this
            ->addSelect('significance_1', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_1'),null,0)
            ->addSelect('significance_2', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_2'),null,0)
            ->addSelect('significance_3', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_3'),null,0)
            ->addSelect('significance_4', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_4'),null,0)
            ->addSelect('significance_5', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_5'),null,0)
            ->addSelect('significance_6', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_6'),null,0)
            ->addSelect('significance_7', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_7'),null,0)
            ->addSelect('significance_8', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_8'),null,0)
            ->addSelect('significance_9', $this->getCodeList('PolicySignificance', 'Activity'), trans('elementForm.significance_9'),null,0)
            ;
    }
}
