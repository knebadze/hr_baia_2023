<template lang="">
     <div class="col-xl-9 col-lg-8 col-md-12 m-b30 employerPageBorder">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <form-wizard @on-complete="onComplete"
                      :start-index="1"
                      step-size="xs"  color="#094899">
                <tab-content title="Personal details" icon="fa fa-user"
                            >
                My first tab content
                </tab-content>
                <tab-content title="Additional Info"
                            >
                My second tab content
                </tab-content>
                <tab-content title="Last step"
                            >
                Yuhuuu! This seems pretty damn simple
                </tab-content>
            </form-wizard>
        </div>
     </div>
    </template>
    <script>
    import { ref, computed, watch } from 'vue';
    import { I18n } from 'laravel-vue-i18n';


    export default {
        // emits: ['validateAndEmit'],
        props: {
            data: Object,
        },
      setup(props) {
        const getLang = computed(() => {
          return I18n.getSharedInstance().options.lang;
        });



        return {
            getLang
        };
      },
    };
    </script>


