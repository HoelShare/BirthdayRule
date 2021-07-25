import '../core/component/customer-has-birthday';

Shopware.Application.addServiceProviderDecorator('ruleConditionDataProviderService', (ruleConditionService) => {
    ruleConditionService.addCondition('customerHasBirthday', {
        component: 'customer-has-birthday',
        label: 'Customer has Birthday Today',
        scopes: ['checkout']
    });

    return ruleConditionService;
});
