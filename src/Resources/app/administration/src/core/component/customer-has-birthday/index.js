import template from './customer-has-birthday.html.twig';

const { Component } = Shopware;
const { mapPropertyErrors } = Component.getComponentHelper();

Component.extend('customer-has-birthday', 'sw-condition-base', {
    template,

    computed: {
        selectValues() {
            return [
                {
                    label: this.$tc('global.sw-condition.condition.yes'),
                    value: true
                },
                {
                    label: this.$tc('global.sw-condition.condition.no'),
                    value: false
                }
            ];
        },

        hasBirthday: {
            get() {
                this.ensureValueExist();

                if (this.condition.value.hasBirthday == null) {
                    this.condition.value.hasBirthday = false;
                }

                return this.condition.value.hasBirthday;
            },
            set(hasBirthday) {
                this.ensureValueExist();
                this.condition.value = { ...this.condition.value, hasBirthday };
            }
        },

        ...mapPropertyErrors('condition', ['value.hasBirthday']),
    }
});
