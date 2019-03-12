import registerComponent from './thingy.js';

(function () {

    function ready(fn) {
        if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading") {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    const SELECTOR = '.vue-component';

    ready(() => {
        const instances = document.querySelectorAll(SELECTOR)

        registerComponent();

        instances.forEach((el, index) => {
            new Vue({
                el: SELECTOR,
                data() {
                    return {
                        instance: index + 1,
                    }
                },
                template: `
                <div style="padding: 1em; background: #333; color: white;">
                    <thingy :message="'Hi there from component ' + instance"/>
                </div>
                    `
            })
        })
    })


})();