// assets/js/_main.js
const imagesContext = require.context('../images', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

// assets/js/app.js
import Vue from 'vue';

import MatchTableContainer from './components/MatchTableContainer'

/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    components: {
        MatchTableContainer
    },
});