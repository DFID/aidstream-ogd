@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['description'], [])))
    <div class="activity-element-wrapper">
        <div class="title">@lang('element.description') @if(array_key_exists('Description',$errors)) <i class='imported-from-xml'>icon</i>@endif </div>
        @foreach(getVal($activityDataList, ['description'], []) as $description)
            <div class="activity-element-list">
                <div class="activity-element-label col-md-4">
                    {{$getCode->getCodeNameOnly('DescriptionType', getVal($description, ['type'], ''))}} @lang('elementForm.description')
                </div>
                <div class="activity-element-info">
                    {!! getFirstNarrative($description) !!}
                    @include('Activity.partials.viewInOtherLanguage' , ['otherLanguages' => getOtherLanguages(getVal($description, ['narrative'], [])) ])
                </div>
            </div>
        @endforeach
        <a href="{{route('activity.basic-activity-info.index', $id)}}" class="edit-element">@lang('global.edit')</a>
        @include('Activity.partials.element-delete-form', ['element' => 'description', 'id' => $id])
    </div>
@endif
