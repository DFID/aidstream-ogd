@if(!empty(getVal($activityDataList, ['activity_status'], [])))
    <div class="activity-element-wrapper">
        <div class="activity-element-list">
            <div class="activity-element-label col-md-4">@lang('element.activity_status') @if(array_key_exists('Activity Status',$errors)) <i class='imported-from-xml'>icon</i>@endif </div>
            <div class="activity-element-info">
                {{ $getCode->getCodeNameOnly('ActivityStatus', getVal($activityDataList, ['activity_status'], [])) }}
            </div>
        </div>
    </div>
@endif
