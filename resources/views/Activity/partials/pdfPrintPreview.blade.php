<div class="col-xs-12 pdf-preview">
	<div class="col-xs-12">
		<?php
			$currentDate = date('d M Y');
			$currentTime = date('H:i');
		?>
		<table>
			<colgroup>
			    <col style="width:30%">
			    <col style="width:70%">
			</colgroup>
			<thead>
				<th><!-- <h2>Print Preview DevFlow</h2> --></th>
				<th></th>
			</thead>
			<tbody>
				<tr>
					<td><?php echo '<span>' . $currentDate . '</span> <span>' . $currentTime . '</span>' ?></td>
					<td></td>
				</tr>
				<tr>
					<td><span class="title">Basic Project Information</span></td>
					<td></td>
				</tr>
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['reporting_org', 0], [])))
					<tr>
						<td>@lang('element.reporting_organisation')</td>
						<td>{!! checkIfEmpty(getFirstNarrativeWithoutLanguage(getVal($activityDataList, ['reporting_org', 0], []))) !!}</td>
					</tr>
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['identifier'], [])))
				    <tr>
				    	<td>@lang('element.activity_identifier')</td>
				        <td>{{ getVal($activityDataList, ['identifier', 'iati_identifier_text'])}}</td>
				    </tr>
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['title'], [])))
				    <tr>
				    	<td>@lang('element.title')</td>
				        <td>{{ getVal($activityDataList, ['title', 0, 'narrative'])}}</td>
				    </tr>
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['description'], [])))
					@foreach(getVal($activityDataList, ['description'], []) as $description)
						<tr>
							<td>{{$getCode->getCodeNameOnly('DescriptionType', getVal($description, ['type'], ''))}} @lang('elementForm.description')</td>
							<td>{!! getFirstNarrativeWithoutLanguage($description) !!}</td>
						</tr>
					@endforeach
				@endif
				@if(!empty(getVal($activityDataList, ['activity_status'], [])))
				    <tr>
				    	<td>@lang('element.activity_status')</td>
				        <td>{{ $getCode->getCodeNameOnly('ActivityStatus', getVal($activityDataList, ['activity_status'], [])) }}</td>
				    </tr>
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['activity_date'], [])))
					@foreach(groupActivityElements(getVal($activityDataList, ['activity_date'], []) , 'type') as $key => $groupedDates)
						@if($getCode->getCodeNameOnly('ActivityDateType', $key) == 'Planned Start')
							<tr>
						    	<td>Planned Start Date</td>
						        <td>
						        	@foreach($groupedDates as $groupedDate)
						        		{{ formatDate($groupedDate['date']) }}
						        	@endforeach
						        </td>
						    </tr>
						@endif
					@endforeach
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['activity_date'], [])))
					@foreach(groupActivityElements(getVal($activityDataList, ['activity_date'], []) , 'type') as $key => $groupedDates)
						@if($getCode->getCodeNameOnly('ActivityDateType', $key) == 'Planned End')
							<tr>
						    	<td>Planned End Date</td>
						        <td>
						        	@foreach($groupedDates as $groupedDate)
						        		{{ formatDate($groupedDate['date']) }}
						        	@endforeach
						        </td>
						    </tr>
						@endif
					@endforeach
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['participating_organization'], [])))
				    <tr>
				    	<td><span class="title">@lang('element.participating_organisation')</span></td>
				        <td></td>
				    </tr>
				    @foreach(groupActivityElements(getVal($activityDataList, ['participating_organization'], []) , 'organization_role') as $key => $organizations)
				    	@foreach($organizations as $organization)
				    		<tr>
					    		<td>{{ $getCode->getCodeNameOnly('OrganisationRole', $key)}}</td>
					    		<td>{!!  getFirstNarrativeWithoutLanguage($organization)  !!} (@if(!empty(getVal($organization, ['organization_type'])))
		                                         {{ $getCode->getCodeNameOnly("OrganisationType",getVal($organization, ['organization_type'])) }}
		                                    @endif)({!! checkIfEmpty(getVal($organization, ['identifier'], [])) !!})</td>
		                    </tr>
				    	@endforeach
				    @endforeach
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['recipient_country'], [])) || !emptyOrHasEmptyTemplate(getVal($activityDataList, ['recipient_region'], [])))
				    <tr>
				    	<td><span class="title">Geopolitical Information</span></td>
				        <td></td>
				    </tr>
				    @if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['recipient_country'], [])))
				    	@foreach(getVal($activityDataList, ['recipient_country'], []) as $recipientCountry)
				    		<tr>
				    			<td>Recipient Country</td>
				    			<td>{!! getRecipientInformation(getVal($recipientCountry, ['country_code']), getVal($recipientCountry, ['percentage']), 'Country') !!}</td>
				    		</tr>
				    	@endforeach
				    @endif
				    @if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['recipient_region'], [])))
				    	@foreach(getVal($activityDataList, ['recipient_region'], []) as $recipientRegion)
				    		<tr>
				    			<td>Recipient Region</td>
				    			<td>{!! getRecipientInformation(getVal($recipientRegion, ['region_code']), getVal($recipientRegion, ['percentage']), 'Region') !!}</td>
				    		</tr>
				    	@endforeach
				    @endif
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['sector'], [])))
					<tr>
						<td><span class="title">Sectors</span></td>
						<td></td>
					</tr>
					@foreach(groupSectorElements(getVal($activityDataList, ['sector'], [])) as $key => $sectors)
						@foreach($sectors as $sector)
							<tr>
								<td>Sector</td>
								<td>{!! checkIfEmpty(getSectorInformation($sector , getVal($sector, ['percentage'])))  !!}</td>
							</tr>
						@endforeach	
					@endforeach
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['policy_marker'], [])))
					<tr>
						<td><span class="title">Policy Markers</span></td>
						<td></td>
					</tr>
					@foreach(groupPolicyMarkerElement(getVal($activityDataList, ['policy_marker'], [])) as $key => $policyMarkers)
						@foreach($policyMarkers as $policyMarker)
							<tr>
								<td>Policy Marker</td>
								<td>{{ $getCode->getCodeNameOnly('PolicyMarker' , getVal($policyMarker, ['policy_marker'])) }} ({!! getCodeNameWithoutCodeValue('PolicySignificance' , getVal($policyMarker, ['significance']) , -4) !!})</td>
							</tr>
						@endforeach	
					@endforeach
				@endif
				@if(!empty(getVal($activityDataList, ['collaboration_type'], [])) || !empty(getVal($activityDataList, ['default_flow_type'], [])) || !empty(getVal($activityDataList, ['default_finance_type'], [])) || !empty(getVal($activityDataList, ['default_aid_type'], [])) || !empty(getVal($activityDataList, ['default_tied_status'], [])))
					<tr>
						<td><span class="title">Default Values</span></td>
						<td></td>
					</tr>
					@if(!empty(getVal($activityDataList, ['collaboration_type'], [])))
						<tr>
							<td>Collaboration Type</td>
							<td>{{ $getCode->getCodeNameOnly('CollaborationType' , getVal($activityDataList, ['collaboration_type'], [])) }}</td>
						</tr>
					@endif
					@if(!empty(getVal($activityDataList, ['default_flow_type'], [])))
						<tr>
							<td>Default Flow Type</td>
							<td>{{ substr($getCode->getActivityCodeName('FlowType', getVal($activityDataList, ['default_flow_type'], [])) , 0 , -4)}}</td>
						</tr>
					@endif
					@if(!empty(getVal($activityDataList, ['default_finance_type'], [])))
						<tr>
							<td>Default Finance Type</td>
							<td>{{ substr($getCode->getActivityCodeName('FinanceType', getVal($activityDataList, ['default_finance_type'], [])) , 0 , -5)}}</td>
						</tr>
					@endif
					@if(!empty(getVal($activityDataList, ['default_aid_type'], [])))
						<tr>
							<td>Default Aid Type</td>
							<td>@if(session('version') == 'V203')
	                {{-- {{ dd(getVal($activityDataList, ['default_aid_type']))}} --}}
	                    @if(is_array(getVal($activityDataList, ['default_aid_type'])))
	                        @foreach(getVal($activityDataList, ['default_aid_type']) as $data)
	                        {{-- {{ dd($data['default_aid_type'])}} --}}
	                        @if($data['default_aidtype_vocabulary'] == '1')
	                        {{ substr($getCode->getActivityCodeName('AidType', getVal($data, ['default_aid_type'], [])) , 0 , -5)}}
	                        @elseif($data['default_aidtype_vocabulary'] == '2')
	                        {{ substr($getCode->getActivityCodeName('EarmarkingCategory', getVal($data, ['earmarking_category'], [])) , 0 , -5)}}
	                        @else 
	                        {{ $data['default_aid_type_text']}}
	                        @endif
	                        @endforeach
	                    @else 
	                    {{ substr($getCode->getActivityCodeName('AidType', getVal($activityDataList, ['default_aid_type'], [])) , 0 , -5)}}
	                    @endif

	                @else 
	                {{ substr($getCode->getActivityCodeName('AidType', getVal($activityDataList, ['default_aid_type'], [])) , 0 , -5)}}
	                @endif</td>
						</tr>
					@endif
					@if(!empty(getVal($activityDataList, ['default_tied_status'], [])))
						<tr>
							<td>Default Tied Status</td>
							<td>{{ substr($getCode->getActivityCodeName('TiedStatus', getVal($activityDataList, ['default_tied_status'], [])) , 0 , -4)}}</td>
						</tr>
					@endif	
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['budget'], [])))
					<tr>
						<td><span class="title">Budget(s)</span></td>
						<td></td>
					</tr>
					@foreach( groupBudgetElements(getVal($activityDataList, ['budget'], []) , 'budget_type') as $key => $budgets)
						@foreach($budgets as $budget)
							<tr>
								<td>@if(session('version') != 'V201')
										{!! getBudgetInformationWithoutCode('status' , $budget) !!}
									@endif 
									({{ $getCode->getCodeNameOnly('BudgetType' , $key) }})</td>
								<td>{!! getBudgetInformation('period' , $budget) !!} ({!! getBudgetInformationWithoutCode('currency_with_valuedate' , $budget) !!})</td>
							</tr>
						@endforeach
					@endforeach
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['transaction'], [])))
					<tr>
						<td><span class="title">Transaction(s)</span></td>
						<td></td>
					</tr>
					@foreach(groupTransactionElements(getVal($activityDataList, ['transaction'], [])) as $key => $groupedTransactions)
						@foreach($groupedTransactions as $transaction)
							@if($key == 'Disbursement')
								<tr>
									<td>{{$key}}</td>
									<td>{!! getFirstNarrativeWithoutLanguage(getVal($transaction, ['receiver_organization', 0], []), trans('global.no_name_available')) !!} ({{ formatDate(getVal($transaction, ['transaction_date', 0, 'date'])) }}) ({!! getCurrencyWithoutValueDate(getVal($transaction, ['value', 0]) , "transaction") !!})</td>
								</tr>
							@elseif($key == 'Expenditure')
								<tr>
									<td>{{$key}}</td>
									<td>{!! getFirstNarrativeWithoutLanguage(getVal($transaction, ['description', 0], [])) !!} ({{ formatDate(getVal($transaction, ['transaction_date', 0, 'date'])) }}) ({!! getCurrencyWithoutValueDate(getVal($transaction, ['value', 0]) , "transaction") !!})</td>
								</tr>
							@elseif($key == 'Incoming Funds')
								<tr>
									<td>{{$key}}</td>
									<td>{!! getFirstNarrativeWithoutLanguage(getVal($transaction, ['provider_organization', 0], []), trans('global.no_name_available')) !!} ({{ formatDate(getVal($transaction, ['transaction_date', 0, 'date'])) }}) ({!! getCurrencyWithoutValueDate(getVal($transaction, ['value', 0]) , "transaction") !!})</td>
								</tr>
							@endif
						@endforeach
					@endforeach
				@endif
				@if(!emptyOrHasEmptyTemplate(getVal($activityDataList, ['document_links'], [])))
					<tr>
						<td><span class="title">Document(s)</span></td>
						<td></td>
					</tr>
					@foreach(getVal($activityDataList, ['document_links'], []) as $documentLink)
						<tr>
							<td>
								@foreach(getVal($documentLink, ['document_link', 'category'], []) as $category)
	                                {!! getCodeNameWithCodeValue('DocumentCategory' , $category['code'] , -5) !!}
	                            @endforeach
							</td>
							<td>{!! getFirstNarrativeWithoutLanguage(getVal($documentLink, ['document_link', 'title', 0], [])) !!}</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>