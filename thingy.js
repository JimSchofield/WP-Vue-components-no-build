const registerComponent = () => {
    Vue.component('thingy', {
        props: {
            message: String
        },
        data() {
            return {
                toggle: false,
            }
        },
        template: `
        <div>
            <button @click="toggle = !toggle">toggle</button>
            <p v-if="toggle">{{message}}</p>
        </div>
        `
    })
}

export default registerComponent;