<?php namespace App\Core\V203\Requests\Activity;

/**
 * Class ActivityDate
 * @package App\Core\V201\Requests\Activity
 */
class GeoCountryRegion extends ActivityBaseRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return $this->getRulesForGeoCountryRegion($this->get('geoCountryRegion'));
    }

    /**
     * @return array
     */
    public function messages()
    {
        return $this->getMessagesForGeoCountryRegion($this->get('geoCountryRegion'));
    }

    /**
     * @param array $formFields
     * @return array
     */
    public function getRulesForGeoCountryRegion(array $formFields)
    {
        $rules = [];

        // foreach ($formFields as $activityDateIndex => $activityDate) {
        //     $activityDateForm                             = sprintf('activity_date.%s', $activityDateIndex);
        //     $rules[sprintf('%s.date_planned_start', $activityDateForm)] = 'required';
        //     $rules[sprintf('%s.type_planned_start', $activityDateForm)] = 'required';
        //     $rules[sprintf('%s.date_planned_end', $activityDateForm)] = 'required';
        //     $rules[sprintf('%s.type_planned_end', $activityDateForm)] = 'required';
        //     // $rules                                        = array_merge(
        //     //     $rules,
        //     //     $this->getRulesForNarrative($activityDate['narrative'], $activityDateForm)
        //     // );
        // }

        return $rules;
    }

    /**
     * @param array $formFields
     * @return array
     */
    public function getMessagesForGeoCountryRegion(array $formFields)
    {
        $messages = [];

        // foreach ($formFields as $activityDateIndex => $activityDate) {
        //     $activityDateForm                                         = sprintf('activity_date.%s', $activityDateIndex);
        //     $messages[sprintf('%s.date_planned_start.required', $activityDateForm)] = trans('validation.required', ['attribute' => trans('elementForm.planned_start_date')]);
        //     $messages[sprintf('%s.type_planned_start.required', $activityDateForm)] = trans('validation.required', ['attribute' => trans('elementForm.type')]);
        //     $messages[sprintf('%s.date_planned_end.required', $activityDateForm)] = trans('validation.required', ['attribute' => trans('elementForm.planned_end_date')]);
        //     $messages[sprintf('%s.type_planned_end.required', $activityDateForm)] = trans('validation.required', ['attribute' => trans('elementForm.type')]);
        //     // $messages                                                 = array_merge(
        //     //     $messages,
        //     //     $this->getMessagesForNarrative($activityDate['narrative'], $activityDateForm)
        //     // );
        // }

        return $messages;
    }
}
