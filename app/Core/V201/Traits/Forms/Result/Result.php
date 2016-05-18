<?php namespace App\Core\V201\Traits\Forms\Result;

use App\Core\V201\Forms\Activity\Result as ResultForm;

/**
 * Class Result
 * @package App\Core\V201\Forms\Activity
 */
trait Result
{

    /**
     * Return result form
     * @return ResultForm
     */
    public function addResults()
    {
        return $this->addCollection('result', 'Activity\Result', 'result');
    }

    /**
     * Return type field
     * @return ResultForm
     */
    public function addTypeList()
    {
        return $this->addSelect('type', $this->getCodeList('ResultType', 'Activity'), null, $this->addHelpText('Activity_Result-type'), null, true);
    }

    /**
     * Return aggregation status field
     * @return ResultForm
     */
    public function addAggregationStatusList()
    {
        return $this->addSelect('aggregation_status', [0 => 'False', 1 => 'True'], 'Aggregation Status', $this->addHelpText('Activity_Result-aggregation_status'));
    }
}
