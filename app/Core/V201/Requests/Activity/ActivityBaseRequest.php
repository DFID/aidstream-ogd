<?php namespace App\Core\V201\Requests\Activity;

use App\Http\Requests\Request;

/**
 * Class ActivityBaseRequest
 * common validation rules and messages
 * @package App\Core\V201\Requests\Activity
 */
class ActivityBaseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * returns rules for narrative
     * @param $formFields
     * @param $formBase
     * @return array
     */
    public function addRulesForNarrative($formFields, $formBase)
    {
        $rules = [];
        foreach ($formFields as $narrativeIndex => $narrative) {
            $rules[$formBase . '.narrative.' . $narrativeIndex . '.narrative'] = 'required';
        }

        return $rules;
    }

    /**
     * returns messages for narrative
     * @param $formFields
     * @param $formBase
     * @return array
     */
    public function addMessagesForNarrative($formFields, $formBase)
    {
        $messages = [];
        foreach ($formFields as $narrativeIndex => $narrative) {
            $messages[$formBase . '.narrative.' . $narrativeIndex . '.narrative.required'] = 'Narrative text is required';
        }

        return $messages;
    }
}