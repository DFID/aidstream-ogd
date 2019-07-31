@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['activity_date'], [])))
    <div class="activity-element-wrapper">
        <div class="title">@lang('element.activity_date') @if(array_key_exists('Activity Date',$errors)) <i class='imported-from-xml'>icon</i>@endif </div>
        @foreach(groupActivityElements(getVal($activityDataList, ['activity_date'], []) , 'type') as $key => $groupedDates)
            <div class="activity-element-list">
                <div class="activity-element-label col-md-4">
                    {{ $getCode->getCodeNameOnly('ActivityDateType', $key) }} @lang('elementForm.date')
                </div>
                <div class="activity-element-info">
                    @foreach($groupedDates as $groupedDate)
                        <li>{{ formatDate($groupedDate['date']) }}</li>
                        <div class="toggle-btn">
                            <span class="show-more-info">@lang('global.show_more_info')</span>
                            <span class="hide-more-info hidden">@lang('global.hide_more_info')</span>
                        </div>
                        <div class="more-info hidden">
                            <div class="element-info">
                                <div class="activity-element-label">{{ $getCode->getCodeNameOnly('ActivityDateType', $key) }} @lang('elementForm.description')</div>
                                <div class="activity-element-info">{!! checkIfEmpty(checkIfEmpty(getFirstNarrative($groupedDate))) !!}
                                    @include('Activity.partials.viewInOtherLanguage' ,['otherLanguages' => getOtherLanguages($groupedDate['narrative'])])
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <a href="{{route('activity.basic-activity-info.index', $id)}}" class="edit-element">@lang('global.edit')</a>
        @include('Activity.partials.element-delete-form', ['element' => 'activity_date', 'id' => $id])
    </div>
@endif
