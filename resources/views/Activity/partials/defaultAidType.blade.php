@if(!empty(getVal($activityDataList, ['default_aid_type'], [])))
    <div class="activity-element-wrapper">
        <div class="activity-element-list">
            <div class="activity-element-label col-md-4">@lang('element.default_aid_type') @if(array_key_exists('Default Aid Type',$errors)) <i class='imported-from-xml'>icon</i>@endif </div>
            <div class="activity-element-info">
                @if(session('version') == 'V203')
                {{-- {{ dd(getVal($activityDataList, ['default_aid_type']))}} --}}
                    @if(is_array(getVal($activityDataList, ['default_aid_type'])))
                        @foreach(getVal($activityDataList, ['default_aid_type']) as $data)
                        {{-- {{ dd($data['default_aid_type'])}} --}}
                        @if($data['default_aidtype_vocabulary'] == '1')
                        <li>{{ substr($getCode->getActivityCodeName('AidType', getVal($data, ['default_aid_type'], [])) , 0 , -5)}}</li>
                        @elseif($data['default_aidtype_vocabulary'] == '2')
                        <li>{{ substr($getCode->getActivityCodeName('EarmarkingCategory', getVal($data, ['earmarking_category'], [])) , 0 , -5)}}</li>
                        @else 
                        <li>{{ $data['default_aid_type_text']}}</li>
                        @endif
                        @endforeach
                    @else 
                    {{ substr($getCode->getActivityCodeName('AidType', getVal($activityDataList, ['default_aid_type'], [])) , 0 , -5)}}
                    @endif

                @else 
                {{ substr($getCode->getActivityCodeName('AidType', getVal($activityDataList, ['default_aid_type'], [])) , 0 , -5)}}
                @endif
            </div>
        </div>
        <a href="{{route('activity.default-aid-type.index', $id)}}" class="edit-element">@lang('global.edit')</a>
        @include('Activity.partials.element-delete-form', ['element' => 'default_aid_type', 'id' => $id])
    </div>
@endif
