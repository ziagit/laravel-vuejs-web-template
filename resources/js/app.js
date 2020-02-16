
require('./bootstrap');
/* import { MdButton, MdContent, MdTabs } from 'vue-material/dist/components' */
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import 'vue-material-design-icons/styles.css';


import Vue from 'vue';
import router from './router';

import App from './components/App';
import Donut from 'vue-css-donut-chart';
import 'vue-css-donut-chart/dist/vcdonut.css';

import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'

Vue.use(Chartkick.use(Chart))

Vue.use(Donut);

Vue.use(VueMaterial)
/* Vue.use(MdContent)
Vue.use(MdTabs) */
export const eventBus = new Vue();

const app = new Vue({
    el: '#app',

    router,
    components:{
        App,
    }
});
