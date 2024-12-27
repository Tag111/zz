<?php
// This file was auto-generated from sdk-root/src/data/rbin/2021-06-15/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2021-06-15', 'endpointPrefix' => 'rbin', 'jsonVersion' => '1.1', 'protocol' => 'rest-json', 'serviceFullName' => 'Amazon Recycle Bin', 'serviceId' => 'rbin', 'signatureVersion' => 'v4', 'signingName' => 'rbin', 'uid' => 'rbin-2021-06-15', ], 'operations' => [ 'CreateRule' => [ 'name' => 'CreateRule', 'http' => [ 'method' => 'POST', 'requestUri' => '/rules', 'responseCode' => 201, ], 'input' => [ 'shape' => 'CreateRuleRequest', ], 'output' => [ 'shape' => 'CreateRuleResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'InternalServerException', ], ], ], 'DeleteRule' => [ 'name' => 'DeleteRule', 'http' => [ 'method' => 'DELETE', 'requestUri' => '/rules/{identifier}', 'responseCode' => 204, ], 'input' => [ 'shape' => 'DeleteRuleRequest', ], 'output' => [ 'shape' => 'DeleteRuleResponse', ], 'errors' => [ [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'ConflictException', ], ], ], 'GetRule' => [ 'name' => 'GetRule', 'http' => [ 'method' => 'GET', 'requestUri' => '/rules/{identifier}', 'responseCode' => 200, ], 'input' => [ 'shape' => 'GetRuleRequest', ], 'output' => [ 'shape' => 'GetRuleResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'ListRules' => [ 'name' => 'ListRules', 'http' => [ 'method' => 'POST', 'requestUri' => '/list-rules', 'responseCode' => 200, ], 'input' => [ 'shape' => 'ListRulesRequest', ], 'output' => [ 'shape' => 'ListRulesResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], ], ], 'ListTagsForResource' => [ 'name' => 'ListTagsForResource', 'http' => [ 'method' => 'GET', 'requestUri' => '/tags/{resourceArn}', 'responseCode' => 200, ], 'input' => [ 'shape' => 'ListTagsForResourceRequest', ], 'output' => [ 'shape' => 'ListTagsForResourceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'LockRule' => [ 'name' => 'LockRule', 'http' => [ 'method' => 'PATCH', 'requestUri' => '/rules/{identifier}/lock', 'responseCode' => 200, ], 'input' => [ 'shape' => 'LockRuleRequest', ], 'output' => [ 'shape' => 'LockRuleResponse', ], 'errors' => [ [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'ConflictException', ], ], ], 'TagResource' => [ 'name' => 'TagResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/tags/{resourceArn}', 'responseCode' => 201, ], 'input' => [ 'shape' => 'TagResourceRequest', ], 'output' => [ 'shape' => 'TagResourceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ServiceQuotaExceededException', ], ], ], 'UnlockRule' => [ 'name' => 'UnlockRule', 'http' => [ 'method' => 'PATCH', 'requestUri' => '/rules/{identifier}/unlock', 'responseCode' => 200, ], 'input' => [ 'shape' => 'UnlockRuleRequest', ], 'output' => [ 'shape' => 'UnlockRuleResponse', ], 'errors' => [ [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'ConflictException', ], ], ], 'UntagResource' => [ 'name' => 'UntagResource', 'http' => [ 'method' => 'DELETE', 'requestUri' => '/tags/{resourceArn}', 'responseCode' => 204, ], 'input' => [ 'shape' => 'UntagResourceRequest', ], 'output' => [ 'shape' => 'UntagResourceResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'UpdateRule' => [ 'name' => 'UpdateRule', 'http' => [ 'method' => 'PATCH', 'requestUri' => '/rules/{identifier}', 'responseCode' => 200, ], 'input' => [ 'shape' => 'UpdateRuleRequest', ], 'output' => [ 'shape' => 'UpdateRuleResponse', ], 'errors' => [ [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'ConflictException', ], [ 'shape' => 'ServiceQuotaExceededException', ], ], ], ], 'shapes' => [ 'ConflictException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'ErrorMessage', ], 'Reason' => [ 'shape' => 'ConflictExceptionReason', ], ], 'error' => [ 'httpStatusCode' => 409, ], 'exception' => true, ], 'ConflictExceptionReason' => [ 'type' => 'string', 'enum' => [ 'INVALID_RULE_STATE', ], ], 'CreateRuleRequest' => [ 'type' => 'structure', 'required' => [ 'RetentionPeriod', 'ResourceType', ], 'members' => [ 'RetentionPeriod' => [ 'shape' => 'RetentionPeriod', ], 'Description' => [ 'shape' => 'Description', ], 'Tags' => [ 'shape' => 'TagList', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'ResourceTags' => [ 'shape' => 'ResourceTags', ], 'LockConfiguration' => [ 'shape' => 'LockConfiguration', ], ], ], 'CreateRuleResponse' => [ 'type' => 'structure', 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', ], 'RetentionPeriod' => [ 'shape' => 'RetentionPeriod', ], 'Description' => [ 'shape' => 'Description', ], 'Tags' => [ 'shape' => 'TagList', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'ResourceTags' => [ 'shape' => 'ResourceTags', ], 'Status' => [ 'shape' => 'RuleStatus', ], 'LockConfiguration' => [ 'shape' => 'LockConfiguration', ], 'LockState' => [ 'shape' => 'LockState', ], 'RuleArn' => [ 'shape' => 'RuleArn', ], ], ], 'DeleteRuleRequest' => [ 'type' => 'structure', 'required' => [ 'Identifier', ], 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', 'location' => 'uri', 'locationName' => 'identifier', ], ], ], 'DeleteRuleResponse' => [ 'type' => 'structure', 'members' => [], ], 'Description' => [ 'type' => 'string', 'pattern' => '^[\\S ]{0,255}$', ], 'ErrorMessage' => [ 'type' => 'string', ], 'GetRuleRequest' => [ 'type' => 'structure', 'required' => [ 'Identifier', ], 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', 'location' => 'uri', 'locationName' => 'identifier', ], ], ], 'GetRuleResponse' => [ 'type' => 'structure', 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', ], 'Description' => [ 'shape' => 'Description', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'RetentionPeriod' => [ 'shape' => 'RetentionPeriod', ], 'ResourceTags' => [ 'shape' => 'ResourceTags', ], 'Status' => [ 'shape' => 'RuleStatus', ], 'LockConfiguration' => [ 'shape' => 'LockConfiguration', ], 'LockState' => [ 'shape' => 'LockState', ], 'LockEndTime' => [ 'shape' => 'TimeStamp', ], 'RuleArn' => [ 'shape' => 'RuleArn', ], ], ], 'InternalServerException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'ErrorMessage', ], ], 'error' => [ 'httpStatusCode' => 500, ], 'exception' => true, 'fault' => true, ], 'ListRulesRequest' => [ 'type' => 'structure', 'required' => [ 'ResourceType', ], 'members' => [ 'MaxResults' => [ 'shape' => 'MaxResults', ], 'NextToken' => [ 'shape' => 'NextToken', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'ResourceTags' => [ 'shape' => 'ResourceTags', ], 'LockState' => [ 'shape' => 'LockState', ], ], ], 'ListRulesResponse' => [ 'type' => 'structure', 'members' => [ 'Rules' => [ 'shape' => 'RuleSummaryList', ], 'NextToken' => [ 'shape' => 'NextToken', ], ], ], 'ListTagsForResourceRequest' => [ 'type' => 'structure', 'required' => [ 'ResourceArn', ], 'members' => [ 'ResourceArn' => [ 'shape' => 'RuleArn', 'location' => 'uri', 'locationName' => 'resourceArn', ], ], ], 'ListTagsForResourceResponse' => [ 'type' => 'structure', 'members' => [ 'Tags' => [ 'shape' => 'TagList', ], ], ], 'LockConfiguration' => [ 'type' => 'structure', 'required' => [ 'UnlockDelay', ], 'members' => [ 'UnlockDelay' => [ 'shape' => 'UnlockDelay', ], ], ], 'LockRuleRequest' => [ 'type' => 'structure', 'required' => [ 'Identifier', 'LockConfiguration', ], 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', 'location' => 'uri', 'locationName' => 'identifier', ], 'LockConfiguration' => [ 'shape' => 'LockConfiguration', ], ], ], 'LockRuleResponse' => [ 'type' => 'structure', 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', ], 'Description' => [ 'shape' => 'Description', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'RetentionPeriod' => [ 'shape' => 'RetentionPeriod', ], 'ResourceTags' => [ 'shape' => 'ResourceTags', ], 'Status' => [ 'shape' => 'RuleStatus', ], 'LockConfiguration' => [ 'shape' => 'LockConfiguration', ], 'LockState' => [ 'shape' => 'LockState', ], 'RuleArn' => [ 'shape' => 'RuleArn', ], ], ], 'LockState' => [ 'type' => 'string', 'enum' => [ 'locked', 'pending_unlock', 'unlocked', ], ], 'MaxResults' => [ 'type' => 'integer', 'max' => 1000, 'min' => 1, ], 'NextToken' => [ 'type' => 'string', 'pattern' => '^[A-Za-z0-9+/=]{1,2048}$', ], 'ResourceNotFoundException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'ErrorMessage', ], 'Reason' => [ 'shape' => 'ResourceNotFoundExceptionReason', ], ], 'error' => [ 'httpStatusCode' => 404, ], 'exception' => true, ], 'ResourceNotFoundExceptionReason' => [ 'type' => 'string', 'enum' => [ 'RULE_NOT_FOUND', ], ], 'ResourceTag' => [ 'type' => 'structure', 'required' => [ 'ResourceTagKey', ], 'members' => [ 'ResourceTagKey' => [ 'shape' => 'ResourceTagKey', ], 'ResourceTagValue' => [ 'shape' => 'ResourceTagValue', ], ], ], 'ResourceTagKey' => [ 'type' => 'string', 'pattern' => '^[\\S\\s]{1,128}$', ], 'ResourceTagValue' => [ 'type' => 'string', 'pattern' => '^[\\S\\s]{0,256}$', ], 'ResourceTags' => [ 'type' => 'list', 'member' => [ 'shape' => 'ResourceTag', ], 'max' => 50, 'min' => 0, ], 'ResourceType' => [ 'type' => 'string', 'enum' => [ 'EBS_SNAPSHOT', 'EC2_IMAGE', ], ], 'RetentionPeriod' => [ 'type' => 'structure', 'required' => [ 'RetentionPeriodValue', 'RetentionPeriodUnit', ], 'members' => [ 'RetentionPeriodValue' => [ 'shape' => 'RetentionPeriodValue', ], 'RetentionPeriodUnit' => [ 'shape' => 'RetentionPeriodUnit', ], ], ], 'RetentionPeriodUnit' => [ 'type' => 'string', 'enum' => [ 'DAYS', ], ], 'RetentionPeriodValue' => [ 'type' => 'integer', 'max' => 3650, 'min' => 1, ], 'RuleArn' => [ 'type' => 'string', 'max' => 1011, 'min' => 0, 'pattern' => '^arn:aws(-[a-z]{1,3}){0,2}:rbin:[a-z\\-0-9]{0,63}:[0-9]{12}:rule/[0-9a-zA-Z]{11}{0,1011}$', ], 'RuleIdentifier' => [ 'type' => 'string', 'pattern' => '[0-9a-zA-Z]{11}', ], 'RuleStatus' => [ 'type' => 'string', 'enum' => [ 'pending', 'available', ], ], 'RuleSummary' => [ 'type' => 'structure', 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', ], 'Description' => [ 'shape' => 'Description', ], 'RetentionPeriod' => [ 'shape' => 'RetentionPeriod', ], 'LockState' => [ 'shape' => 'LockState', ], 'RuleArn' => [ 'shape' => 'RuleArn', ], ], ], 'RuleSummaryList' => [ 'type' => 'list', 'member' => [ 'shape' => 'RuleSummary', ], ], 'ServiceQuotaExceededException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'ErrorMessage', ], 'Reason' => [ 'shape' => 'ServiceQuotaExceededExceptionReason', ], ], 'error' => [ 'httpStatusCode' => 402, ], 'exception' => true, ], 'ServiceQuotaExceededExceptionReason' => [ 'type' => 'string', 'enum' => [ 'SERVICE_QUOTA_EXCEEDED', ], ], 'Tag' => [ 'type' => 'structure', 'required' => [ 'Key', 'Value', ], 'members' => [ 'Key' => [ 'shape' => 'TagKey', ], 'Value' => [ 'shape' => 'TagValue', ], ], ], 'TagKey' => [ 'type' => 'string', 'max' => 128, 'min' => 1, 'pattern' => '^([\\p{L}\\p{Z}\\p{N}_.:/=+\\-@]*)$', ], 'TagKeyList' => [ 'type' => 'list', 'member' => [ 'shape' => 'TagKey', ], 'max' => 200, 'min' => 0, ], 'TagList' => [ 'type' => 'list', 'member' => [ 'shape' => 'Tag', ], 'max' => 200, 'min' => 0, ], 'TagResourceRequest' => [ 'type' => 'structure', 'required' => [ 'ResourceArn', 'Tags', ], 'members' => [ 'ResourceArn' => [ 'shape' => 'RuleArn', 'location' => 'uri', 'locationName' => 'resourceArn', ], 'Tags' => [ 'shape' => 'TagList', ], ], ], 'TagResourceResponse' => [ 'type' => 'structure', 'members' => [], ], 'TagValue' => [ 'type' => 'string', 'max' => 256, 'min' => 0, 'pattern' => '^([\\p{L}\\p{Z}\\p{N}_.:/=+\\-@]*)$', ], 'TimeStamp' => [ 'type' => 'timestamp', ], 'UnlockDelay' => [ 'type' => 'structure', 'required' => [ 'UnlockDelayValue', 'UnlockDelayUnit', ], 'members' => [ 'UnlockDelayValue' => [ 'shape' => 'UnlockDelayValue', ], 'UnlockDelayUnit' => [ 'shape' => 'UnlockDelayUnit', ], ], ], 'UnlockDelayUnit' => [ 'type' => 'string', 'enum' => [ 'DAYS', ], ], 'UnlockDelayValue' => [ 'type' => 'integer', 'max' => 30, 'min' => 7, ], 'UnlockRuleRequest' => [ 'type' => 'structure', 'required' => [ 'Identifier', ], 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', 'location' => 'uri', 'locationName' => 'identifier', ], ], ], 'UnlockRuleResponse' => [ 'type' => 'structure', 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', ], 'Description' => [ 'shape' => 'Description', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'RetentionPeriod' => [ 'shape' => 'RetentionPeriod', ], 'ResourceTags' => [ 'shape' => 'ResourceTags', ], 'Status' => [ 'shape' => 'RuleStatus', ], 'LockConfiguration' => [ 'shape' => 'LockConfiguration', ], 'LockState' => [ 'shape' => 'LockState', ], 'LockEndTime' => [ 'shape' => 'TimeStamp', ], 'RuleArn' => [ 'shape' => 'RuleArn', ], ], ], 'UntagResourceRequest' => [ 'type' => 'structure', 'required' => [ 'ResourceArn', 'TagKeys', ], 'members' => [ 'ResourceArn' => [ 'shape' => 'RuleArn', 'location' => 'uri', 'locationName' => 'resourceArn', ], 'TagKeys' => [ 'shape' => 'TagKeyList', 'location' => 'querystring', 'locationName' => 'tagKeys', ], ], ], 'UntagResourceResponse' => [ 'type' => 'structure', 'members' => [], ], 'UpdateRuleRequest' => [ 'type' => 'structure', 'required' => [ 'Identifier', ], 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', 'location' => 'uri', 'locationName' => 'identifier', ], 'RetentionPeriod' => [ 'shape' => 'RetentionPeriod', ], 'Description' => [ 'shape' => 'Description', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'ResourceTags' => [ 'shape' => 'ResourceTags', ], ], ], 'UpdateRuleResponse' => [ 'type' => 'structure', 'members' => [ 'Identifier' => [ 'shape' => 'RuleIdentifier', ], 'RetentionPeriod' => [ 'shape' => 'RetentionPeriod', ], 'Description' => [ 'shape' => 'Description', ], 'ResourceType' => [ 'shape' => 'ResourceType', ], 'ResourceTags' => [ 'shape' => 'ResourceTags', ], 'Status' => [ 'shape' => 'RuleStatus', ], 'LockState' => [ 'shape' => 'LockState', ], 'LockEndTime' => [ 'shape' => 'TimeStamp', ], 'RuleArn' => [ 'shape' => 'RuleArn', ], ], ], 'ValidationException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'ErrorMessage', ], 'Reason' => [ 'shape' => 'ValidationExceptionReason', ], ], 'error' => [ 'httpStatusCode' => 400, ], 'exception' => true, ], 'ValidationExceptionReason' => [ 'type' => 'string', 'enum' => [ 'INVALID_PAGE_TOKEN', 'INVALID_PARAMETER_VALUE', ], ], ],];