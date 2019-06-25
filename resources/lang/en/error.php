<?php

//404 erros, permission errors, non-validation errors

return [
    'fix_and_upload'                                         => 'Please fix and upload again',
    'errors_found'                                           => 'Errors Found',
    'errors_not_found'                                       => 'Errors Not Found',
    'fix_and_upload_again'                                   => 'Please fix these errors and upload this file again to import this activity',
    'fix_activity'                                           => 'This activity has some errors. You must fix this before publishing.',
    'be_right_back'                                          => 'Be right back.',
    'xml_error'                                              => 'The Xml you uploaded contains error. Please fix these errors and upload them again.',
    'unable_to_login'                                        => 'Unable to login. Please contact us at <a href=\'mailto:IATI-feedback@dfid.gov.uk\'>IATI-feedback@dfid.gov.uk</a>',
    'organisation_name_abbreviation_taken'                   => 'Organisation Name Abbreviation has already been taken.',
    'account_disabled'                                       => 'Your account has been disabled. Please contact us at <a href=\'mailto:IATI-feedback@dfid.gov.uk\'>IATI-feedback@dfid.gov.uk</a> ',
    'account_not_verified'                                   => 'Your account has not be verified yet. A verification email was sent to you. Please check your email and verify your account to login. If you are still having problem, please contact us at <a href=\'mailto:IATI-feedback@dfid.gov.uk\'>IATI-feedback@dfid.gov.uk</a> ',
    'incorrect_credentials'                                  => 'Sorry the credentials you have entered is incorrect.',
    'failed_to_send_email'                                   => 'Failed to send email.',
    'failed_to_save_password'                                => 'Failed to save Password.',
    'failed_to_save_registry_info'                           => 'Failed to save Registry Info.',
    'something_is_not_right'                                 => 'Something is not right.',
    'header_mismatch'                                        => 'The headers in the uploaded Csv file do not match with the provided template.',
    'data_not_available'                                     => 'No data available.',
    'select_activity_xml_files_to_be_published'              => 'Please select activity XML files to be published.',
    'failed_to_publish_to_registry'                          => 'The files :filename could not be published to registry. Please try again.',
    'activity_not_published_to_registry'                     => 'This activity has not been published to the IATI registry. Please go to Published files to manually publish your file to the registry. If you need help please
                                    contact us at <a href=\'mailto:IATI-feedback@dfid.gov.uk\'>IATI-feedback@dfid.gov.uk</a>.',
    'republish_activity'                                     => 'This activity has not been published to the IATI registry. Please re-publish this activity again. If you need help please
                                    contact us at <a href=\'mailto:IATI-feedback@dfid.gov.uk\'>IATI-feedback@dfid.gov.uk</a>.',
    'failed_to_remove_sector_details_from_activity_level'    => 'Failed to remove Sector details from Activity level.',
    'failed_to_remove_sector_details_from_transaction_level' => 'Failed to remove Sector details from Transaction level.',
    'today_date'                                             => 'Actual Start Date and Actual End Date must be Today or past days. (block :block)',
    'end_date_after_start_date'                              => 'Ends should be after respective Starts in Activity Date Type (block :block)',
    'end_date_later_start_date'                              => 'End date must be later than the start date (block :block)',
    'planned_actual_start_date_required'                     => 'Planned Start or Actual Start in Activity Date Type is required.',
    'activities_not_found'                                   => 'Couldn\'t find activities to be imported.',
    'cannot_save_recipient_country_and_region'               => 'You cannot save Recipient Country in activity level because you have already saved recipient country or region in transaction level.',
    'activity_not_found'                                     => 'Activity with id :id not found.',
    'file_not_deleted'                                       => 'File couldn\'t be deleted.',
    'org_data_not_published_to_registry'                     => 'Your organization data has not been published to the IATI registry. Please go to Published files to manually publish your file to the registry. If you need help please
                                    contact us at <a href=\'mailto:IATI-feedback@dfid.gov.uk\'>IATI-feedback@dfid.gov.uk</a>.',
    'republish_org_data'                                     => "Your organization data has not been published to the IATI registry. Please re-publish this activity again. If you need help please
                                    contact us at <a href='mailto:IATI-feedback@dfid.gov.uk'>IATI-feedback@dfid.gov.uk</a>.",
    'file_type_not_allowed'                                  => 'No such files allowed.',
    'document_already_exists'                                => 'Document already exists.',
    'failed_to_upload_document'                              => 'Failed to upload Document',
    'none_activity'                                          => 'It seems you do not have any Activities.',
    'none_transaction'                                       => 'It seems you do not have any Transactions.',
    'no_correct_privilege'                                   => 'You do not have the correct privileges to view this page.',
    'failed_to_update_settings'                              => 'Failed to update Settings',
    'could_not_change_segmentation'                          => 'Could not change segmentation.',
    'could_not_publish_to_registry'                          => 'Could not publish to registry.',
    'publisher_not_found'                                    => sprintf("It seems your publisher id is not correct.<a href='%s'>Please correct your publisher Id.</a>", route('publishing-settings')),
    'failed_to_submit_query'                                 => 'Failed to submit your query. Please try again.',
    'select_activities_to_be_imported'                       => 'Select activities to be imported',
    'select_transactions_to_be_imported'                     => 'Select transactions to be imported',
    'no_ongoing_processes'                                   => 'Please upload CSV file to process.',
    'no_data_available'                                      => 'It seems you have uploaded an empty file. Please fill the values in the file and try uploading once again.',
    'not_authorized'                                         => sprintf(
        "It seems your api key is incorrect. Please correct the api key <a href='%s'>here</a> and try publishing again.",
        route('publishing-settings')
    ),
    'error_budget_create'                                    => 'Error occurred during creation of budget',
    'error_transaction_update'                               => 'Error updating transaction',
    'error_transaction_create'                               => 'Error creating transaction',
    'error_transaction_delete'                               => 'Error deleting transaction',
    '404_not_found'                                          => '<span><b>404! Not Found</b><br>The requested url cannot be found in our system.</span>',
    'not_available_for_v201'                                 => 'Sorry this feature is not available for V201. Please upgrade to latest version to download.',
    'upgrade_not_completed'                                  => 'Upgrade could not be completed.',
    'connection_error'                                       => 'Failed to connect to IATI Registry. Please try publishing your activity later.',
    'package_not_found'                                      => "The dataset was not found in IATI Registry. Please contact us at <a href='mailto:IATI-feedback@dfid.gov.uk'>IATI-feedback@dfid.gov.uk</a> for further assistance.",
    'xml_file_not_found'                                     => "The xml file was not found. Please contact us at <a href='mailto:IATI-feedback@dfid.gov.uk'>IATI-feedback@dfid.gov.uk</a> for further assistance.",
    'not_allowed'                                            => 'You are not allowed to publish the selected xml file.',
    'file_not_found'                                         => 'The file :file could not be found in AidStream.',
    'problem_with_the_registry'                              => 'There seems to be a problem with the registry. Please try again later.',
    'no_authority' => sprintf(
      "It seems you don't have the authority to publish yet. Please contact <a href='mailto:support@iatistandard.org'>support@iatistandard.org</a> for further information."
    )
];

